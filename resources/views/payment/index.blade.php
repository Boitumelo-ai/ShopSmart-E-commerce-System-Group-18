@extends('layouts.app')

@section('content')

<h1 class="mb-4">Payments</h1>

<div class="card p-4">

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Amount</th>
            </tr>
        </thead>

        <tbody>

        @foreach($payment as $payment)

            <tr>

                <td>{{ $payment->id }}</td>

                <td>
                    {{ $payment->user->name ?? 'Unknown' }}
                </td>

                <td>
                    R{{ $payment->amount }}
                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>

@endsection