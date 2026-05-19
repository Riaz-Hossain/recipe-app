<?php

use App\Http\Controllers\Api\RecipeApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::post('/login', function (Request $request) {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }

    return response()->json([
        'user' => $user,
        'token' => $user->createToken('api-token')->plainTextToken,
    ]);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/recipes', [RecipeApiController::class, 'index']);
    Route::post('/recipes', [RecipeApiController::class, 'store']);
    Route::get('/recipes/{recipe}', [RecipeApiController::class, 'show']);
    Route::put('/recipes/{recipe}', [RecipeApiController::class, 'update']);
    Route::delete('/recipes/{recipe}', [RecipeApiController::class, 'destroy']);

});
