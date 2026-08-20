<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Review;

class UserController extends Controller
{
    // Method used to get movies, director and reviews information sent to frontend for Home page
    public function index(){
        $movies = Movie::with(['director', 'reviews.user'])->get();
        return response()->json([
            'success' => true,
            'results' => $movies
        ]);
    }

    // Method used to get movies, director and reviews information sent to frontend for Single Movie page
    public function show($id){
        $movie = Movie::with(['director', 'reviews.user'])->find($id);
        return response()->json([
            'success' => true,
            'results' => $movie
        ]);
    }

    // Method used in Single page for component Review Form, to save a new review in Review model
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

    // Method used in Single page for component Review Form, to edit a new review in Review model
    public function updateReview(Request $request, $id){
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $review = Review::find($id);
        $review->update($validated);

        return response()->json([
            'success' => true,
            'results' => $review
        ]);
    }

    // Method used in Single page for component Review Form, to destroy a new review in Review model
    public function deleteReview($id){
        $review = Review::find($id);
        $review->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
