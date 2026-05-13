<!DOCTYPE html>
<html>

<head>
    <title>Recipe App</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <nav class="bg-white shadow p-4 flex justify-between">
        <h1 class="text-xl font-bold"><a href="{{ route('recipes.index') }}" class="text-gray-800">🍽 Recipe App</a></h1>

        <a href="{{ route('recipes.index') }}" class="text-blue-500">Home</a>
    </nav>

    <div class="container mx-auto p-6">
        @yield('content')
    </div>

</body>

</html>
