<?php

use Illuminate\Support\Facades\Route;

// Import all controllers
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\user_goodsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\VendorController;

// -----------------------------------------------------------------------
// PUBLIC ROUTES - anyone can access
// -----------------------------------------------------------------------

// Homepage
Route::get('/', function () {
    return view('welcome');
});

// Products - public can view
Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);

// Reviews - public can view
Route::get('/review', [ReviewController::class, 'index']);

// -----------------------------------------------------------------------
// AUTH ROUTES - login, register, logout
// -----------------------------------------------------------------------
require __DIR__.'/auth.php';

// -----------------------------------------------------------------------
// STUDENT ROUTES - only logged in students
// -----------------------------------------------------------------------
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard']);
    Route::get('/student/orders',    [StudentController::class, 'orders']);
});

// -----------------------------------------------------------------------
// VENDOR ROUTES - only logged in vendors
// -----------------------------------------------------------------------
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'dashboard']);
    Route::get('/vendor/products',  [VendorController::class, 'products']);
});

// -----------------------------------------------------------------------
// PROTECTED ROUTES - must be logged in
// -----------------------------------------------------------------------
Route::middleware(['auth'])->group(function () {

    // Cart
    Route::get('/cart',                [CartController::class, 'index']);
    Route::post('/cart/add/{id}',      [CartController::class, 'add']);
    Route::post('/cart/update/{id}',   [CartController::class, 'update']);
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove']);
    Route::delete('/cart/clear',       [CartController::class, 'clear']);

    // Orders
    Route::get('/user_goods',          [user_goodsController::class, 'index']);
    Route::get('/user_goods/{id}',     [user_goodsController::class, 'show']);
    Route::post('/user_goods',         [user_goodsController::class, 'store']);
    Route::put('/user_goods/{id}',     [user_goodsController::class, 'update']);
    Route::delete('/user_goods/{id}',  [user_goodsController::class, 'destroy']);

    // Payments
    Route::get('/payment',             [PaymentController::class, 'index']);
    Route::get('/payment/{id}',        [PaymentController::class, 'show']);
    Route::post('/payment',            [PaymentController::class, 'store']);

    // Users
    Route::get('/user',                [UserController::class, 'index']);
    Route::get('/user/{id}',           [UserController::class, 'show']);

    // Reviews
    Route::post('/review',             [ReviewController::class, 'store']);
    Route::delete('/review/{id}',      [ReviewController::class, 'destroy']);

    // Products - only logged in can add/edit/delete
    Route::post('/product',            [ProductController::class, 'store']);
    Route::put('/product/{id}',        [ProductController::class, 'update']);
    Route::delete('/product/{id}',     [ProductController::class, 'destroy']);

    // Roles
    Route::get('/role',                [RoleController::class, 'index']);
    Route::post('/role',               [RoleController::class, 'store']);
    Route::put('/role/{id}',           [RoleController::class, 'update']);
    Route::delete('/role/{id}',        [RoleController::class, 'destroy']);
});