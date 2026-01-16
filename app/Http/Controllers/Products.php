<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class Products extends Controller
{
    public function category(Category $category)
    {
        return $category->name;
//        return view('products.category', compact('category'));
    }
}
