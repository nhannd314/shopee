<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductsByCategory extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $cat = '', public $limit = 30, public $title = '')
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $ids = explode(',', $this->cat);
        $products = Product::whereIn('category_id', $ids)->with('featuredImage')->latest()->take($this->limit)->get();
        return view('components.products-by-category', [
            'products' => $products,
            'title' => $this->title
        ]);
    }
}
