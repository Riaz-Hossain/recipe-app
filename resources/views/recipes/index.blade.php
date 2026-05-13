@extends('layouts.app')

@section('content')
    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold">Discover Recipes</h1>
        <p class="text-gray-500">Find, cook and share amazing food ideas</p>
    </div>

    <!-- SEARCH BAR -->
    <form method="GET" action="{{ route('recipes.index') }}" class="bg-white p-4 rounded-xl shadow mb-6 flex gap-3">

        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search recipes..."
            class="w-full border rounded-lg p-2">

        <select name="category" class="border rounded-lg p-2">
            <option value="">All</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button class="bg-black text-white px-4 py-2 rounded-lg">
            Search
        </button>
    </form>

    <!-- CARDS -->
    <div class="grid md:grid-cols-3 gap-6">

        @foreach ($recipes as $recipe)
            <a href="{{ route('recipes.show', $recipe->id) }}"
                class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">

                <!-- IMAGE -->
                @if ($recipe->image)
                    <img src="{{ asset($recipe->image) }}" class="h-40 w-full object-cover">
                @else
                    <div class="h-40 bg-gray-200"></div>
                @endif

                <div class="p-4">

                    <h2 class="font-semibold text-lg">{{ $recipe->title }}</h2>

                    <p class="text-sm text-gray-500">
                        {{ $recipe->category?->name ?? 'Uncategorized' }}
                    </p>

                    <div class="mt-2 text-sm text-gray-600 flex justify-between">
                        <span>⏱ {{ $recipe->cooking_time }} min</span>
                        <span>🔥 {{ ucfirst($recipe->difficulty) }}</span>
                    </div>

                </div>

            </a>
        @endforeach

    </div>

    <!-- PAGINATION -->
    <div class="mt-8 flex justify-center">
        {{ $recipes->links() }}
    </div>
@endsection
