<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RecipeController as AdminRecipeController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\HomeController;


Route::get('/', HomeController::class)->name('home');
Route::view('/apie', 'about')->name('about');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('recipes', AdminRecipeController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/blog', [BlogPostController::class, 'index'])->name('blog.index');
Route::get('/blog/{blogPost:slug}', [BlogPostController::class, 'show'])->name('blog.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/my-blog/create', [BlogPostController::class, 'create'])->name('blog.create');
    Route::post('/my-blog', [BlogPostController::class, 'store'])->name('blog.store');
    Route::get('/my-blog/{blogPost}/edit', [BlogPostController::class, 'edit'])->name('blog.edit');
    Route::put('/my-blog/{blogPost}', [BlogPostController::class, 'update'])->name('blog.update');
    Route::delete('/my-blog/{blogPost}', [BlogPostController::class, 'destroy'])->name('blog.destroy');
});

Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipes/{recipe:slug}', [RecipeController::class, 'show'])->name('recipes.show');
require __DIR__.'/auth.php';
