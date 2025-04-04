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
