<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'total_amount', 'status', 'customer_name', 'shipping_address', 'phone', 'note'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
