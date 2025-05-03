<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order Item
 * @property int $id
 * @property int $quantity
 * @property Collection $order_detail
 * @property Collection $product
 */
class OrderItem extends Model
{
    /** @use HasFactory<\Database\Factories\OrderItemFactory> */
    use HasFactory;

    protected $fillable = ['quantity', 'order_detail_id', 'product_id'];

    public function orderDetail(): BelongsTo {
        return $this->belongsTo(OrderDetail::class, 'order_detail_id');
    }

    public function product(): HasOne {
        return $this->hasOne(Product::class, 'product_id');
    }
}
