<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order Detail
 * @property int $id
 * @property string $total_amount
 * @property Collection $address
 */

/**
 * @OA\Schema( 
 *     title="OrderDetail",
 *     description="Order Detail model",
 *     @OA\Property(property="id", type="integer", format="int64", description="ID детали заказа"),
 *     @OA\Property(property="total_amount", type="string", description="Общая сумма заказа"),
 *     @OA\Property(property="address", ref="#/components/schemas/Address"),
 *     @OA\Property(property="myorders", ref="#/components/schemas/MyOrders"),
 *     @OA\Property(property="orderitem", type="array", @OA\Items(ref="#/components/schemas/OrderItem"))
 * ) 
 */
class OrderDetail extends Model
{
    /** @use HasFactory<\Database\Factories\OrderDetailFactory> */
    use HasFactory;

    protected $fillable = ['total_amount'];

    public function address(): HasOne {
        return $this->hasOne(Address::class, 'address_id');
    }

    public function myorders(): BelongsTo {
        return $this->belongsTo(MyOrders::class, 'myorders_id');
    }

    public function orderitem(): BelongsTo {
        return $this->belongsTo(OrderItem::class, 'orderitem_id');
    }
}
