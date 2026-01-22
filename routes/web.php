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
Route::get('/success', [CartController::class, 'success'])->name('cart.success');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/{page:slug}', [\App\Http\Controllers\PageController::class, 'show'])->name('page');
