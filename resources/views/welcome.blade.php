<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Studio</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- NAVBAR -->
    <nav class="flex justify-between items-center px-8 py-4 bg-white shadow-sm">

        <h1 class="text-xl font-bold">👨‍🍳 Recipe Studio</h1>

        <div class="flex items-center gap-4">

            @auth
                <a href="{{ route('dashboard') }}" class="text-gray-700 hover:underline">
                    Dashboard
                </a>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-700 hover:underline">
                    Login
                </a>

                <a href="{{ route('register') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg">
                    Sign Up
                </a>
            @endauth

        </div>

    </nav>

    <!-- HERO -->
    <section class="text-center py-20 px-6">

        <h2 class="text-4xl md:text-5xl font-bold mb-6">
            Organize Your Recipes <br> Like a Pro 🍳
        </h2>

        <p class="text-gray-600 max-w-xl mx-auto mb-8">
            Save, manage, and share your favorite recipes with a clean and powerful system.
        </p>

        <div class="space-x-4">
            @auth
                <a href="{{ route('dashboard') }}" class="bg-green-500 text-white px-6 py-3 rounded-lg shadow">
                    Go to Dashboard
                </a>
            @else
                <a href="{{ route('register') }}" class="bg-green-500 text-white px-6 py-3 rounded-lg shadow">
                    Get Started
                </a>

                <a href="{{ route('login') }}" class="border px-6 py-3 rounded-lg">
                    Login
                </a>
            @endauth
        </div>

    </section>

    <!-- FEATURES -->
    <section class="max-w-6xl mx-auto px-6 py-16 grid md:grid-cols-3 gap-8">

        <div class="bg-white p-6 rounded-xl shadow text-center">
            <h3 class="text-lg font-semibold mb-2">📋 Manage Recipes</h3>
            <p class="text-gray-500">Create and organize all your recipes easily.</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow text-center">
            <h3 class="text-lg font-semibold mb-2">🥕 Ingredients Tracking</h3>
            <p class="text-gray-500">Keep track of ingredients and quantities.</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow text-center">
            <h3 class="text-lg font-semibold mb-2">🔥 Step-by-Step Cooking</h3>
            <p class="text-gray-500">Follow structured steps for better cooking.</p>
        </div>

    </section>

    <!-- CTA -->
    <section class="text-center py-16 bg-green-500 text-white">

        <h2 class="text-3xl font-bold mb-4">
            Start Building Your Recipe Collection Today
        </h2>

        @guest
            <a href="{{ route('register') }}" class="bg-white text-green-600 px-6 py-3 rounded-lg font-semibold">
                Create Free Account
            </a>
        @endguest

    </section>

    <!-- FOOTER -->
    <footer class="text-center py-6 text-gray-500 text-sm">
        © {{ date('Y') }} Recipe Studio. Built with Laravel.
    </footer>

</body>

</html>
