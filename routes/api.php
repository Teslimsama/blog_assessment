<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\BlogController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('v1')->group(function () {
    Route::post('login', LoginController::class)->name('auth.api.login');
    Route::post('register', RegisterController::class)->name('auth.api.register');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::apiResource('blog', BlogController::class)->names('api.blog');

        Route::get('blog/{blog}/comment', [CommentController::class, 'index']);
        Route::post('blog/{blog}/comment', [CommentController::class, 'store']);
        Route::get('blog/{blog}/comment/{id}', [CommentController::class, 'show']);
        Route::patch('blog/{blog}/comment/{id}', [CommentController::class, 'update']);
        Route::delete('blog/{blog}/comment/{id}', [CommentController::class, 'destroy']);
    });
});
