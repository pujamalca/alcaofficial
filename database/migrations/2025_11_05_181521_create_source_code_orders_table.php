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
        Schema::create('source_code_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('source_code_id')->constrained()->cascadeOnDelete();

            // Customer Info (for guest checkout)
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();

            // Order Details
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('IDR');
            $table->text('notes')->nullable();

            // Payment
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            $table->enum('payment_method', ['manual_transfer', 'ewallet', 'credit_card', 'other'])->nullable();
            $table->string('payment_proof')->nullable();
            $table->timestamp('paid_at')->nullable();

            // Access Control
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            $table->string('download_token')->unique()->nullable();
            $table->unsignedInteger('download_count')->default(0);
            $table->unsignedInteger('max_downloads')->default(3);
            $table->timestamp('expires_at')->nullable();

            // Admin notes
            $table->text('admin_notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('source_code_orders');
    }
};
