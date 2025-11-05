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
        Schema::table('portfolio_items', function (Blueprint $table) {
            // Drop old image column if exists
            if (Schema::hasColumn('portfolio_items', 'image')) {
                $table->dropColumn('image');
            }

            // Add new columns
            $table->json('images')->nullable()->after('description');
            $table->decimal('rating', 3, 1)->default(0)->after('url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->dropColumn(['images', 'rating']);
            $table->string('image')->nullable();
        });
    }
};
