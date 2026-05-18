<?php

namespace App\Http\Controllers;

use App\Models\order_item;
use Illuminate\Http\Request;

class order_itemController extends Controller
{
    public function index()
    {
        return order_item::with('product')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'price' => 'required'
        ]);

        return order_item::create($request->all());
    }

    public function show(order_item $order_item)
    {
        return $order_item;
    }

    public function update(Request $request, Order_item $order_item)
    {
        $order_item->update($request->all());

        return $order_item;
    }

    public function destroy(order_item $order_item)
    {
        $order_item->delete();

        return response()->json(['message' => 'Order item deleted']);
    }
}