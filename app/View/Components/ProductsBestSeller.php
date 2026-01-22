<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductsBestSeller extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $limit = 30)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $products = Product::orderByDesc('sold_count')
            ->with('featuredImage')
            ->take($this->limit)
            ->get();
        return view('components.products', [
            'products' => $products,
            'title' => 'Sản phẩm bán chạy nhất'
        ]);
    }
}
