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
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// -----------------------------------------------------------------------
// ROLE ROUTES
// -----------------------------------------------------------------------
Route::get('/roles', [RoleController::class, 'index']);
Route::get('/roles/{id}', [RoleController::class, 'show']);
Route::post('/roles', [RoleController::class, 'store']);
Route::put('/roles/{id}', [RoleController::class, 'update']);
Route::delete('/roles/{id}', [RoleController::class, 'destroy']);

// -----------------------------------------------------------------------
// USER ROUTES
// -----------------------------------------------------------------------
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

// -----------------------------------------------------------------------
// PRODUCT ROUTES
// -----------------------------------------------------------------------
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

// -----------------------------------------------------------------------
// ORDER (USER GOODS) ROUTES
// -----------------------------------------------------------------------
Route::get('/usergoods', [UserGoodsController::class, 'index']);
Route::get('/usergoods/{id}', [UserGoodsController::class, 'show']);
Route::post('/usergoods', [UserGoodsController::class, 'store']);
Route::put('/usergoods/{id}', [UserGoodsController::class, 'update']);
Route::delete('/usergoods/{id}', [UserGoodsController::class, 'destroy']);

// -----------------------------------------------------------------------
// PAYMENT ROUTES
// -----------------------------------------------------------------------
Route::get('/payments', [PaymentController::class, 'index']);
Route::get('/payments/{id}', [PaymentController::class, 'show']);
Route::post('/payments', [PaymentController::class, 'store']);
Route::delete('/payments/{id}', [PaymentController::class, 'destroy']);

// -----------------------------------------------------------------------
// REVIEW ROUTES
// -----------------------------------------------------------------------
Route::get('/reviews', [ReviewController::class, 'index']);
Route::get('/reviews/{id}', [ReviewController::class, 'show']);
Route::post('/reviews', [ReviewController::class, 'store']);
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);
