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

/**
 * @OA\Schema(
 *     title="CartItem",
 *     description="Cart Item model",
 *     @OA\Property(property="id", type="integer", format="int64", description="ID элемента корзины"),
 *     @OA\Property(property="quantity", type="integer", description="Количество продукта в корзине"),
 *     @OA\Property(property="cart", ref="#/components/schemas/Cart"),
 *     @OA\Property(property="product", ref="#/components/schemas/Product")
 * )
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
