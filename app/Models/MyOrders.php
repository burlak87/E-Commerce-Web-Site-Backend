<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class My Orders
 * @property int $id
 * @property string $status
 * @property string $number
 * @property Carbon $date
 * @property Carbon $estimated_date
 * @property string $payment_method
 */
class MyOrders extends Model
{
    /** @use HasFactory<\Database\Factories\MyOrdersFactory> */
    use HasFactory;

    protected $fillable = [
        'status',
        'number',
        'date',
        'estimated_date',
        'payment_method'
    ];

    public function orderdetail(): HasOne {
        return $this->hasOne(OrderDetail::class, 'orderdetail_id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}