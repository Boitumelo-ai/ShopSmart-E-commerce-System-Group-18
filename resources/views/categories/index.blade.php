 @extends('layouts.app')

@section('content')

<h1>📂 Categories</h1>

@if($categories->isEmpty())
    <div class="alert alert-info">No categories found.</div>
@else
    <div class="row">
        @foreach($categories as $category)
        <div class="col-md-4">
            <div class="card p-4 text-center">
                <h4>{{ $category->name }}</h4>
                <p class="text-muted">
                    {{ $category->products->count() }} products
                </p>
                <a href="/categories/{{ $category->id }}"
                   class="btn btn-primary">
                    Browse
                </a>
            </div>
        </div>
        @endforeach
    </div>
@endif

@endsection
