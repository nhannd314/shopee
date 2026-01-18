<?php

namespace App\Models;

use App\Helpers\SlugHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $fillable = ['name', 'slug', 'description', 'category_id', 'price', 'sale_price'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected static function booted()
    {
        static::saving(function ($product) {
            if (empty($product->slug) || $product->isDirty('name')) {
                $product->slug = SlugHelper::generateUniqueSlug(self::class, $product->name);
            }
        });
    }

    public function featuredImage(): MorphOne
    {
        // Lấy 1 quan hệ media duy nhất thuộc collection 'products_gallery'
        return $this->morphOne(config('media-library.media_model'), 'model')
            ->where('collection_name', 'products_gallery')
            ->orderBy('order_column');
    }

    // Hàm lấy ảnh đại diện
    public function getFeaturedImageAttribute(): string
    {
        // Kiểm tra xem quan hệ 'featuredImage' đã được nạp (Eager Load) chưa
        // Nếu đã nạp thì lấy từ bộ nhớ, nếu chưa thì thực hiện truy vấn (Lazy Load)
        $media = $this->getRelationValue('featuredImage') ?: $this->featuredImage()->first();

        return $media ? $media->getUrl() : asset('img/default-product.jpg');
    }

    protected function formatPrice($price): string
    {
        return number_format($price, 0, '.', ',') . 'đ';
    }
    public function getFormattedPriceAttribute(): string
    {
        return $this->sale_price ? $this->formatPrice($this->sale_price) : $this->formatPrice($this->price);
    }

    public function getFormattedRegularPriceAttribute(): string
    {
        return $this->sale_price ? $this->formatPrice($this->price) : '';
    }

    public function getSalePercentAttribute(): string
    {
        return $this->sale_price ? round(($this->price-$this->sale_price)*100/$this->price) : '';
    }
}
