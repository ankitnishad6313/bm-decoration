<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(50)->create();
        Product::factory()
            ->count(20)  // Each SubCategory will have 20 Products
            ->has(
                Review::factory()->count(10)  // Each Project will have 10 Reviews
            )->create();
    }
}
