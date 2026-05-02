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
Route::get('/role', [RoleController::class, 'index']);
Route::get('/role/{id}', [RoleController::class, 'show']);
Route::post('/role', [RoleController::class, 'store']);
Route::put('/role/{id}', [RoleController::class, 'update']);
Route::delete('/role/{id}', [RoleController::class, 'destroy']);

// -----------------------------------------------------------------------
// USER ROUTES
// -----------------------------------------------------------------------
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);

// -----------------------------------------------------------------------
// PRODUCT ROUTES
// -----------------------------------------------------------------------
Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::post('/product', [ProductController::class, 'store']);
Route::put('/product/{id}', [ProductController::class, 'update']);
Route::delete('/product/{id}', [ProductController::class, 'destroy']);

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
Route::get('/payment', [PaymentController::class, 'index']);
Route::get('/payment/{id}', [PaymentController::class, 'show']);
Route::post('/payment', [PaymentController::class, 'store']);
Route::delete('/payment/{id}', [PaymentController::class, 'destroy']);

// -----------------------------------------------------------------------
// REVIEW ROUTES
// -----------------------------------------------------------------------
Route::get('/review', [ReviewController::class, 'index']);
Route::get('/review/{id}', [ReviewController::class, 'show']);
Route::post('/review', [ReviewController::class, 'store']);
Route::delete('/review/{id}', [ReviewController::class, 'destroy']);
