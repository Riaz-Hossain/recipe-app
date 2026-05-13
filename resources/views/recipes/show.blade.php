@extends('layouts.app')

@section('content')
    <div class="grid md:grid-cols-3 gap-8">

        <!-- LEFT -->
        <div class="md:col-span-2">

            <h1 class="text-4xl font-bold mb-2">{{ $recipe->title }}</h1>

            <p class="text-gray-500 mb-4">
                {{ $recipe->category?->name ?? 'Uncategorized' }} •
                {{ $recipe->cooking_time }} min •
                {{ ucfirst($recipe->difficulty) }}
            </p>

            @if ($recipe->image)
                <img src="{{ asset($recipe->image) }}" class="rounded-2xl mb-6 w-full">
            @endif

            <h2 class="text-xl font-semibold mb-2">Description</h2>
            <p class="text-gray-600 mb-6">{{ $recipe->description }}</p>

            <h2 class="text-xl font-semibold mb-2">Steps</h2>
            <ol class="list-decimal pl-5 space-y-2">
                @foreach ($recipe->steps as $step)
                    <li>{{ $step->instruction }}</li>
                @endforeach
            </ol>

        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="bg-white shadow rounded-2xl p-4 h-fit">

            <h3 class="font-semibold mb-2">Ingredients</h3>

            <ul class="space-y-2">
                @foreach ($recipe->ingredients as $ingredient)
                    <li class="flex justify-between text-sm">
                        <span>{{ $ingredient->name }}</span>
                        <span class="text-gray-500">{{ $ingredient->quantity }}</span>
                    </li>
                @endforeach
            </ul>

            <div class="mt-6 flex gap-2">
                <a href="{{ route('recipes.edit', $recipe->id) }}"
                    class="bg-blue-500 text-white px-3 py-2 rounded-lg text-sm w-full text-center">
                    Edit
                </a>

                <form method="POST" action="{{ route('recipes.destroy', $recipe->id) }}" class="w-full">
                    @csrf
                    @method('DELETE')

                    <button class="bg-red-500 text-white px-3 py-2 rounded-lg text-sm w-full">
                        Delete
                    </button>
                </form>
            </div>

        </div>

    </div>
@endsection
