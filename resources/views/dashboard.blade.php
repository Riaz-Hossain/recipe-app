@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50">

        <div class="max-w-7xl mx-auto px-6 py-8">

            <!-- Top Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">

                <div>
                    <h1 class="text-3xl font-bold text-gray-800">
                        👨‍🍳 Recipe Studio
                    </h1>
                    <p class="text-gray-500">
                        Welcome back, {{ auth()->user()->name }} — manage your recipes
                    </p>
                </div>

                <a href="{{ route('recipes.create') }}"
                    class="mt-4 md:mt-0 bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg shadow">
                    + New Recipe
                </a>

            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

                <div class="bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
                    <p class="text-gray-500 text-sm">Total Recipes</p>
                    <h2 class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $recipeCount }}
                    </h2>
                </div>

                <div class="bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
                    <p class="text-gray-500 text-sm">Recent Recipes</p>
                    <h2 class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $recipes->count() }}
                    </h2>
                </div>

                <div class="bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
                    <p class="text-gray-500 text-sm">Status</p>
                    <h2 class="text-3xl font-bold text-green-600 mt-2">
                        Active
                    </h2>
                </div>

            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Recent Recipes -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow p-6">

                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">
                            Recent Recipes
                        </h2>

                        <a href="{{ route('recipes.index') }}" class="text-green-600 text-sm hover:underline">
                            View all →
                        </a>
                    </div>

                    <div class="space-y-4">

                        @forelse($recipes as $recipe)
                            <div
                                class="flex items-center justify-between p-4 border rounded-xl hover:bg-gray-50 transition">

                                <div>
                                    <h3 class="font-semibold text-gray-800">
                                        {{ $recipe->title }}
                                    </h3>

                                    <p class="text-sm text-gray-500">
                                        ⏱ {{ $recipe->cooking_time }} min •
                                        🔥 {{ ucfirst($recipe->difficulty) }}
                                    </p>
                                </div>

                                <div class="flex gap-3 text-sm">

                                    <a href="{{ route('recipes.show', $recipe->id) }}"
                                        class="text-blue-500 hover:underline">
                                        View
                                    </a>

                                    <a href="{{ route('recipes.edit', $recipe->id) }}"
                                        class="text-green-500 hover:underline">
                                        Edit
                                    </a>

                                </div>

                            </div>

                        @empty
                            <p class="text-gray-500">No recipes yet. Create your first one 👨‍🍳</p>
                        @endforelse

                    </div>

                </div>

                <!-- Right Panel -->
                <div class="space-y-6">

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl shadow p-6">

                        <h3 class="font-semibold mb-4">⚡ Quick Actions</h3>

                        <div class="space-y-3">

                            <a href="{{ route('recipes.create') }}"
                                class="block bg-green-500 text-white text-center py-2 rounded-lg">
                                Create Recipe
                            </a>

                            <a href="{{ route('recipes.index') }}"
                                class="block bg-gray-100 text-center py-2 rounded-lg hover:bg-gray-200">
                                View All Recipes
                            </a>

                        </div>

                    </div>

                    <!-- Tips Card -->
                    <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-2xl shadow p-6">

                        <h3 class="font-semibold text-lg">💡 Tip</h3>
                        <p class="text-sm mt-2 opacity-90">
                            Add step-by-step instructions to make your recipes more discoverable and useful.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
