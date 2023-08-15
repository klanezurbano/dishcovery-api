<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Recipe;
use App\Models\User;
use App\Models\UserFavorite;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'admin-user',
            'role' => 'admin',
        ]);

        User::factory(10)
            ->has(Recipe::factory(6)->hasRecipeIngredients(5))
            ->create();

        UserFavorite::factory(20)->create();
    }
}
