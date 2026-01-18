<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductsSaleOff extends Component
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
        $products = Product::whereNotNull('price')
            ->with('featuredImage')
            ->whereColumn('price', '>', 'sale_price')
            ->take($this->limit)
            ->get();
        return view('components.products', [
            'products' => $products,
            'title' => 'Sản phẩm đang khuyến mại'
        ]);
    }
}
