<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Add index for view_count (used for sorting by popularity)
            $table->index('view_count', 'posts_view_count_index');

            // Add composite indexes for common query patterns
            $table->index(['status', 'published_at'], 'posts_status_published_at_index');
            $table->index(['category_id', 'status'], 'posts_category_status_index');
            $table->index(['author_id', 'status'], 'posts_author_status_index');

            // Add index for scheduled posts query
            $table->index(['status', 'scheduled_at'], 'posts_status_scheduled_at_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex('posts_view_count_index');
            $table->dropIndex('posts_status_published_at_index');
            $table->dropIndex('posts_category_status_index');
            $table->dropIndex('posts_author_status_index');
            $table->dropIndex('posts_status_scheduled_at_index');
        });
    }
};
