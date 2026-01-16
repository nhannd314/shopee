<?php

namespace App\Models;

use App\Helpers\SlugHelper;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title', 'slug', 'content'];

    protected static function booted()
    {
        static::saving(function ($page) {
            if (empty($page->slug) || $page->isDirty('title')) {
                $page->slug = SlugHelper::generateUniqueSlug(self::class, $page->title);
            }
        });
    }
}
