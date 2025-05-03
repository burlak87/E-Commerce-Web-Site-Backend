<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cart
 * @property int $id
 * @property string $total_amount
 * @property int $user_id
 * @property Collection $user
 */
class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;

    protected $fillable = ['total_amount', 'user_id'];

    public function user(): HasOne {
        return $this->hasOne(User::class, 'user_id');
    }

    public function cartItem(): HasMany {
        return $this->hasMany(CartItem::class, 'cartItem_id');
    }
}
