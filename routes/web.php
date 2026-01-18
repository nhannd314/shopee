<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/category/{category:slug}', [ProductController::class, 'category'])->name('category');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product');

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/update-cart', [CartController::class, 'update'])->name('cart.update');
