<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\BlogController as FrontEndBlogController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Resources\BlogCommentCollection;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', HomeController::class)->name('home');


Route::get('/admin/dashboard', function () {
    return Redirect::route('blog.admin.index');
});


Route::get('blog', [FrontEndBlogController::class, 'index'])->name('blog.index');
Route::get('blog/{blog}', [FrontEndBlogController::class, 'show'])->name('blog.show');


Route::middleware('auth')->group(function () {

    Route::prefix('blog/{blog}')->group(function () {
        Route::post('comment', [CommentController::class, 'store'])->name('comment.store');
    });

    Route::prefix('admin')->group(function () {
        Route::resource('blog', BlogController::class)->names('blog.admin');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.admin.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.admin.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.admin.destroy');
    });
});

require __DIR__ . '/auth.php';
