<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class MetricsController extends Controller
{
    /**
     * Export metrics in Prometheus format
     */
    public function prometheus(): Response
    {
        $metrics = [];

        // Application info
        $metrics[] = '# HELP app_info Application information';
        $metrics[] = '# TYPE app_info gauge';
        $metrics[] = sprintf(
            'app_info{version="%s",env="%s"} 1',
            config('app.version', '1.0.0'),
            config('app.env')
        );

        // HTTP request metrics
        $metrics[] = "\n# HELP http_requests_total Total HTTP requests";
        $metrics[] = '# TYPE http_requests_total counter';
        $metrics = array_merge($metrics, $this->getCounterMetrics('http_requests_total'));

        // HTTP request duration
        $metrics[] = "\n# HELP http_request_duration_milliseconds HTTP request duration";
        $metrics[] = '# TYPE http_request_duration_milliseconds histogram';
        $metrics = array_merge($metrics, $this->getHistogramMetrics('http_request_duration_ms'));

        // Database metrics
        $metrics[] = "\n# HELP database_connections Database connections";
        $metrics[] = '# TYPE database_connections gauge';
        try {
            $connections = count(DB::getConnections());
            $metrics[] = "database_connections {$connections}";
        } catch (\Exception $e) {
            $metrics[] = 'database_connections 0';
        }

        // Cache metrics
        $metrics[] = "\n# HELP cache_hit_ratio Cache hit ratio";
        $metrics[] = '# TYPE cache_hit_ratio gauge';
        $hitRatio = $this->getCacheHitRatio();
        $metrics[] = "cache_hit_ratio {$hitRatio}";

        // Queue metrics
        $metrics[] = "\n# HELP queue_jobs_pending Pending queue jobs";
        $metrics[] = '# TYPE queue_jobs_pending gauge';
        $queueSize = $this->getQueueSize();
        $metrics[] = "queue_jobs_pending {$queueSize}";

        // Memory usage
        $metrics[] = "\n# HELP memory_usage_bytes Memory usage in bytes";
        $metrics[] = '# TYPE memory_usage_bytes gauge';
        $metrics[] = sprintf('memory_usage_bytes %d', memory_get_usage(true));

        $content = implode("\n", $metrics);

        return response($content, 200)
            ->header('Content-Type', 'text/plain; version=0.0.4');
    }

    /**
     * Get counter metrics
     */
    protected function getCounterMetrics(string $prefix): array
    {
        $metrics = [];
        $pattern = "metrics:counter:{$prefix}:*";

        try {
            $keys = Cache::getStore()->getRedis()->keys($pattern);

            foreach ($keys as $key) {
                $value = Cache::get($key, 0);
                $metricName = str_replace("metrics:counter:{$prefix}:", '', $key);
                $metrics[] = "{$prefix}{{$metricName}} {$value}";
            }
        } catch (\Exception $e) {
            // Fallback if not using Redis
        }

        return $metrics;
    }

    /**
     * Get histogram metrics (simplified - returns avg/max/min)
     */
    protected function getHistogramMetrics(string $prefix): array
    {
        $metrics = [];
        $pattern = "metrics:histogram:{$prefix}:*";

        try {
            $keys = Cache::getStore()->getRedis()->keys($pattern);

            foreach ($keys as $key) {
                $values = Cache::get($key, []);
                if (empty($values)) {
                    continue;
                }

                $metricName = str_replace("metrics:histogram:{$prefix}:", '', $key);
                $avg = array_sum($values) / count($values);
                $max = max($values);
                $min = min($values);

                $metrics[] = "{$prefix}_avg{{$metricName}} " . round($avg, 2);
                $metrics[] = "{$prefix}_max{{$metricName}} " . round($max, 2);
                $metrics[] = "{$prefix}_min{{$metricName}} " . round($min, 2);
            }
        } catch (\Exception $e) {
            // Fallback
        }

        return $metrics;
    }

    /**
     * Calculate cache hit ratio
     */
    protected function getCacheHitRatio(): float
    {
        $hits = Cache::get('metrics:cache:hits', 0);
        $misses = Cache::get('metrics:cache:misses', 0);
        $total = $hits + $misses;

        return $total > 0 ? round($hits / $total, 4) : 0;
    }

    /**
     * Get queue size
     */
    protected function getQueueSize(): int
    {
        try {
            return DB::table('jobs')->count();
        } catch (\Exception $e) {
            return 0;
        }
    }
}
