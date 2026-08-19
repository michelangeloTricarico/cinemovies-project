<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthContoller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('movies', [UserController::class, 'index']);
Route::get('movies/{id}', [UserController::class, 'show']);
Route::post('movies/{id}/reviews', [UserController::class, 'storeReview']);
Route::put('movies/reviews/{id}', [UserController::class, 'updateReview']);
Route::delete('movies/reviews/{id}', [UserController::class, 'deleteReview']);
Route::post('register', [AuthContoller::class, 'register']);
Route::post('login', [AuthContoller::class, 'login']);
