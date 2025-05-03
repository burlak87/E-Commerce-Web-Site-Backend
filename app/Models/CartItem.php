<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cart Item
 * @property int $id
 * @property int $quantity
 * @property int $product_id
 * @property int $cart_id
 * @property Collection $cart
 * @property Collection $product
 */
class CartItem extends Model
{
    /** @use HasFactory<\Database\Factories\CartItemFactory> */
    use HasFactory;

    protected $fillable = ['quantity', 'product_id', 'cart_id'];

    public function cart(): BelongsTo {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function product(): HasOne {
        return $this->hasOne(Product::class,'product_id');
    }
}
