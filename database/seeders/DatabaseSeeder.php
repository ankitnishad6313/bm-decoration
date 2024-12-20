<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\Review;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'info@bmdecoration.com',
            'phone' => 9876543210,
            'alternate_phone' => 9876543210,
            'password' => 123456,
            'gender' => 'Male',
            'role' => 'admin',
        ]);

        // User::factory(50)->create();
        // City::factory(50)->create();

        //  // Generate Categories with SubCategories, Projects, and Reviews
        //  Category::factory()
        //  ->count(15)  // Generate 15 Categories
        //  ->has(
        //      SubCategory::factory()
        //          ->count(8)  // Each Category will have 8 SubCategories
        //          ->has(
        //              Product::factory()
        //                  ->count(100)  // Each SubCategory will have 100 Products
        //                  ->has(
        //                      Review::factory()->count(10)  // Each Project will have 10 Reviews
        //                  )
        //          )
        //  )
        //  ->create();
    }
}
