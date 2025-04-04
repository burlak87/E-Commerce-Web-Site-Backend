<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Wishlist
 * @property int $id
 * @property string $total_amount
 */
class Wishlist extends Model
{
    /** @use HasFactory<\Database\Factories\WishlistFactory> */
    use HasFactory;

    protected $fillable = ['total_amount'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function wishlistitem(): BelongsTo {
        return $this->belongsTo(WishlistItem::class);
    }
}
