<?php

use Illuminate\Support\Facades\Route;

// Import all controllers
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserGoodsController;
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
Route::get('/role', [RoleController::class, 'index']);

// Show one role - visits /roles/1
Route::get('/role/{id}', [RoleController::class, 'show']);

// Save a new role - form submits to /roles
Route::post('/role', [RoleController::class, 'store']);

// Update an existing role - form submits to /roles/1
Route::put('/role/{id}', [RoleController::class, 'update']);

// Delete a role - button submits to /roles/1
Route::delete('/role/{id}', [RoleController::class, 'destroy']);

// -----------------------------------------------------------------------
// USER ROUTES
// -----------------------------------------------------------------------

// Show all users
Route::get('/user', [UserController::class, 'index']);

// Show one user
Route::get('/user/{id}', [UserController::class, 'show']);

// Save a new user
Route::post('/user', [UserController::class, 'store']);

// Update an existing user
Route::put('/user/{id}', [UserController::class, 'update']);

// Delete a user
Route::delete('/user/{id}', [UserController::class, 'destroy']);

// -----------------------------------------------------------------------
// PRODUCT ROUTES
// -----------------------------------------------------------------------

// Show all products
Route::get('/product', [ProductController::class, 'index']);

// Show one product
Route::get('/product/{id}', [ProductController::class, 'show']);

// Save a new product
Route::post('/product', [ProductController::class, 'store']);

// Update an existing product
Route::put('/product/{id}', [ProductController::class, 'update']);

// Delete a product
Route::delete('/product/{id}', [ProductController::class, 'destroy']);

// -----------------------------------------------------------------------
// ORDER (USER GOODS) ROUTES
// -----------------------------------------------------------------------

// Show all orders
Route::get('/usergoods', [UserGoodsController::class, 'index']);

// Show one order
Route::get('/usergoods/{id}', [UserGoodsController::class, 'show']);

// Place a new order
Route::post('/usergoods', [UserGoodsController::class, 'store']);

// Update an order status
Route::put('/usergoods/{id}', [UserGoodsController::class, 'update']);

// Cancel/delete an order
Route::delete('/usergoods/{id}', [UserGoodsController::class, 'destroy']);

// -----------------------------------------------------------------------
// PAYMENT ROUTES
// -----------------------------------------------------------------------

// Show all payments
Route::get('/payment', [PaymentController::class, 'index']);

// Show one payment
Route::get('/payment/{id}', [PaymentController::class, 'show']);

// Record a new payment
Route::post('/payment', [PaymentController::class, 'store']);

// Delete a payment
Route::delete('/payment/{id}', [PaymentController::class, 'destroy']);

// -----------------------------------------------------------------------
// REVIEW ROUTES
// -----------------------------------------------------------------------

// Show all reviews
Route::get('/review', [ReviewController::class, 'index']);

// Show one review
Route::get('/review/{id}', [ReviewController::class, 'show']);

// Submit a new review
Route::post('/review', [ReviewController::class, 'store']);

// Delete a review
Route::delete('/review/{id}', [ReviewController::class, 'destroy']);

