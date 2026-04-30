<?php

namespace App\Http\Controllers;

use App\Models\UserGoods;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class UserGoodsController extends Controller
{
    // INDEX - Show all orders with related user and product
    public function index()
    {
        // Load orders with the user who placed them and the product ordered
        $userGoods = UserGoods::with('user', 'product')->get();

        return view('usergoods.index', ['userGoods' => $userGoods]);
    }

    // SHOW - Show one order with payment and review
    public function show($id)
    {
        // Load everything related to this order
        $userGoods = UserGoods::with('user', 'product', 'payment', 'review')
                            ->findOrFail($id);

        return view('usergoods.show', ['userGood' => $userGoods]);
    }

    // STORE - Place a new order
    public function store(Request $request)
    {
        $request->validate([
            'quantity'         => 'required|integer|min:1',
            'collect_delivery' => 'required',
            'destination'      => 'nullable|max:255', // optional if collecting
            'status'           => 'required',
            'user_id'          => 'required|exists:user,id',
            'product_id'       => 'required|exists:product,id',
            'amount'           => 'required|numeric|min:0'
        ]);

        UserGoods::create([
            'quantity'         => $request->quantity,
            'collect_delivery' => $request->collect_delivery,
            'destination'      => $request->destination,
            'status'           => $request->status,
            'user_id'          => $request->user_id,
            'product_id'       => $request->product_id,
            'amount'           => $request->amount
        ]);

        return redirect('/usergoods');
    }

    // UPDATE - Update order status
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required' // most common update is changing status
        ]);

        $userGoods = UserGoods::findOrFail($id);
        $userGoods->update(['status' => $request->status]);

        return redirect('/usergoods');
    }

    // DESTROY - Cancel/delete an order
    public function destroy($id)
    {
        $userGoods = UserGoods::findOrFail($id);
        $userGoods->delete();
        return redirect('/usergoods');
    }
}