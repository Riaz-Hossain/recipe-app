<?php

namespace App\Services;

use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class RecipeService
{
    public function authorize(): bool
    {
        return true;
    }

    // CREATE & UPDATE
    // This method handles both creating and updating recipes, including image uploads, ingredient management, and step management.
    public function create(array $data)
    {
        // IMAGE
        $imagePath = null;

        if (isset($data['image'])) {
            $file = $data['image'];
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/recipes'), $fileName);
            $imagePath = 'uploads/recipes/'.$fileName;
        }

        // RECIPE CREATE
        $recipe = Recipe::create([
            'user_id' => Auth::id(),
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'cooking_time' => $data['cooking_time'],
            'difficulty' => $data['difficulty'],
            'image' => $imagePath,
        ]);

        // INGREDIENTS
        foreach ($data['ingredients'] as $ingredient) {
            $recipe->ingredients()->create([
                'name' => $ingredient['name'],
                'quantity' => $ingredient['quantity'] ?? null,
            ]);
        }

        // STEPS
        foreach ($data['steps'] as $step) {
            $recipe->steps()->create([
                'step_number' => $step['step_number'] ?? 1,
                'instruction' => $step['instruction'],
            ]);
        }

        return $recipe;
    }

    // UPDATE
    // This method updates an existing recipe, including handling image uploads, ingredient management, and step management.
    public function update($recipe, array $data)
    {
        // IMAGE
        if (isset($data['image'])) {
            $file = $data['image'];
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/recipes'), $fileName);

            $data['image'] = 'uploads/recipes/'.$fileName;
        } else {
            unset($data['image']);
        }

        // UPDATE RECIPE
        $recipe->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'cooking_time' => $data['cooking_time'],
            'difficulty' => $data['difficulty'],
            'category_id' => $data['category_id'],
            'image' => $data['image'] ?? $recipe->image,
        ]);

        // INGREDIENTS
        $recipe->ingredients()->delete();

        foreach ($data['ingredients'] as $ingredient) {
            $recipe->ingredients()->create([
                'name' => $ingredient['name'],
                'quantity' => $ingredient['quantity'] ?? null,
            ]);
        }

        // STEPS
        $recipe->steps()->delete();

        foreach ($data['steps'] as $step) {
            $recipe->steps()->create([
                'step_number' => $step['step_number'] ?? 1,
                'instruction' => $step['instruction'],
            ]);
        }

        return $recipe;
    }
}
