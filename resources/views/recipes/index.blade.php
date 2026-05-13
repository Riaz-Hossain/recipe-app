@extends('layouts.app')

@section('content')
    <form method="GET" action="{{ route('recipes.index') }}" class="mb-6 flex flex-col md:flex-row gap-3">

        <!-- Search Input -->
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search recipes..."
            class="border rounded-lg p-2 w-full md:w-1/3">

        <!-- Category Filter -->
        <select name="category" class="border rounded-lg p-2 w-full md:w-1/4">

            <option value="">All Categories</option>

            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <!-- Submit -->
        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">
            Search
        </button>

    </form>

    <h1 class="text-2xl font-bold mb-6">Recipes</h1>

    <!-- add new recipe button -->
    <div class="mb-6">
        <a href="{{ route('recipes.create') }}" class="bg-black text-white px-4 py-2 rounded">
            ➕ Add New Recipe
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @foreach ($recipes as $recipe)
            <div class="bg-white rounded-xl shadow p-4">

                @if ($recipe->image)
                    <img src="{{ asset($recipe->image) }}" class="rounded-lg mb-3">
                @endif

                <h2 class="text-lg font-semibold">
                    <a href="{{ route('recipes.show', $recipe->id) }}">
                        {{ $recipe->title }}
                    </a>
                </h2>

                <p class="text-sm text-gray-500">
                    {{ $recipe->category?->name ?? 'No Category' }}
                </p>

                <p class="text-sm">
                    ⏱ {{ $recipe->cooking_time }} min
                </p>

            </div>
        @endforeach

    </div>

    @if ($recipes->isEmpty())
        <p class="text-gray-500 mt-4">No recipes found.</p>
    @endif
@endsection
