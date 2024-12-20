<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cat_name = fake()->words(2, true);
        $category_slug = getSlug($cat_name);

        return [
            'title' => fake()->words(rand(5,10), true),
            'cat_name' => $cat_name,
            'cat_image' => fake()->imageUrl(280,180, null, null, "280x180",false,'png'),
            'category_slug' => $category_slug,
            'status' => fake()->randomElement(['Active', 'Inactive']),
            'is_trending' => fake()->boolean,
            'is_popular' => fake()->boolean,
            'is_menu' => fake()->boolean
        ];
    }
}
