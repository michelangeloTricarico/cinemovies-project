<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;

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
}
