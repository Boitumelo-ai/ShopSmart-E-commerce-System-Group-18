<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\UserGood;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // INDEX - Show all reviews
    public function index()
    {
        // Load reviews with their related order
        $review = Review::with('userGood')->get();

        return view('review.index', ['review' => $review]);
    }

    // SHOW - Show one review
    public function show($id)
    {
        $review = Review::with('userGood')->findOrFail($id);

        return view('review.show', ['review' => $review]);
    }

    // STORE - Submit a new review
    public function store(Request $request)
    {
        $request->validate([
            'comment'       => 'required|max:1000',
            'rating'        => 'required|integer|min:1|max:5', // rating between 1-5
            'user_goods_id' => 'required|exists:user_goods,id'
        ]);

        Review::create([
            'comment'       => $request->comment,
            'rating'        => $request->rating,
            'user_goods_id' => $request->user_goods_id
        ]);

        return redirect('/reviews');
    }

    // DESTROY - Delete a review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect('/review');
    }
}