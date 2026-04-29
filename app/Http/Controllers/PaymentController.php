<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\UserGood;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // INDEX - Show all payments
    public function index()
    {
        // Load payments with their related order
        $payments = Payment::with('userGood')->get();

        return view('payments.index', ['payments' => $payments]);
    }

    // SHOW - Show one payment
    public function show($id)
    {
        $payment = Payment::with('userGood')->findOrFail($id);

        return view('payments.show', ['payment' => $payment]);
    }

    // STORE - Record a new payment
    public function store(Request $request)
    {
        $request->validate([
            'method'        => 'required|max:45', // e.g. cash, card, EFT
            'user_goods_id' => 'required|exists:user_goods,id'
        ]);

        Payment::create([
            'method'        => $request->method,
            'user_goods_id' => $request->user_goods_id
        ]);

        return redirect('/payments');
    }

    // DESTROY - Delete a payment record
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return redirect('/payments');
    }
}