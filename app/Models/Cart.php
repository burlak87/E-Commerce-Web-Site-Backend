<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cart
 * @property int $id
 * @property string $total_amount
 * @property Collection $user
 */
class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;

    protected $fillable = ['total_amount'];

    public function user(): HasOne {
        return $this->hasOne(User::class, 'user_id');
    }

    public function cartitem(): BelongsTo {
        return $this->belongsTo(CartItem::class, 'cartitem_id');
    }
}
