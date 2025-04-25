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

/**
 * @OA\Schema(
 *     title="Cart",
 *     description="Cart model",
 *     @OA\Property(property="id", type="integer", format="int64", description="ID корзины"),
 *     @OA\Property(property="total_amount", type="string", description="Общая сумма в корзине"),
 *     @OA\Property(property="user", ref="#/components/schemas/User"),
 *     @OA\Property(property="cartitem", type="array", @OA\Items(ref="#/components/schemas/CartItem"))
 * )
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
