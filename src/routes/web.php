<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

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
