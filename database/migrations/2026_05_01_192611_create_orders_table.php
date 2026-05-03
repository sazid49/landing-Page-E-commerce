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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique()->nullable();

            $table->string('name');
            $table->string('phone');
            $table->text('address');

            $table->enum('type', ['single', 'multi'])->default('single');

            $table->decimal('total_amount', 10, 2)->default(0);
            $table->integer('delivery_charge');   // 60 / 120
            $table->integer('grand_total');       // subtotal + delivery

            // Delivery Info
            $table->string('delivery_area');

            $table->enum('status', ['pending', 'confirmed', 'shipped', 'delivered', 'cancelled'])
                ->default('pending');
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
