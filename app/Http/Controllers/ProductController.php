<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // INDEX - Show all products with the vendor who sells them
    public function index()
    {
        // Load all products and their related vendor (user)
        $product = Product::with('user')->get();

        return view('product.index', ['product' => $product]);
    }

    // SHOW - Show one product with full details
    public function show($id)
    {
        $product = Product::with('user', 'userGoods')->findOrFail($id);

        return view('product.show', ['product' => $product]);
    }

    // STORE - Save a new product
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|max:255',
            'quantity'    => 'required|integer|min:0', // must be a whole number
            'amount'      => 'required|numeric|min:0', // must be a number
            'offered_by'  => 'required|exists:user,id' // vendor must exist
        ]);

        Product::create([
            'description' => $request->description,
            'quantity'    => $request->quantity,
            'amount'      => $request->amount,
            'offered_by'  => $request->offered_by
        ]);

        return redirect('/products');
    }

    // UPDATE - Edit an existing product
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|max:255',
            'quantity'    => 'required|integer|min:0',
            'amount'      => 'required|numeric|min:0'
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'description' => $request->description,
            'quantity'    => $request->quantity,
            'amount'      => $request->amount
        ]);

        return redirect('/products');
    }

    // DESTROY - Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect('/products');
    }
}