<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'instructions' => $this->instructions,
            'imageUrl' => $this->image_url,
            'category' => $this->category,
            'recipeIngredients' => RecipeIngredientResource::collection($this->whenLoaded('recipeIngredients')),
            'author' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
