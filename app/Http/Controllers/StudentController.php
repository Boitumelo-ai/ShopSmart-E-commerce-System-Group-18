<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user_goods;
use App\Models\product;

class StudentController extends Controller
{
    // Show student dashboard
    public function dashboard()
    {
        $user     = Auth::user();
        $orders   = user_goods::with('product')
                    ->where('user_id', $user->id)
                    ->latest()
                    ->get();
        $product = Product::with('user')->latest()->take(6)->get();

        return view('student.dashboard', [
            'user'     => $user,
            'orders'   => $orders,
            'product' => $product
        ]);
    }

    // Show student orders
    public function orders()
    {
        $user   = Auth::user();
        $orders = UserGood::with('product', 'payment', 'review')
                    ->where('user_id', $user->id)
                    ->latest()
                    ->get();

        return view('student.orders', ['orders' => $orders]);
    }
}