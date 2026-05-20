<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeRequest;
use App\Models\Category;
use App\Models\Recipe;
use App\Services\RecipeService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    use AuthorizesRequests;

    protected $service;

    public function __construct(RecipeService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $query = Recipe::with(['category', 'user'])
            ->where('user_id', Auth::id());

        // Search by title
        if ($request->search) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        // Filter by category
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        $recipes = $query->latest()->paginate(6)->withQueryString();

        $categories = Category::all();

        return view('recipes.index', compact('recipes', 'categories'));
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
    public function store(StoreRecipeRequest $request)
    {
        $this->service->create($request->validated() + [
            'image' => $request->file('image'),
        ]);

        return redirect()->route('recipes.index')
            ->with('success', 'Recipe created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        $this->authorize('view', $recipe);

        $recipe->load(['category', 'user', 'ingredients', 'steps']);

        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        $this->authorize('update', $recipe);

        $categories = Category::all();
        $recipe->load(['ingredients', 'steps']);

        return view('recipes.edit', compact('recipe', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        $this->authorize('update', $recipe);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cooking_time' => 'nullable|integer|min:1',
            'difficulty' => 'required|in:easy,medium,hard',

            'category_id' => 'required|exists:categories,id',

            'ingredients' => 'required|array|min:1',
            'ingredients.*.name' => 'required|string|max:255',
            'ingredients.*.quantity' => 'nullable|string|max:255',

            'steps' => 'required|array|min:1',
            'steps.*.instruction' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $this->service->update($recipe, $validated + [
            'image' => $request->file('image'),
        ]);

        return redirect()->route('recipes.show', $recipe->id)
            ->with('success', 'Recipe updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $this->authorize('delete', $recipe);

        $recipe->delete();

        return redirect()->route('recipes.index')
            ->with('success', 'Recipe deleted successfully!');
    }
}
