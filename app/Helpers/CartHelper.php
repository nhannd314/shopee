<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class CartHelper
{
    public static function getTotal($cart)
    {
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
