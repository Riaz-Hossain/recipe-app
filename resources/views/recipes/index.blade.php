<h1>All Recipes</h1>

<a href="{{ route('recipes.create') }}">+ Create Recipe</a>

@foreach ($recipes as $recipe)
    <div style="border:1px solid #ddd; margin:10px; padding:10px;">

        @if ($recipe->image)
            <img src="{{ asset($recipe->image) }}" width="200">
        @endif

        <a href="{{ route('recipes.show', $recipe->id) }}">
            <h2>{{ $recipe->title }}</h2>
        </a>


        <p>{{ $recipe->description }}</p>

        <h4>Ingredients:</h4>

        <ul>
            @foreach ($recipe->ingredients as $ingredient)
                <li>
                    {{ $ingredient->name }} - {{ $ingredient->quantity }}
                </li>
            @endforeach
        </ul>

        <h4>Steps:</h4>

        <ol>
            @foreach ($recipe->steps as $step)
                <li>
                    {{ $step->instruction }}
                </li>
            @endforeach
        </ol>

        <p>
            ⏱ {{ $recipe->cooking_time }} min |
            🔥 {{ $recipe->difficulty }} |
            📂 {{ $recipe->category->name ?? 'No Category' }}
        </p>

        <p>👤 By: {{ $recipe->user->name }}</p>
    </div>
@endforeach
