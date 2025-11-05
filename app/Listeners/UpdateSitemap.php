<?php

namespace App\Listeners;

use App\Events\PostPublished;
use App\Jobs\GenerateSitemap;

class UpdateSitemap
{
    /**
     * Handle the event.
     */
    public function handle(PostPublished $event): void
    {
        // Dispatch sitemap generation job
        GenerateSitemap::dispatch();
    }

    /**
     * Determine whether the listener should be queued.
     */
    public function shouldQueue(): bool
    {
        return true;
    }
}
