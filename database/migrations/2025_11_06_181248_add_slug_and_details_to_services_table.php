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
        Schema::table('services', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
            $table->longText('content')->nullable()->after('description');
            $table->json('benefits')->nullable()->after('content');
        });

        // Generate slugs for existing records
        DB::table('services')->whereNull('slug')->orWhere('slug', '')->get()->each(function ($service) {
            $slug = Str::slug($service->title);
            $count = 1;
            $originalSlug = $slug;

            // Handle duplicate slugs
            while (DB::table('services')->where('slug', $slug)->where('id', '!=', $service->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            DB::table('services')->where('id', $service->id)->update(['slug' => $slug]);
        });

        // Now make slug unique and indexed
        Schema::table('services', function (Blueprint $table) {
            $table->string('slug')->unique()->change();
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex(['slug']);
            $table->dropColumn(['slug', 'content', 'benefits']);
        });
    }
};
