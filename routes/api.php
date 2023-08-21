<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RecipeController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::post('/login', [AuthController::class, 'login']);

    // users
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->middleware(['auth:sanctum', 'ability:getUsers']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::post('/', [UserController::class, 'store']);
        Route::patch('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });

    // recipes
    Route::group(['prefix' => 'recipes'], function () {
        Route::get('/', [RecipeController::class, 'index']);
        Route::get('/{id}', [RecipeController::class, 'show']);
        Route::post('/', [RecipeController::class, 'store'])->middleware(['auth:sanctum', 'ability:createRecipe']);;
        Route::patch('/{id}', [RecipeController::class, 'update'])->middleware(['auth:sanctum', 'ability:editRecipe']);;
        Route::delete('/{id}', [RecipeController::class, 'destroy'])->middleware(['auth:sanctum', 'ability:deleteRecipe']);;
    });
});
