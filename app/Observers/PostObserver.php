<?php

namespace App\Observers;

use App\Events\PostUpdated;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    /**
     * Handle the Post "saving" event.
     * Auto-set published_at when status changes to 'published'
     */
    public function saving(Post $post): void
    {
        // If status is being set to 'published' and published_at is not set
        if ($post->status === 'published' && !$post->published_at) {
            $post->published_at = now();
        }

        // If status is changed from 'published' to something else, clear published_at
        if ($post->isDirty('status') && $post->getOriginal('status') === 'published' && $post->status !== 'published') {
            $post->published_at = null;
        }
    }

    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        // Dispatch event for cache invalidation
        PostUpdated::dispatch($post, $post->getOriginal('status'));

        // Clear response cache for this post
        $this->clearPostCache($post);
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        // Clear cache when post is deleted
        $this->clearPostCache($post);
    }

    /**
     * Clear all caches related to this post
     */
    protected function clearPostCache(Post $post): void
    {
        // Clear specific post cache
        Cache::forget("response_cache:*posts/{$post->slug}*");

        // Clear posts list cache
        Cache::forget('response_cache:*posts*');

        // Clear category cache if exists
        if ($post->category_id && $post->category) {
            Cache::forget("response_cache:*categories/{$post->category->slug}*");
        }
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
