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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('city');
            $table->string('image');
            $table->string('phone');
            $table->string('city_slug');
            $table->boolean('is_popular')->default(0)->comment("0 -> false, 1 -> true");
            $table->boolean('is_menu')->default(0)->comment("0 -> false, 1 -> true");
            $table->enum( 'status', ['Active', 'Inactive'])->default('Active');
            $table->longText('keyword')->nullable();
            $table->longText('description')->nullable();
            $table->text('map')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
