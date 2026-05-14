<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // INDEX - Show all items currently in the cart
    public function index()
    {
        // Get the cart from the session
        // If no cart exists yet, return an empty array
        $cart = session()->get('cart', []);

        // Calculate the total price of all items in the cart
        $total = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        // Send cart data and total to the view
        return view('cart.index', [
            'cart'  => $cart,
            'total' => $total
        ]);
    }

    // ADD - Add a product to the cart
    public function add(Request $request, $id)
    {
        // Find the product in the database
        $product = Product::findOrFail($id);

        // Get the current cart from session or start empty
        $cart = session()->get('cart', []);

        // Check if this product is already in the cart
        if (isset($cart[$id])) {
            // If yes, just increase the quantity by 1
            $cart[$id]['quantity']++;
        } else {
            // If no, add it as a new item
            $cart[$id] = [
                'id'          => $product->id,
                'name'        => $product->description,
                'price'       => $product->amount,
                'quantity'    => 1,
                'offered_by'  => $product->user->first_name ?? 'Unknown'
            ];
        }

        // Save the updated cart back to the session
        session()->put('cart', $cart);

        // Go back to the previous page with a success message
        return redirect()->back()->with('success', 
            $product->description . ' added to cart!');
    }

    // UPDATE - Change the quantity of a cart item
    public function update(Request $request, $id)
    {
        // Validate that quantity is at least 1
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Get the current cart
        $cart = session()->get('cart', []);

        // Check if the item exists in the cart
        if (isset($cart[$id])) {
            // Update its quantity
            $cart[$id]['quantity'] = $request->quantity;
            // Save back to session
            session()->put('cart', $cart);
        }

        return redirect('/cart')->with('success', 'Cart updated!');
    }

    // REMOVE - Remove one item from the cart
    public function remove($id)
    {
        // Get the current cart
        $cart = session()->get('cart', []);

        // Remove the item with this id
        if (isset($cart[$id])) {
            unset($cart[$id]);
            // Save updated cart back to session
            session()->put('cart', $cart);
        }

        return redirect('/cart')->with('success', 'Item removed from cart!');
    }

    // CLEAR - Empty the entire cart
    public function clear()
    {
        // Remove the cart from the session completely
        session()->forget('cart');

        return redirect('/cart')->with('success', 'Cart cleared!');
    }

        public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

        public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item removed');
    }

}

    