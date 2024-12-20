<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sub_cat_name = fake()->words(2, true);
        $sub_category_slug = getSlug($sub_cat_name);

        return [
            'category_id' => rand(1, 15),
            'title' => fake()->words(rand(5,10), true),
            'sub_cat_name' => $sub_cat_name,
            'sub_category_slug' => $sub_category_slug,
            'status' => fake()->randomElement(['Active', 'Inactive'])
        ];
    }
}
