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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('cat_name');
            $table->string('cat_image');
            $table->string('category_slug');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->boolean('is_trending')->default(0)->comment("0 -> false, 1 -> true");
            $table->boolean('is_popular')->default(0)->comment("0 -> false, 1 -> true");
            $table->boolean('is_menu')->default(0)->comment("0 -> false, 1 -> true");
            $table->longText('description')->nullable();
            $table->longText('meta_keywords')->nullable();
            $table->longText('meta_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
