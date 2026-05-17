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

        <h1 class="text-2xl font-bold mb-6">➕ Create Recipe</h1>

        <form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class=" @error('title') border-red-500 @enderror w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
            </div>
            @error('title')
                <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
            @enderror

            <!-- Description -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Description</label>
                <textarea name="description" rows="4"
                    class=" @error('description') border-red-500 @enderror w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">{{ old('description') }}</textarea>
            </div>
            @error('description')
                <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
            @enderror

            <!-- Cooking Time -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Cooking Time (minutes)</label>
                <input type="number" name="cooking_time" value="{{ old('cooking_time') }}"
                    class=" @error('cooking_time') border-red-500 @enderror w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
            </div>
            @error('cooking_time')
                <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
            @enderror

            <!-- Difficulty -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Difficulty</label>
                <select name="difficulty"
                    class=" @error('difficulty') border-red-500 @enderror w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
                    <option value="">Select</option>
                    <option value="easy">Easy</option>
                    <option value="medium">Medium</option>
                    <option value="hard">Hard</option>
                </select>
            </div>
            @error('difficulty')
                <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
            @enderror

            <!-- Category -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Category</label>
                <select name="category_id"
                    class=" @error('category_id') border-red-500 @enderror w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
                <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
            @enderror

            <!-- Image Upload -->
            <div class="mb-6">
                <label class="block font-medium mb-1">Recipe Image</label>

                <input type="file" name="image" accept="image/*" onchange="previewImage(event)"
                    class="w-full border rounded-lg p-2">

                <!-- Preview -->
                <div class="mt-4">
                    <img id="imagePreview" src="{{ isset($recipe) && $recipe->image ? asset($recipe->image) : '' }}"
                        class="w-48 rounded-lg shadow {{ isset($recipe) && $recipe->image ? '' : 'hidden' }}">
                </div>
            </div>
            @error('image')
                <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
            @enderror

            <hr class="my-6">

            <!-- INGREDIENTS -->
            <h2 class="text-xl font-semibold mb-3">Ingredients</h2>


            <div class="flex gap-2 mb-2 items-center">
                <input type="text" name="ingredients[${ingredientIndex}][name]" class="w-1/2 border rounded-lg p-2">

                <input type="text" name="ingredients[${ingredientIndex}][quantity]" class="w-1/2 border rounded-lg p-2">

                <button type="button" onclick="removeItem(this)" class="bg-red-500 text-white px-3 py-1 rounded-lg">
                    ✕
                </button>
            </div>

            @error('ingredients')
                <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
            @enderror
            @error('ingredients.*.name')
                <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
            @enderror
            @error('ingredients.*.quantity')
                <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
            @enderror

            <button type="button" onclick="addIngredient()" class="text-blue-500 mb-6">+ Add Ingredient</button>

            <hr class="my-6">

            <!-- STEPS -->
            <h2 class="text-xl font-semibold mb-3">Steps</h2>

            <div class="mb-2 flex gap-2 items-center">
                <textarea name="steps[${stepIndex}][instruction]" class="w-full border rounded-lg p-2"></textarea>

                <button type="button" onclick="removeItem(this)" class="bg-red-500 text-white px-3 py-1 rounded-lg">
                    ✕
                </button>
            </div>
            @error('steps')
                <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
            @enderror
            @error('steps.*.instruction')
                <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
            @enderror


            <button type="button" onclick="addStep()" class="text-blue-500 mb-6">+ Add Step</button>

            <!-- Submit -->
            <div class="flex justify-between items-center">
                <a href="{{ route('recipes.index') }}" class="text-gray-500 hover:underline">
                    ← Back
                </a>

                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg shadow">
                    Create Recipe
                </button>
            </div>

        </form>

    </div>

    <!-- JS for dynamic fields -->
    <script>
        let ingredientIndex = 1;

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



        let stepIndex = 1;

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



        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


@endsection
