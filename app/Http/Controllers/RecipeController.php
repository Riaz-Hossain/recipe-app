<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::with(['category', 'user', 'ingredients', 'steps'])->get();

        return view('recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('recipes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. VALIDATION FIRST
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cooking_time' => 'nullable|integer',
            'difficulty' => 'required|in:easy,medium,hard',
            'category_id' => 'required|exists:categories,id',
        ]);

        // 2. IMAGE UPLOAD
        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $fileName = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('uploads/recipes'), $fileName);

            $imagePath = 'uploads/recipes/'.$fileName;
        }
        // dd($imagePath);
        // 3. CREATE RECIPE FIRST
        $recipe = Recipe::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'cooking_time' => $request->cooking_time,
            'difficulty' => $request->difficulty,
            'image' => $imagePath,
        ]);

        // 4. INGREDIENTS
        if ($request->ingredients) {
            foreach ($request->ingredients as $ingredient) {
                if (! empty($ingredient['name'])) {
                    $recipe->ingredients()->create([
                        'name' => $ingredient['name'],
                        'quantity' => $ingredient['quantity'] ?? null,
                    ]);
                }
            }
        }

        // 5. STEPS
        if ($request->steps) {
            foreach ($request->steps as $step) {
                if (! empty($step['instruction'])) {
                    $recipe->steps()->create([
                        'step_number' => $step['step_number'] ?? 1,
                        'instruction' => $step['instruction'],
                    ]);
                }
            }
        }

        return redirect()->route('recipes.index')
            ->with('success', 'Recipe created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        $recipe->load(['category', 'user', 'ingredients', 'steps']);

        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        //
    }
}
