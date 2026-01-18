<?php

namespace App\Http\Controllers;

use App\Models\ProductGroup;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::all();
        $productGroups = ProductGroup::orderBy('sort_order', 'asc')->get();

        return view('index', compact('categories', 'productGroups'));
    }
}
