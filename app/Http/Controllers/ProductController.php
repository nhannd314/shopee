<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show products in category
    public function category(Category $category)
    {
        $products = $category->products()->with('featuredImage')->paginate(config('app.pagination'))->withQueryString();
        $breadcrumb = [
            ['label' => $category->name]
        ];

        return view('category', compact('category', 'products', 'breadcrumb'));
    }

    // Show a single product
    public function show(Product $product)
    {
        $product->load(['category', 'media']);
        $breadcrumb = [
            ['label' => $product->category->name, 'url' => route('category', $product->category)],
            ['label' => $product->name],
        ];

        return view('product', compact('product', 'breadcrumb'));
    }
}
