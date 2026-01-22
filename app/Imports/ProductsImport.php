<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $categoryName = Str::ucfirst(Str::lower(trim($row['category'])));
        $category = Category::firstOrCreate(['name' => $categoryName]);

        return new Product([
            'name' => $row['name'],
            'sku'  => $row['sku'],
            'category_id' => $category->id,
            'price' => round($row['sale_price'] * rand(105, 120)/100000) * 1000,
            'sale_price' => $row['sale_price'],
            'cost_price' => $row['cost_price'],
        ]);
    }
}
