<?php

namespace App\Policies;

use App\Models\Recipe;
use App\Models\User;

class RecipePolicy
{
    public function view(User $user, Recipe $recipe)
    {
        return true; // allow viewing (public)
    }

    public function update(User $user, Recipe $recipe)
    {
        return $user->id === $recipe->user_id;
    }

    public function delete(User $user, Recipe $recipe)
    {
        return $user->id === $recipe->user_id;
    }

    public function create(?User $user)
    {
        return $user !== null;
    }
}
