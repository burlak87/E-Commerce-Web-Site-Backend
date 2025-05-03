<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Wishlist Item
 * @property int $id
 * @property string $quantity
 * @property int $wishlist_id
 * @property int $product_id
 * @property Collection $wishlist
 * @property Collection $product
 */
class WishlistItem extends Model
{
    /** @use HasFactory<\Database\Factories\WishlistItemFactory> */
    use HasFactory;

    protected $fillable = ['quantity', 'wishlist_id', 'product_id'];

    public function wishlist(): BelongsTo {
        return $this->belongsTo(Wishlist::class, 'wishlist_id');
    }

    public function product(): HasOne {
        return $this->hasOne(Product::class, 'product_id');
    }
}
