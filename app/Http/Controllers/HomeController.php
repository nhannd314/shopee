<?php

namespace App\Http\Controllers;

use App\Models\CategoryGroup;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::all();
        $categoryGroups = CategoryGroup::orderBy('sort_order', 'asc')->get();

        return view('index', compact('categories', 'categoryGroups'));
    }

    public function search(Request $request)
    {
        $key = $request->key;
        $products = Product::with('featuredImage')
            ->where('name', 'like', "%$key%")
            ->paginate(config('app.pagination'))
            ->withQueryString();
        $breadcrumb = [
            ['label' => 'Kết quả tìm kiếm cho ' . $key]
        ];

        return view('search', compact('products', 'key', 'breadcrumb'));
    }
}
