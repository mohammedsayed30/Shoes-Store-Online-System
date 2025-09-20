<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            //the order that the item belongs to
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            //the product that the item as a string
            $table->string('product_variant_id');
            //the name of the product in the order
            $table->string('product_name');
            //the quantity of the product in the order
            $table->integer('quantity');
            //the price of the product in the order
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
