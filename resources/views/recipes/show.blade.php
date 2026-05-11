<h1>{{ $recipe->title }}</h1>

<p>
    📂 Category: {{ $recipe->category?->name ?? 'No Category' }} |
    👤 By: {{ $recipe->user?->name ?? 'Unknown User' }} |
    ⏱ {{ $recipe->cooking_time }} min |
    🔥 {{ $recipe->difficulty }}
</p>

@if ($recipe->image)
    <img src="{{ asset($recipe->image) }}" width="400">
@endif

<hr>

<h2>Description</h2>
<p>{{ $recipe->description }}</p>

<hr>

<h2>Ingredients</h2>
<ul>
    @foreach ($recipe->ingredients as $ingredient)
        <li>
            {{ $ingredient->name }} - {{ $ingredient->quantity }}
        </li>
    @endforeach
</ul>

<hr>

<h2>Steps</h2>
<ol>
    @foreach ($recipe->steps as $step)
        <li>{{ $step->instruction }}</li>
    @endforeach
</ol>
