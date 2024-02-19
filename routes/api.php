<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\UserPostController;

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

Route::get('auth-user', [AuthUserController::class, 'show']);

Route::middleware('auth:api')->group(function () { 
    Route::apiResources([
        'posts' => PostController::class,
        'users' => UserController::class,
        'users/{user}/posts' => UserPostController::class,
    ]);
});