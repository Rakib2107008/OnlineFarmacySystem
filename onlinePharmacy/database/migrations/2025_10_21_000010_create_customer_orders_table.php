<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_orders', function (Blueprint $table) {
            $table->id();
            $table->string('receiver_name')->nullable();
            $table->string('receiver_phone');
            $table->string('region');
            $table->string('city');
            $table->string('area')->nullable();
            $table->text('address');
            $table->string('payment_method');
            $table->json('cart_totals')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });

        Schema::create('customer_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_order_id')->constrained('customer_orders')->cascadeOnDelete();
            $table->unsignedBigInteger('item_id');
            $table->string('item_type');
            $table->unsignedInteger('quantity');
            $table->decimal('price', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_order_items');
        Schema::dropIfExists('customer_orders');
    }
};
