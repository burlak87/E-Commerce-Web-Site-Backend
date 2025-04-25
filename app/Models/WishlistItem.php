<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Wishlist Item
 * @property int $id
 * @property string $quantity
 * @property Collection $wishlist
 * @property Collection $product
 */

/**
 * @OA\Schema(
 *     title="WishlistItem",
 *     description="Wishlist Item model",
 *     @OA\Property(property="id", type="integer", format="int64", description="ID of the wishlist item"),
 *     @OA\Property(property="quantity", type="string", description="Quantity of the product in the wishlist"),
 *     @OA\Property(property="wishlist", ref="#/components/schemas/Wishlist"),
 *     @OA\Property(property="product", ref="#/components/schemas/Product")
 * )
 */
class WishlistItem extends Model
{
    /** @use HasFactory<\Database\Factories\WishlistItemFactory> */
    use HasFactory;

    protected $fillable = ['quantity'];

    public function wishlist(): HasOne {
        return $this->hasOne(WishlistItem::class, 'wishlist_id');
    }

    public function product(): HasOne {
        return $this->hasOne(Product::class, 'product_id');
    }
}
