<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DirectorController;
use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use App\Models\Director;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// Route generated to Laravel Magic fo login
Route::get('/dashboard', function () {
    return view('dashboard', [
        'movies' => Movie::with('director')->get(),
        'reviews' => Review::with(['movie', 'user'])->get(),
        'users' => User::all(),
        'directors' => Director::withCount('movies')->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
    Route::get('/movies/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('/movies/{id}', [MovieController::class, 'update'])->name('movies.update');
    Route::delete('/movies/{id}', [MovieController::class, 'destroy'])->name('movies.destroy');

    Route::post('/directors', [DirectorController::class, 'store'])->name('directors.store');
    Route::get('/directors/{id}/edit', [DirectorController::class, 'edit'])->name('directors.edit');
    Route::put('/directors/{id}', [DirectorController::class, 'update'])->name('directors.update');
    Route::delete('/directors/{id}', [DirectorController::class, 'destroy'])->name('directors.destroy');

    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

require __DIR__.'/auth.php';
