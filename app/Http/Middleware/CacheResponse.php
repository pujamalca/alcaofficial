<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CacheResponse
{
    /**
     * Handle an incoming request.
     *
     * Cache GET requests for specified duration (in seconds).
     * Usage: ->middleware('cache.response:600') for 10 minutes
     */
    public function handle(Request $request, Closure $next, int $ttl = 600): Response
    {
        // Only cache GET requests
        if (! $request->isMethod('GET')) {
            return $next($request);
        }

        // Don't cache authenticated requests
        if ($request->user()) {
            return $next($request);
        }

        // Generate cache key from URL and query parameters
        $cacheKey = $this->getCacheKey($request);

        // Try to get from cache
        $cachedResponse = Cache::get($cacheKey);

        if ($cachedResponse !== null) {
            return response()->json(
                json_decode($cachedResponse, true),
                200,
                ['X-Cache' => 'HIT']
            );
        }

        // Get fresh response
        $response = $next($request);

        // Only cache successful JSON responses
        if ($response instanceof JsonResponse && $response->isSuccessful()) {
            Cache::put($cacheKey, $response->getContent(), $ttl);
            $response->headers->set('X-Cache', 'MISS');
            $response->headers->set('X-Cache-TTL', (string) $ttl);
        }

        return $response;
    }

    /**
     * Generate cache key from request
     */
    protected function getCacheKey(Request $request): string
    {
        $url = $request->fullUrl();
        $locale = app()->getLocale();

        return 'response_cache:' . md5($url . ':' . $locale);
    }
}
