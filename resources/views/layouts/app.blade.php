<!DOCTYPE html>
<html>

<head>
    <title>RecipeHub</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 text-gray-900">

    <!-- NAVBAR -->
    <div class="flex justify-between items-center p-4 bg-white shadow">

        <a href="/" class="font-bold text-lg">Recipe Studio</a>

        <div class="flex items-center gap-4">

            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('recipes.index') }}">Recipes</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-500">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth

        </div>

    </div>

    <!-- PAGE -->
    <main class="max-w-6xl mx-auto p-6">
        @yield('content')
    </main>

</body>

</html>
