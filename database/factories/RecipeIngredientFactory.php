<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RecipeIngredient>
 */
class RecipeIngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ingredient' => fake()->randomElement(['eggs', 'sugar', 'salt', 'soy sauce', 'milk', 'chicken', 'pork', 'tomatoes']),
            'measurement' => fake()->randomElement(['2 tbsp', '3 spoons', '1kg', '1 tbsp', '3 cups']),
            'recipe_id' => Recipe::factory(),
        ];
    }
}
