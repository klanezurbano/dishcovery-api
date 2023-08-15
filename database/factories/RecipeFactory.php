<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(4, true),
            'instructions' => fake()->paragraph(10),
            'image_url' => fake()->imageUrl(640, 480),
            'category' => fake()->randomElement(['Asian', 'Italian', 'American', 'Breakfast', 'Dessert', 'Filipino']),
            'user_id' => User::factory()
        ];
    }
}
