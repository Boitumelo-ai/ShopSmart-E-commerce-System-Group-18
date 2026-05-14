@extends('layouts.app')

@section('content')

<h1>Add Product</h1>

<div class="card p-4">

    <form>

        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" class="form-control">
        </div>

        <button class="btn btn-primary">
            Save Product
        </button>

    </form>

</div>

@endsection