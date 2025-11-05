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
        Schema::create('source_codes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->nullable()->constrained('source_code_categories')->nullOnDelete();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();

            // Pricing
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->string('currency', 3)->default('IDR');

            // Upload Method
            $table->enum('upload_type', ['file', 'external_link'])->default('file');
            $table->string('file_path')->nullable();
            $table->string('external_link')->nullable();

            // Preview Images (JSON array)
            $table->json('preview_images')->nullable();
            $table->string('thumbnail')->nullable();

            // Demo & Documentation
            $table->string('demo_link')->nullable();
            $table->string('documentation_link')->nullable();

            // Technology Stack (JSON array)
            $table->json('tech_stack')->nullable();

            // Features (JSON array with repeater)
            $table->json('features')->nullable();

            // Version & Requirements
            $table->string('version')->default('1.0.0');
            $table->text('requirements')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            // Stats
            $table->unsignedInteger('downloads_count')->default(0);
            $table->unsignedInteger('views_count')->default(0);
            $table->decimal('rating', 3, 1)->nullable();

            // Management
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('source_codes');
    }
};
