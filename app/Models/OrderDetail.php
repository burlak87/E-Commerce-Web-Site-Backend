<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order Detail
 * @property int $id
 * @property string $total_amount
 * @property int $address_id
 * @property Collection $address
 */
class OrderDetail extends Model
{
    /** @use HasFactory<\Database\Factories\OrderDetailFactory> */
    use HasFactory;

    protected $fillable = ['total_amount', 'address_id'];

    public function address(): HasOne {
        return $this->hasOne(Address::class, 'address_id');
    }

    public function myOrders(): BelongsTo {
        return $this->belongsTo(MyOrders::class, 'myOrders_id');
    }

    public function orderItem(): HasMany {
        return $this->hasMany(OrderItem::class, 'orderItem_id');
    }
}
