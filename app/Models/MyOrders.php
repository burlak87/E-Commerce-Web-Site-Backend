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

/**
 * @OA\Schema(
 *     title="MyOrders",
 *     description="My Orders model",
 *     @OA\Property(property="id", type="integer", format="int64", description="ID заказа"),
 *     @OA\Property(property="status", type="string", description="Статус заказа"),
 *     @OA\Property(property="number", type="string", description="Номер заказа"),
 *     @OA\Property(property="date", type="string", format="date-time", description="Дата заказа"),
 *     @OA\Property(property="estimated_date", type="string", format="date-time", description="Предполагаемая дата доставки"),
 *     @OA\Property(property="payment_method", type="string", description="Метод оплаты"),
 *     @OA\Property(property="orderdetail", ref="#/components/schemas/OrderDetail"),
 *     @OA\Property(property="user", ref="#/components/schemas/User")
 * )
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