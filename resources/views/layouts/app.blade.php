<!DOCTYPE html>
<html>

<head>
    <title>RecipeHub</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 text-gray-900">

    <!-- NAVBAR -->
    <nav class="bg-white border-b sticky top-0 z-50">
        <div class="max-w-6xl mx-auto flex items-center justify-between p-4">

            <!-- Logo -->
            <a href="{{ route('recipes.index') }}" class="text-xl font-bold text-green-600">
                🍽 RecipeHub
            </a>

            <!-- Menu -->
            <div class="flex items-center gap-4">
                <a href="{{ route('recipes.create') }}"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                    + Create
                </a>

                <span class="text-sm text-gray-500">
                    Welcome 👋
                </span>
            </div>

        </div>
    </nav>

    <!-- PAGE -->
    <main class="max-w-6xl mx-auto p-6">
        @yield('content')
    </main>

</body>

</html>
