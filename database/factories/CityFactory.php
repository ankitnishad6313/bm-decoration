<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $city = fake()->city();
        $city_slug = getSlug($city);

        return [
            'title' => fake()->words(rand(5,10), true),
            'city' => $city,
            'city_slug' => $city_slug,
            'is_popular' => fake()->boolean,
            'is_menu' => fake()->boolean
        ];
    }
}
