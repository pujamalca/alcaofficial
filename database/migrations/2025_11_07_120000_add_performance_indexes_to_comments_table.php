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
        Schema::table('comments', function (Blueprint $table) {
            // Index for sorting comments by created_at (used in BlogController line 61)
            $table->index('created_at', 'comments_created_at_index');

            // Composite index for querying approved comments with sorting
            $table->index(['is_approved', 'created_at'], 'comments_approved_created_index');

            // Composite index for reply queries with approval filter
            $table->index(['parent_id', 'is_approved'], 'comments_parent_approved_index');
        });

        // Add index to post_tag pivot table for tag filtering
        Schema::table('post_tag', function (Blueprint $table) {
            $table->index('tag_id', 'post_tag_tag_id_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropIndex('comments_created_at_index');
            $table->dropIndex('comments_approved_created_index');
            $table->dropIndex('comments_parent_approved_index');
        });

        Schema::table('post_tag', function (Blueprint $table) {
            $table->dropIndex('post_tag_tag_id_index');
        });
    }
};
