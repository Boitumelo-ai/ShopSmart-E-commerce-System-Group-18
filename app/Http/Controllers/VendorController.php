<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\product;
use App\Models\user_goods;

class VendorController extends Controller
{
    // Show vendor dashboard
    public function dashboard()
    {
        $user     = Auth::user();
        $product = Product::where('offered_by', $user->id)->latest()->get();
        $orders   = user_goods::with('product', 'user')
                    ->whereHas('product', function($query) use ($user) {
                        $query->where('offered_by', $user->id);
                    })
                    ->latest()
                    ->get();
        $totalSales = $orders->sum('amount');

        return view('vendor.dashboard', [
            'user'       => $user,
            'products'   => $product,
            'orders'     => $orders,
            'totalSales' => $totalSales
        ]);
    }

    // Show vendor products
    public function product()
    {
        $user     = Auth::user();
        $product = Product::where('offered_by', $user->id)->latest()->get();
        return view('vendor.products', ['products' => $product]);
    }
}