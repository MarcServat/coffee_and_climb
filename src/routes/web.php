<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/admin', [AdminAuthController::class, 'showLogin'])->name('admin.auth.index');

Route::post('/admin', [AdminAuthController::class, 'authenticate'])->name('admin.auth.login');

Route::get('/admin/orders', [AdminController::class, 'index'])->name('admin.index');

Route::get('/admin/{orderId}', [AdminController::class, 'show'])->name('admin.show');

// Home
Route::get('/', [CategoryController::class, 'index'])->name('categories.index');

// Categories
Route::get('/category/{categoryId}', [ProductController::class, 'index'])->name('products.index');

// Products
Route::get('/category/{categoryId}/product/{productId}', [ProductController::class, 'show'])->name('products.show');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');

Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');

Route::post('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Order
Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');

Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

Route::get('/order/{orderId}', [OrderController::class, 'show'])->name('order.show');

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login.index');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

// Logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');
