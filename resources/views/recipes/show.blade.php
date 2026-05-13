@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow rounded-xl p-6">

        <h1 class="text-3xl font-bold mb-4">{{ $recipe->title }}</h1>

        <p class="text-gray-500 mb-4">
            📂 {{ $recipe->category?->name ?? 'No Category' }} |
            👤 {{ $recipe->user?->name ?? 'Unknown' }} |
            ⏱ {{ $recipe->cooking_time }} min |
            🔥 {{ ucfirst($recipe->difficulty) }}
        </p>

        @if ($recipe->image)
            <img src="{{ asset($recipe->image) }}" class="rounded-lg mb-6">
        @endif

        <h2 class="text-xl font-semibold mb-2">Description</h2>
        <p class="mb-6">{{ $recipe->description }}</p>

        <h2 class="text-xl font-semibold mb-2">Ingredients</h2>
        <ul class="list-disc pl-5 mb-6">
            @foreach ($recipe->ingredients as $ingredient)
                <li>{{ $ingredient->name }} - {{ $ingredient->quantity }}</li>
            @endforeach
        </ul>

        <h2 class="text-xl font-semibold mb-2">Steps</h2>
        <ol class="list-decimal pl-5 mb-6">
            @foreach ($recipe->steps as $step)
                <li>{{ $step->instruction }}</li>
            @endforeach
        </ol>

        <div class="flex gap-4">
            <a href="{{ route('recipes.edit', $recipe->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                Edit
            </a>

            <form method="POST" action="{{ route('recipes.destroy', $recipe->id) }}">
                @csrf
                @method('DELETE')

                <button class="bg-red-500 text-white px-4 py-2 rounded">
                    Delete
                </button>
            </form>
        </div>

    </div>
@endsection
