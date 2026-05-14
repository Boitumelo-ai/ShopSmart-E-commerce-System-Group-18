@extends('layouts.app')

@section('content')

<h1 class="mb-4">Customer Reviews</h1>

@foreach($review as $review)

<div class="card p-4 mb-3">

    <h5>
        {{ $review->user->name ?? 'Unknown User' }}
    </h5>

    <p>
        Product:
        {{ $review->product->description ?? 'Unknown Product' }}
    </p>

    <p>
        {{ $review->review }}
    </p>

</div>

@endforeach

@endsection