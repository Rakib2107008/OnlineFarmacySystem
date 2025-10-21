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
        Schema::create('customer_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->string('receiver_name')->nullable();
            $table->string('receiver_phone');
            $table->string('region');
            $table->string('city');
            $table->string('area')->nullable();
            $table->text('address');
            $table->string('payment_method');
            $table->string('coupon_code')->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->string('transaction_id')->unique();
            $table->enum('status', ['pending', 'confirmed', 'failed', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['unpaid', 'paid', 'failed', 'refunded'])->default('unpaid');
            $table->timestamps();
        });

        Schema::create('customer_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_order_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('medicine_id')->nullable();
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
            $table->foreign('medicine_id')->references('id')->on('medicines')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_order_items');
        Schema::dropIfExists('customer_orders');
    }
};
