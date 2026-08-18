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
        dd($movies);
    }
}
