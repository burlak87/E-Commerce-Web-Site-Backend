<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order Item
 * @property int $id
 * @property int $quantity
 * @property Collection $order_detail
 * @property Collection $product
 */

/**
 * @OA\Schema(
 *     title="OrderItem",
 *     description="Order Item model",
 *     @OA\Property(property="id", type="integer", format="int64", description="ID элемента заказа"),
 *     @OA\Property(property="quantity", type="integer", description="Количество продукта в заказе"),
 *     @OA\Property(property="orderdetail", ref="#/components/schemas/OrderDetail"),
 *     @OA\Property(property="product", ref="#/components/schemas/Product")
 * )
 */
class OrderItem extends Model
{
    /** @use HasFactory<\Database\Factories\OrderItemFactory> */
    use HasFactory;

    protected $fillable = ['quantity'];

    public function orderdetail(): HasOne {
        return $this->hasOne(OrderDetail::class, 'orderdetail_id');
    }

    public function product(): HasOne {
        return $this->hasOne(Product::class, 'product_id');
    }
}
