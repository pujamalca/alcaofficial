<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
            $table->longText('content')->nullable()->after('description');
            $table->string('client_name')->nullable()->after('content');
            $table->date('project_date')->nullable()->after('client_name');
            $table->json('technologies')->nullable()->after('project_date');
        });

        // Generate slugs for existing records
        DB::table('portfolio_items')->whereNull('slug')->orWhere('slug', '')->get()->each(function ($item) {
            $slug = Str::slug($item->title);
            $count = 1;
            $originalSlug = $slug;

            // Handle duplicate slugs
            while (DB::table('portfolio_items')->where('slug', $slug)->where('id', '!=', $item->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            DB::table('portfolio_items')->where('id', $item->id)->update(['slug' => $slug]);
        });

        // Now make slug unique and indexed
        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->string('slug')->unique()->change();
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->dropIndex(['slug']);
            $table->dropColumn(['slug', 'content', 'client_name', 'project_date', 'technologies']);
        });
    }
};
