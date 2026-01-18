<?php

namespace App\Models;

use App\Helpers\SlugHelper;
use Hamcrest\Core\AllOf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements \Spatie\MediaLibrary\HasMedia
{
    use SoftDeletes, \Spatie\MediaLibrary\InteractsWithMedia;

    protected $fillable = ['name', 'slug', 'description'];

    protected static function booted()
    {
        static::saving(function ($category) {
            if (empty($category->slug) || $category->isDirty('name')) {
                $category->slug = SlugHelper::generateUniqueSlug(self::class, $category->name);
            }
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
