<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

Route::get('/', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/category/{categoryId}', [ProductController::class, 'index'])->name('products.index');
