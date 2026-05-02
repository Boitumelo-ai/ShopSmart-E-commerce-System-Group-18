<?php

use Illuminate\Support\Facades\Route;

// Import all controllers
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
<<<<<<< HEAD
use App\Http\Controllers\UserGoodsController;
=======
use App\Http\Controllers\UserGoodController;
>>>>>>> 3068948830f8d83785cd1025885a24c47203daec
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
<<<<<<< HEAD
Route::get('/role', [RoleController::class, 'index']);

// Show one role - visits /roles/1
Route::get('/role/{id}', [RoleController::class, 'show']);

// Save a new role - form submits to /roles
Route::post('/role', [RoleController::class, 'store']);

// Update an existing role - form submits to /roles/1
Route::put('/role/{id}', [RoleController::class, 'update']);

// Delete a role - button submits to /roles/1
Route::delete('/role/{id}', [RoleController::class, 'destroy']);
=======
Route::get('/roles', [RoleController::class, 'index']);

// Show one role - visits /roles/1
Route::get('/roles/{id}', [RoleController::class, 'show']);

// Save a new role - form submits to /roles
Route::post('/roles', [RoleController::class, 'store']);

// Update an existing role - form submits to /roles/1
Route::put('/roles/{id}', [RoleController::class, 'update']);

// Delete a role - button submits to /roles/1
Route::delete('/roles/{id}', [RoleController::class, 'destroy']);
>>>>>>> 3068948830f8d83785cd1025885a24c47203daec

// -----------------------------------------------------------------------
// USER ROUTES
// -----------------------------------------------------------------------

// Show all users
<<<<<<< HEAD
Route::get('/user', [UserController::class, 'index']);

// Show one user
Route::get('/user/{id}', [UserController::class, 'show']);

// Save a new user
Route::post('/user', [UserController::class, 'store']);

// Update an existing user
Route::put('/user/{id}', [UserController::class, 'update']);

// Delete a user
Route::delete('/user/{id}', [UserController::class, 'destroy']);
=======
Route::get('/users', [UserController::class, 'index']);

// Show one user
Route::get('/users/{id}', [UserController::class, 'show']);

// Save a new user
Route::post('/users', [UserController::class, 'store']);

// Update an existing user
Route::put('/users/{id}', [UserController::class, 'update']);

// Delete a user
Route::delete('/users/{id}', [UserController::class, 'destroy']);
>>>>>>> 3068948830f8d83785cd1025885a24c47203daec

// -----------------------------------------------------------------------
// PRODUCT ROUTES
// -----------------------------------------------------------------------

// Show all products
<<<<<<< HEAD
Route::get('/product', [ProductController::class, 'index']);

// Show one product
Route::get('/product/{id}', [ProductController::class, 'show']);

// Save a new product
Route::post('/product', [ProductController::class, 'store']);

// Update an existing product
Route::put('/product/{id}', [ProductController::class, 'update']);

// Delete a product
Route::delete('/product/{id}', [ProductController::class, 'destroy']);
=======
Route::get('/products', [ProductController::class, 'index']);

// Show one product
Route::get('/products/{id}', [ProductController::class, 'show']);

// Save a new product
Route::post('/products', [ProductController::class, 'store']);

// Update an existing product
Route::put('/products/{id}', [ProductController::class, 'update']);

// Delete a product
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
>>>>>>> 3068948830f8d83785cd1025885a24c47203daec

// -----------------------------------------------------------------------
// ORDER (USER GOODS) ROUTES
// -----------------------------------------------------------------------

// Show all orders
<<<<<<< HEAD
Route::get('/usergoods', [UserGoodsController::class, 'index']);

// Show one order
Route::get('/usergoods/{id}', [UserGoodsController::class, 'show']);

// Place a new order
Route::post('/usergoods', [UserGoodsController::class, 'store']);

// Update an order status
Route::put('/usergoods/{id}', [UserGoodsController::class, 'update']);

// Cancel/delete an order
Route::delete('/usergoods/{id}', [UserGoodsController::class, 'destroy']);
=======
Route::get('/usergoods', [UserGoodController::class, 'index']);

// Show one order
Route::get('/usergoods/{id}', [UserGoodController::class, 'show']);

// Place a new order
Route::post('/usergoods', [UserGoodController::class, 'store']);

// Update an order status
Route::put('/usergoods/{id}', [UserGoodController::class, 'update']);

// Cancel/delete an order
Route::delete('/usergoods/{id}', [UserGoodController::class, 'destroy']);
>>>>>>> 3068948830f8d83785cd1025885a24c47203daec

// -----------------------------------------------------------------------
// PAYMENT ROUTES
// -----------------------------------------------------------------------

// Show all payments
<<<<<<< HEAD
Route::get('/payment', [PaymentController::class, 'index']);

// Show one payment
Route::get('/payment/{id}', [PaymentController::class, 'show']);

// Record a new payment
Route::post('/payment', [PaymentController::class, 'store']);

// Delete a payment
Route::delete('/payment/{id}', [PaymentController::class, 'destroy']);
=======
Route::get('/payments', [PaymentController::class, 'index']);

// Show one payment
Route::get('/payments/{id}', [PaymentController::class, 'show']);

// Record a new payment
Route::post('/payments', [PaymentController::class, 'store']);

// Delete a payment
Route::delete('/payments/{id}', [PaymentController::class, 'destroy']);
>>>>>>> 3068948830f8d83785cd1025885a24c47203daec

// -----------------------------------------------------------------------
// REVIEW ROUTES
// -----------------------------------------------------------------------

// Show all reviews
<<<<<<< HEAD
Route::get('/review', [ReviewController::class, 'index']);

// Show one review
Route::get('/review/{id}', [ReviewController::class, 'show']);

// Submit a new review
Route::post('/review', [ReviewController::class, 'store']);

// Delete a review
Route::delete('/review/{id}', [ReviewController::class, 'destroy']);
=======
Route::get('/reviews', [ReviewController::class, 'index']);

// Show one review
Route::get('/reviews/{id}', [ReviewController::class, 'show']);

// Submit a new review
Route::post('/reviews', [ReviewController::class, 'store']);

// Delete a review
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);
>>>>>>> 3068948830f8d83785cd1025885a24c47203daec

