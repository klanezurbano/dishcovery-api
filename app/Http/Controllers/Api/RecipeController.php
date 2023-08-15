<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecipeStoreRequest;
use App\Http\Requests\RecipeUpdateRequest;
use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Recipe::query();

        if (isset($request->category)) {
            $query->where('category', $request->category);
        }

        return RecipeResource::collection($query->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecipeStoreRequest $request)
    {
        return RecipeResource::make(
            Recipe::create([
                'name' => $request->name,
                'instructions' => $request->instructions,
                'category' => $request->category,
                'user_id' => $request->userId
            ])
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        return RecipeResource::make($recipe);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecipeUpdateRequest $request, Recipe $recipe)
    {
        if (isset($request->name)) {
            $recipe->name = $request->name;
        }

        if (isset($request->instructions)) {
            $recipe->instructions = $request->instructions;
        }

        if (isset($request->category)) {
            $recipe->category = $request->category;
        }

        if (isset($request->userId)) {
            $recipe->user_id = $request->userId;
        }

        $recipe->save();

        return RecipeResource::make($recipe);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted'
        ]);
    }
}
