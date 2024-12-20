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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->string('date');
            $table->string('time');
            $table->string('amount')->default(0);
            $table->string('product_quantity')->default(1);
            $table->string('product_price')->default(0);
            $table->string('addon_id')->nullable();
            $table->string('addon_quantity')->nullable();
            $table->string('addon_price')->nullable();
            $table->string('total_amount')->default(0);
            $table->enum('payment_status',['pending', 'success'])->default('pending');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('alternate_phone')->nullable();
            $table->text('current_address');
            $table->string('landmark')->nullable();
            $table->string('pincode');
            $table->string('city');
            $table->string('occasion');
            $table->string('location');
            $table->timestamps();
            $table->softDeletes();
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
