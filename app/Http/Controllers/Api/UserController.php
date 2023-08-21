<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return 'store';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return 'show';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return 'update';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $recipes = Recipe::where('user_id', $user->id)->get();

            foreach ($recipes as $recipe) {
                RecipeIngredient::where('recipe_id', $recipe->id)->delete();
                $recipe->delete();
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Successfully deleted'
            ]);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => $err
            ]);
        }
    }
}
