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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            //the user who made the order
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //price of the order
            $table->decimal('total_price', 10, 2);
            //status of the order
            $table->enum('status', ['pending', 'completed', 'canceled'])->default('pending');
            //payment method with stripe for default
            $table->enum('payment_method', ['stripe', 'paypal'])->default('stripe');
            //shipping address and can be null
            $table->string('shipping_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
