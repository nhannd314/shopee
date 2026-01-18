<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    protected $fillable = ['title', 'category_ids', 'sort_order'];

    protected $casts = [
        'category_ids' => 'array'
    ];
}
