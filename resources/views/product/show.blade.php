@extends('layouts.app')

@section('content')

<div class="container">

    <h1 class="mb-4">Product Details</h1>

    <div class="card p-4">

        <div class="row">

            <div class="col-md-6">

                <img src="https://via.placeholder.com/400"
                     class="img-fluid rounded"
                     alt="Product Image">

            </div>

            <div class="col-md-6">

                <h2>Laptop</h2>

                <h4 class="text-primary mb-3">
                    R12 000
                </h4>

                <p>
                    High-performance laptop suitable for gaming,
                    programming, and business work.
                </p>

                <ul class="list-group mb-3">

                    <li class="list-group-item">
                        Brand: HP
                    </li>

                    <li class="list-group-item">
                        Storage: 512GB SSD
                    </li>

                    <li class="list-group-item">
                        RAM: 16GB
                    </li>

                    <li class="list-group-item">
                        Status: In Stock
                    </li>

                </ul>

                <a href="/products"
                   class="btn btn-secondary">
                    Back to Products
                </a>

                <button class="btn btn-primary">
                    Add to Cart
                </button>

            </div>

        </div>

    </div>

</div>

@endsection