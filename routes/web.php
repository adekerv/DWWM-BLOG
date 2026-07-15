<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () { //the "/" represents the racine. 
    return view('HOME');
});

Route::get('/articles', [ArticleController::class, 'index']);

Route::get('/admin/articles', [ArticleController::class,'adminIndex']);

Route::get('/categories', [CategoryController::class,'index']);






 Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Articles List Route
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

// Article Details Route (using 'details' method instead of 'show')
Route::get('/articles/{article}', [ArticleController::class, 'details'])->name('articles.details');

require __DIR__.'/auth.php';
