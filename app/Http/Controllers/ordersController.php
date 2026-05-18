<?php

namespace App\Http\Controllers;

use App\Models\orders;
use App\Models\order_item;
use App\Models\address;
use App\Models\cart;
use App\Models\cart_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ordersController extends Controller
{
    // Show all orders for logged in user
    public function index()
    {
        $user   = Auth::user();
        $orders = orders::with('order_item.product', 'address', 'payment')
                    ->where('user_id', $user->id)
                    ->latest()
                    ->get();

        return view('orders.index', ['orders' => $orders]);
    }

    // Show one order with full details
    public function show($id)
    {
        $orders = orders::with('order_item.product', 'address', 'payment', 'review')
                    ->where('user_id', Auth::id())
                    ->findOrFail($id);

        return view('orders.show', ['orders' => $orders]);
    }

    // Place a new order from cart
    public function store(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:address,id'
        ]);

        // Get user's cart
        $cart      = cart::where('user_id', Auth::id())->first();

        // Check if cart exists and has items
        if (!$cart) {
            return redirect('/cart')
                ->with('error', 'Your cart is empty!');
        }

        $cart_item = cart_item::with('product')
                        ->where('cart_id', $cart->id)
                        ->get();

        if ($cart_item->isEmpty()) {
            return redirect('/cart')
                ->with('error', 'Your cart is empty!');
        }

        // Calculate total amount
        $total = $cart_item->sum(function($item) {
            return $item->quantity * $item->product->amount;
        });

        // Create the order
        $orders = orders::create([
            'user_id'      => Auth::id(),
            'address_id'   => $request->address_id,
            'status'       => 'pending',
            'total_amount' => $total,
            'created_at'   => now(),
            'updated_at'   => now()
        ]);

        // Create order items from cart items
        foreach ($cart_item as $item) {
            order_item::create([
                'order_id'   => $orders->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'amount'     => $item->product->amount
            ]);
        }

        // Clear cart after order is placed
        cart_item::where('cart_id', $cart->id)->delete();

        return redirect('/orders')
            ->with('success', 'Order placed successfully!');
    }

    // Update order status
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $orders = orders::findOrFail($id);
        $orders->update([
            'status'     => $request->status,
            'updated_at' => now()
        ]);

        return redirect('/orders')
            ->with('success', 'Order updated successfully!');
    }

    // Cancel/delete an order
    public function destroy($id)
    {
        $orders = orders::findOrFail($id);

        // Only delete if order belongs to logged in user
        if ($orders->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Delete order items first
        order_item::where('order_id', $id)->delete();

        // Delete the order
        $orders->delete();

        return redirect('/orders')
            ->with('success', 'Order cancelled successfully!');
    }
}