<?php

namespace App\Listeners;

use App\Events\PostViewed;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TrackPostAnalytics
{
    /**
     * Handle the event.
     */
    public function handle(PostViewed $event): void
    {
        $post = $event->post;

        // Increment view count in cache (for aggregation)
        $cacheKey = "post_views:{$post->id}:" . now()->format('Y-m-d-H');
        Cache::increment($cacheKey, 1);
        Cache::expire($cacheKey, 86400); // 24 hours

        // Track unique visitors (simplified)
        if ($event->ipAddress) {
            $uniqueKey = "post_unique:{$post->id}:" . now()->format('Y-m-d') . ":{$event->ipAddress}";
            if (!Cache::has($uniqueKey)) {
                Cache::put($uniqueKey, true, 86400);
                Cache::increment("post_unique_count:{$post->id}:" . now()->format('Y-m-d'), 1);
            }
        }

        // Log analytics data
        Log::channel('analytics')->info('Post viewed', [
            'post_id' => $post->id,
            'post_slug' => $post->slug,
            'ip_address' => $event->ipAddress,
            'user_agent' => $event->userAgent,
            'timestamp' => now()->toIso8601String(),
        ]);
    }

    /**
     * Determine whether the listener should be queued.
     */
    public function shouldQueue(): bool
    {
        return true;
    }
}
