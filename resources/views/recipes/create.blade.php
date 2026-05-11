<form method="POST" enctype="multipart/form-data" action="{{ route('recipes.store') }}">
    @csrf

    <h3>Recipe Image</h3>

    <input type="file" name="image">
    <br><br>

    <input type="text" name="title" placeholder="Recipe Title"><br><br>

    <textarea name="description" placeholder="Description"></textarea><br><br>

    <input type="number" name="cooking_time" placeholder="Cooking Time"><br><br>

    <select name="difficulty">
        <option value="easy">Easy</option>
        <option value="medium">Medium</option>
        <option value="hard">Hard</option>
    </select><br><br>

    <h3>Cooking Steps</h3>

    <div id="steps-wrapper">
        <div class="step-item">
            <input type="number" name="steps[0][step_number]" placeholder="Step No">
            <textarea name="steps[0][instruction]" placeholder="Instruction"></textarea>
        </div>
    </div>

    <button type="button" onclick="addStep()">+ Add Step</button>


    <!-- 👇 NEW CATEGORY DROPDOWN -->
    <select name="category_id">
        <option value="">Select Category</option>

        @foreach($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </select><br><br>

    <h3>Ingredients</h3>

    <div id="ingredients-wrapper">
        <div class="ingredient-item">
            <input type="text" name="ingredients[0][name]" placeholder="Ingredient Name">
            <input type="text" name="ingredients[0][quantity]" placeholder="Quantity">
        </div>
    </div>

    <button type="button" onclick="addIngredient()">+ Add Ingredient</button>

    <script>
    let index = 1;

    function addIngredient() {
        let wrapper = document.getElementById('ingredients-wrapper');

        let html = `
            <div class="ingredient-item">
                <input type="text" name="ingredients[${index}][name]" placeholder="Ingredient Name">
                <input type="text" name="ingredients[${index}][quantity]" placeholder="Quantity">
            </div>
        `;

        wrapper.insertAdjacentHTML('beforeend', html);
        index++;
    }
    </script>

    <button type="submit">Save Recipe</button>
</form>

<script>
    let stepIndex = 1;

    function addStep() {
        let wrapper = document.getElementById('steps-wrapper');

        let html = `
            <div class="step-item">
                <input type="number" name="steps[${stepIndex}][step_number]" placeholder="Step No">
                <textarea name="steps[${stepIndex}][instruction]" placeholder="Instruction"></textarea>
            </div>
        `;

        wrapper.insertAdjacentHTML('beforeend', html);
        stepIndex++;
    }
</script>