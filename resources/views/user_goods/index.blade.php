@extends('layouts.app')

@section('content')

<h1 class="mb-4">Goods And servies</h1>

<div class="card p-4">

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>User</th>
                <th>Product</th>
                <th>Quantity</th>
            </tr>
        </thead>

        <tbody>

        @foreach($user_goods as $order)

            <tr>

                <td>
                    {{ $order->user->name ?? 'Unknown' }}
                </td>

                <td>
                    {{ $order->product->description ?? 'Unknown Product' }}
                </td>

                <td>
                    {{ $order->quantity }}
                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>

@endsection