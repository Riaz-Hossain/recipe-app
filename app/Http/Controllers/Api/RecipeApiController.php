<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeApiController extends Controller
{
    // GET /api/recipes
    public function index(Request $request)
    {
        $user = $request->user();

        return response()->json(
            Recipe::with(['category', 'ingredients', 'steps'])
                ->where('user_id', $user->id)
                ->latest()
                ->paginate(10)
        );
    }

    // POST /api/recipes
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $recipe = Recipe::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'cooking_time' => $request->cooking_time,
            'difficulty' => $request->difficulty,
        ]);

        return response()->json([
            'message' => 'Recipe created successfully',
            'data' => $recipe,
        ], 201);
    }

    // GET /api/recipes/{recipe}
    public function show(Request $request, Recipe $recipe)
    {
        $this->authorizeRecipe($request, $recipe);

        return response()->json(
            $recipe->load(['category', 'ingredients', 'steps'])
        );
    }

    // PUT /api/recipes/{recipe}
    public function update(Request $request, Recipe $recipe)
    {
        $this->authorizeRecipe($request, $recipe);

        $recipe->update($request->only([
            'title',
            'description',
            'category_id',
            'cooking_time',
            'difficulty',
        ]));

        return response()->json([
            'message' => 'Recipe updated successfully',
            'data' => $recipe,
        ]);
    }

    // DELETE /api/recipes/{recipe}
    public function destroy(Request $request, Recipe $recipe)
    {
        $this->authorizeRecipe($request, $recipe);

        $recipe->delete();

        return response()->json([
            'message' => 'Recipe deleted successfully',
        ]);
    }

    // 🔒 simple ownership check
    private function authorizeRecipe(Request $request, Recipe $recipe)
    {
        if ($recipe->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }
    }
}
