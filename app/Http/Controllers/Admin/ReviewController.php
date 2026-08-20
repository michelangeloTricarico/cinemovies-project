<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function destroy($id){
        $review = Review::find($id);
        $review->delete();

        return redirect()->route('dashboard');
    }
}
