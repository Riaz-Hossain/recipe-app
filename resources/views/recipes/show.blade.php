@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-10">

        <div class="grid lg:grid-cols-3 gap-8">

            <!-- MAIN CONTENT -->
            <div class="lg:col-span-2 space-y-8">

                <!-- IMAGE -->
                @if ($recipe->image)
                    <div class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm">
                        <img src="{{ asset($recipe->image) }}"
                            class="w-full h-[420px] object-cover">
                    </div>
                @endif

                <!-- HEADER -->
                <div>
                    <div class="flex flex-wrap items-center gap-2 mb-4">

                        <span
                            class="bg-gray-100 text-gray-700 text-xs font-medium px-3 py-1 rounded-full">
                            {{ $recipe->category?->name ?? 'Uncategorized' }}
                        </span>

                        <span
                            class="bg-gray-100 text-gray-700 text-xs font-medium px-3 py-1 rounded-full">
                            {{ $recipe->cooking_time }} min
                        </span>

                        <span
                            class="bg-gray-100 text-gray-700 text-xs font-medium px-3 py-1 rounded-full capitalize">
                            {{ $recipe->difficulty }}
                        </span>

                    </div>

                    <h1 class="text-4xl md:text-5xl font-bold tracking-tight text-gray-900 mb-4">
                        {{ $recipe->title }}
                    </h1>

                    <p class="text-gray-600 leading-relaxed text-lg">
                        {{ $recipe->description }}
                    </p>
                </div>

                <!-- STEPS -->
                <div class="bg-white border border-gray-100 rounded-3xl p-6 md:p-8 shadow-sm">

                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-semibold text-gray-900">
                            Cooking Steps
                        </h2>

                        <span class="text-sm text-gray-400">
                            {{ $recipe->steps->count() }} Steps
                        </span>
                    </div>

                    <div class="space-y-5">
                        @foreach ($recipe->steps as $index => $step)
                            <div class="flex gap-4">

                                <div
                                    class="w-9 h-9 rounded-full bg-black text-white flex items-center justify-center text-sm font-semibold shrink-0">
                                    {{ $index + 1 }}
                                </div>

                                <div class="pt-1">
                                    <p class="text-gray-700 leading-relaxed">
                                        {{ $step->instruction }}
                                    </p>
                                </div>

                            </div>
                        @endforeach
                    </div>

                </div>

            </div>

            <!-- SIDEBAR -->
            <div class="space-y-6">

                <!-- INGREDIENTS -->
                <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm">

                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Ingredients
                        </h3>

                        <span class="text-sm text-gray-400">
                            {{ $recipe->ingredients->count() }} items
                        </span>
                    </div>

                    <div class="space-y-4">
    <div class="space-y-3">

    @foreach ($recipe->ingredients as $ingredient)

        <div class="rounded-2xl bg-gray-50 px-5 py-4">

            <!-- Name -->
            <div class="text-gray-900 font-medium text-[15px]">
                {{ $ingredient->name }}
            </div>

            <!-- Quantity (now allowed to wrap naturally) -->
            <div class="mt-1 text-sm text-gray-500 leading-relaxed">
                {{ $ingredient->quantity }}
            </div>

        </div>

    @endforeach

</div>

                </div>

                <!-- ACTIONS -->
                <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm">

                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Actions
                    </h3>

                    <div class="space-y-3">

                        <a href="{{ route('recipes.edit', $recipe->id) }}"
                            class="w-full inline-flex items-center justify-center rounded-2xl bg-black text-white px-4 py-3 text-sm font-medium hover:opacity-90 transition">
                            Edit Recipe
                        </a>

                        <form method="POST"
                            action="{{ route('recipes.destroy', $recipe->id) }}">
                            @csrf
                            @method('DELETE')

                            <button
                                class="w-full rounded-2xl border border-red-200 text-red-500 px-4 py-3 text-sm font-medium hover:bg-red-50 transition">
                                Delete Recipe
                            </button>
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection