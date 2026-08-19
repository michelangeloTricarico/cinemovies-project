<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Review;

class UserController extends Controller
{
    public function index(){
        $movies = Movie::with(['director', 'reviews'])->get();
        return response()->json([
            'success' => true,
            'results' => $movies
        ]);
    }

    public function show($id){
        $movie = Movie::with(['director', 'reviews'])->findOrFail($id);
        return response()->json([
            'success' => true,
            'results' => $movie
        ]);
    }

    public function storeReview(Request $request, $id){
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $review = Review::create([
            'movie_id' => $id,
            'user_id' => $validated['user_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return response()->json([
            'success' => true,
            'results' => $review
        ]);
    }
}
