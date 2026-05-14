<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {

            $table->id('order_item_id');

            // Foreign keys
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');

            $table->integer('quantity');
            $table->decimal('price_at_purchase', 10, 2);

            $table->timestamps();

            // Relationships
            $table->foreign('order_id')
                ->references('order_id')
                ->on('orders')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id') // assumes products table has id
                ->on('products')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};