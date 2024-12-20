<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(rand(3, 5), true);
        $product_slug = getSlug($name);
        $price = rand(5000, 9999);
        $discount_percentage = rand(5, 15);
        $discount_price = discountPrice($price, $discount_percentage);
        return [
            'category_id' => rand(1, 4),
            'sub_category_id' => rand(1, 4),
            'title' => fake()->words(rand(5,10), true),
            'name' => $name,
            'product_slug' => $product_slug,
            'images' => fake()->imageUrl(275, 280, null, null, "275x280", false, 'png'),
            'price' => $price,
            'discount_percentage' => $discount_percentage,
            'discount_price' => $discount_price,
            'inclusion' => collect(range(1, 3))->map(fn() => fake()->sentence(6))->toArray(),
            'exclusion' => collect(range(1, 3))->map(fn() => fake()->sentence(6))->toArray(),
            'status' => fake()->randomElement(['Active', 'Inactive']),
            'is_trending' => fake()->boolean,
            'is_popular' => fake()->boolean,
        ];
    }
}
