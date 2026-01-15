<?php

namespace App\Models;

use App\Helpers\SlugHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug', 'description', 'parent_id'];

    protected static function booted()
    {
        static::saving(function ($category) {
            if (empty($category->slug) || $category->isDirty('name')) {
                $category->slug = SlugHelper::generateUniqueSlug(self::class, $category->name);
            }
        });
    }
}
