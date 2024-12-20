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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('sub_category_id')->constrained('sub_categories')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('name');
            $table->string('product_slug');
            $table->string('thumb_img');
            $table->double('price');
            $table->double('discount_price')->nullable();
            $table->integer('discount_percentage')->nullable();
            $table->longText('inclusion')->nullable();
            $table->longText('exclusion')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->boolean('is_trending')->default(0)->comment("0 -> false, 1 -> true");
            $table->boolean('is_popular')->default(0)->comment("0 -> false, 1 -> true");
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
