@extends('layouts.app')

@section('content')

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
            <strong>Something went wrong:</strong>
            <ul class="mt-2 list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-6">

        <h1 class="text-2xl font-bold mb-6">✏️ Edit Recipe</h1>

        <form method="POST" action="{{ route('recipes.update', $recipe->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Title</label>
                <input type="text" name="title" value="{{ $recipe->title }}"
                    class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Description</label>
                <textarea name="description" class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200" rows="4">{{ $recipe->description }}</textarea>
            </div>

            <!-- Cooking Time -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Cooking Time (minutes)</label>
                <input type="number" name="cooking_time" value="{{ $recipe->cooking_time }}"
                    class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
            </div>

            <!-- Difficulty -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Difficulty</label>
                <select name="difficulty" class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
                    <option value="easy" {{ $recipe->difficulty == 'easy' ? 'selected' : '' }}>Easy</option>
                    <option value="medium" {{ $recipe->difficulty == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="hard" {{ $recipe->difficulty == 'hard' ? 'selected' : '' }}>Hard</option>
                </select>
            </div>

            <!-- Category -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Category</label>
                <select name="category_id" class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $recipe->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <hr class="my-6">

            <h2 class="text-xl font-semibold mb-3">Ingredients</h2>

            <div id="ingredients-container">
                @foreach ($recipe->ingredients as $index => $ingredient)
                    <div class="flex gap-2 mb-2 items-center">
                        <input type="text" name="ingredients[{{ $index }}][name]"
                            value="{{ $ingredient->name }}" class="w-1/2 border rounded-lg p-2">

                        <input type="text" name="ingredients[{{ $index }}][quantity]"
                            value="{{ $ingredient->quantity }}" class="w-1/2 border rounded-lg p-2">

                        <button type="button" onclick="removeItem(this)"
                            class="bg-red-500 text-white px-3 py-1 rounded-lg">
                            ✕
                        </button>
                    </div>
                @endforeach
            </div>

            <button type="button" onclick="addIngredient()" class="text-blue-500 mb-6">+ Add Ingredient</button>

            <hr class="my-6">

            <h2 class="text-xl font-semibold mb-3">Steps</h2>

            <div id="steps-container">
                @foreach ($recipe->steps as $index => $step)
                    <div class="mb-2 flex gap-2 items-center">
                        <textarea name="steps[{{ $index }}][instruction]" class="w-full border rounded-lg p-2">{{ $step->instruction }}</textarea>

                        <button type="button" onclick="removeItem(this)"
                            class="bg-red-500 text-white px-3 py-1 rounded-lg">
                            ✕
                        </button>
                    </div>
                @endforeach
            </div>

            <button type="button" onclick="addStep()" class="text-blue-500 mb-6">+ Add Step</button>

            <!-- Current Image -->
            @if ($recipe->image)
                <div class="mb-4">
                    <label class="block font-medium mb-1">Current Image</label>
                    <img src="{{ asset($recipe->image) }}" class="w-40 rounded-lg shadow">
                </div>
            @endif

            <!-- Upload New Image -->
            <div class="mb-6">
                <label class="block font-medium mb-1">Change Image</label>
                <input type="file" name="image" class="w-full border rounded-lg p-2">
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center">

                <a href="{{ route('recipes.show', $recipe->id) }}" class="text-gray-500 hover:underline">
                    ← Back
                </a>

                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg shadow">
                    Update Recipe
                </button>

            </div>

        </form>

    </div>

    <script>
        let ingredientIndex = {{ $recipe->ingredients->count() }};
        let stepIndex = {{ $recipe->steps->count() }};

        function addIngredient() {
            const container = document.getElementById('ingredients-container');

            const html = `
        <div class="flex gap-2 mb-2">
            <input type="text" name="ingredients[${ingredientIndex}][name]" placeholder="Ingredient name"
                class="w-1/2 border rounded-lg p-2">
            <input type="text" name="ingredients[${ingredientIndex}][quantity]" placeholder="Quantity"
                class="w-1/2 border rounded-lg p-2">
        </div>
    `;

            container.insertAdjacentHTML('beforeend', html);
            ingredientIndex++;
        }

        function addStep() {
            const container = document.getElementById('steps-container');

            const html = `
        <div class="mb-2">
            <textarea name="steps[${stepIndex}][instruction]" placeholder="Step instruction"
                class="w-full border rounded-lg p-2"></textarea>
        </div>
    `;

            container.insertAdjacentHTML('beforeend', html);
            stepIndex++;
        }

        function removeItem(button) {
            button.closest('div').remove();
        }
    </script>

@endsection
