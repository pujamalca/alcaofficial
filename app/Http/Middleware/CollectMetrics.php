<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CollectMetrics
{
    /**
     * Handle an incoming request and collect performance metrics.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);
        $startMemory = memory_get_usage();

        $response = $next($request);

        $duration = (microtime(true) - $startTime) * 1000; // Convert to milliseconds
        $memoryUsed = memory_get_usage() - $startMemory;

        // Collect metrics
        $this->collectRequestMetrics($request, $response, $duration, $memoryUsed);

        // Add metrics headers (for debugging)
        if (config('app.debug')) {
            $response->headers->set('X-Response-Time', round($duration, 2) . 'ms');
            $response->headers->set('X-Memory-Usage', $this->formatBytes($memoryUsed));
        }

        return $response;
    }

    /**
     * Collect request metrics for monitoring
     */
    protected function collectRequestMetrics(
        Request $request,
        Response $response,
        float $duration,
        int $memoryUsed
    ): void {
        $route = $request->route()?->getName() ?? 'unknown';
        $method = $request->method();
        $statusCode = $response->getStatusCode();

        // Increment request counter
        $this->incrementCounter("http_requests_total:{$method}:{$statusCode}");

        // Track response time histogram
        $this->trackHistogram("http_request_duration_ms:{$route}", $duration);

        // Track memory usage
        $this->trackGauge("http_memory_usage_bytes:{$route}", $memoryUsed);

        // Track slow requests (>1s)
        if ($duration > 1000) {
            $this->incrementCounter("http_slow_requests_total:{$route}");
        }

        // Track errors
        if ($statusCode >= 500) {
            $this->incrementCounter("http_errors_total:{$route}");
        }
    }

    /**
     * Increment counter metric
     */
    protected function incrementCounter(string $metric): void
    {
        $key = "metrics:counter:{$metric}";
        Cache::increment($key);

        // Set expiry for hourly reset
        if (!Cache::has($key . ':ttl')) {
            Cache::put($key . ':ttl', true, 3600);
        }
    }

    /**
     * Track histogram metric (for percentiles)
     */
    protected function trackHistogram(string $metric, float $value): void
    {
        $key = "metrics:histogram:{$metric}:" . now()->format('YmdH');

        // Store values for aggregation
        $values = Cache::get($key, []);
        $values[] = $value;

        // Keep only last 1000 values
        if (count($values) > 1000) {
            $values = array_slice($values, -1000);
        }

        Cache::put($key, $values, 3600);
    }

    /**
     * Track gauge metric (current value)
     */
    protected function trackGauge(string $metric, $value): void
    {
        $key = "metrics:gauge:{$metric}";
        Cache::put($key, $value, 300); // 5 minutes
    }

    /**
     * Format bytes to human-readable format
     */
    protected function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;

        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}
