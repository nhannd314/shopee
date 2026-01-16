<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Products;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/category/{slug}', [Products::class, 'category'])->name('category');
