<?php

namespace App\Listeners;

use App\Events\PostUpdated;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ClearPostCache
{
    /**
     * Handle the event.
     */
    public function handle(PostUpdated $event): void
    {
        $post = $event->post;

        // Clear cached response for this specific post
        $this->clearPostDetailCache($post->slug);

        // Clear posts list cache (all variations)
        $this->clearPostsListCache();

        // Clear category cache if post has category
        if ($post->category_id) {
            $this->clearCategoryCache($post->category);
        }

        Log::info('Cache cleared for post', [
            'post_id' => $post->id,
            'post_slug' => $post->slug,
        ]);
    }

    /**
     * Clear cache for specific post detail
     */
    protected function clearPostDetailCache(string $slug): void
    {
        $pattern = "response_cache:*posts/{$slug}*";
        $this->clearCacheByPattern($pattern);
    }

    /**
     * Clear cache for posts list
     */
    protected function clearPostsListCache(): void
    {
        $pattern = 'response_cache:*posts*';
        $this->clearCacheByPattern($pattern);
    }

    /**
     * Clear cache for category
     */
    protected function clearCategoryCache($category): void
    {
        if (! $category) {
            return;
        }

        $pattern = "response_cache:*categories/{$category->slug}*";
        $this->clearCacheByPattern($pattern);
    }

    /**
     * Clear cache by pattern (works with Redis)
     */
    protected function clearCacheByPattern(string $pattern): void
    {
        try {
            $cacheStore = Cache::getStore();

            // Check if using Redis
            if (method_exists($cacheStore, 'getRedis')) {
                $redis = $cacheStore->getRedis();
                $keys = $redis->keys($pattern);

                if (! empty($keys)) {
                    $redis->del($keys);
                }
            } else {
                // Fallback: Clear entire cache if not using Redis
                Cache::flush();
            }
        } catch (\Exception $e) {
            Log::warning('Failed to clear cache by pattern', [
                'pattern' => $pattern,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
