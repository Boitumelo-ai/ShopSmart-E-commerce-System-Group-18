<?php

use Illuminate\Support\Facades\Route;

// Import all controllers
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserGoodController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
| This file is where you define all the URLs for your application
| Each route connects a URL to a controller method
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});
// -----------------------------------------------------------------------
// ROLE ROUTES
// -----------------------------------------------------------------------

// Show all roles - visits /roles
Route::get('/roles', [RoleController::class, 'index']);

// Show one role - visits /roles/1
Route::get('/roles/{id}', [RoleController::class, 'show']);

// Save a new role - form submits to /roles
Route::post('/roles', [RoleController::class, 'store']);

// Update an existing role - form submits to /roles/1
Route::put('/roles/{id}', [RoleController::class, 'update']);

// Delete a role - button submits to /roles/1
Route::delete('/roles/{id}', [RoleController::class, 'destroy']);

// -----------------------------------------------------------------------
// USER ROUTES
// -----------------------------------------------------------------------

// Show all users
Route::get('/users', [UserController::class, 'index']);

// Show one user
Route::get('/users/{id}', [UserController::class, 'show']);

// Save a new user
Route::post('/users', [UserController::class, 'store']);

// Update an existing user
Route::put('/users/{id}', [UserController::class, 'update']);

// Delete a user
Route::delete('/users/{id}', [UserController::class, 'destroy']);

// -----------------------------------------------------------------------
// PRODUCT ROUTES
// -----------------------------------------------------------------------

// Show all products
Route::get('/products', [ProductController::class, 'index']);

// Show one product
Route::get('/products/{id}', [ProductController::class, 'show']);

// Save a new product
Route::post('/products', [ProductController::class, 'store']);

// Update an existing product
Route::put('/products/{id}', [ProductController::class, 'update']);

// Delete a product
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

// -----------------------------------------------------------------------
// ORDER (USER GOODS) ROUTES
// -----------------------------------------------------------------------

// Show all orders
Route::get('/usergoods', [UserGoodController::class, 'index']);

// Show one order
Route::get('/usergoods/{id}', [UserGoodController::class, 'show']);

// Place a new order
Route::post('/usergoods', [UserGoodController::class, 'store']);

// Update an order status
Route::put('/usergoods/{id}', [UserGoodController::class, 'update']);

// Cancel/delete an order
Route::delete('/usergoods/{id}', [UserGoodController::class, 'destroy']);

// -----------------------------------------------------------------------
// PAYMENT ROUTES
// -----------------------------------------------------------------------

// Show all payments
Route::get('/payments', [PaymentController::class, 'index']);

// Show one payment
Route::get('/payments/{id}', [PaymentController::class, 'show']);

// Record a new payment
Route::post('/payments', [PaymentController::class, 'store']);

// Delete a payment
Route::delete('/payments/{id}', [PaymentController::class, 'destroy']);

// -----------------------------------------------------------------------
// REVIEW ROUTES
// -----------------------------------------------------------------------

// Show all reviews
Route::get('/reviews', [ReviewController::class, 'index']);

// Show one review
Route::get('/reviews/{id}', [ReviewController::class, 'show']);

// Submit a new review
Route::post('/reviews', [ReviewController::class, 'store']);

// Delete a review
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);

