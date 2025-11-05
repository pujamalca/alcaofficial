<?php

namespace App\Listeners;

use App\Events\PostPublished;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class NotifySubscribers
{
    /**
     * Handle the event.
     */
    public function handle(PostPublished $event): void
    {
        $post = $event->post;

        // Log for now - can be extended to send actual notifications
        Log::info('Post published - ready to notify subscribers', [
            'post_id' => $post->id,
            'post_title' => $post->title,
            'author_id' => $post->author_id,
        ]);

        // TODO: Implement actual subscriber notification
        // Example:
        // $subscribers = User::whereHas('subscriptions', function($q) use ($post) {
        //     $q->where('category_id', $post->category_id);
        // })->get();
        //
        // Notification::send($subscribers, new NewPostNotification($post));
    }

    /**
     * Determine whether the listener should be queued.
     */
    public function shouldQueue(): bool
    {
        return true; // Queue this for better performance
    }
}
