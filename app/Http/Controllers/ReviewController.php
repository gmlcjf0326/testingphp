<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the reviews.
     */
    public function index()
    {
        $reviews = Review::with(['teacher', 'program'])
            ->approved()
            ->latest()
            ->paginate(20);
        
        return view('reviews.index', compact('reviews'));
    }
}
