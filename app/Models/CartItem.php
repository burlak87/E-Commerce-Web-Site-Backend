<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cart Item
 * @property int $id
 * @property int $quantity
 * @property Collection $cart
 * @property Collection $product
 */
class CartItem extends Model
{
    /** @use HasFactory<\Database\Factories\CartItemFactory> */
    use HasFactory;

    protected $fillable = ['quantity'];

    public function cart(): HasOne {
        return $this->hasOne(Cart::class, 'cart_id');
    }

    public function product(): HasOne {
        return $this->hasOne(Product::class,'product_id');
    }
}
