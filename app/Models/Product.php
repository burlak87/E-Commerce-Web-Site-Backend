<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $price
 * @property int $stock_quantity
 * @property string $image_url
 * @property Collection $color
 * @property Collection $size
 * @property string $category
 * @property Collection $type_product
 * @property string $dress_style
 */

/**
 * @OA\Schema(
 *     title="Product",
 *     description="Product model",
 *     @OA\Property(property="id", type="integer", format="int64", description="ID продукта"),
 *     @OA\Property(property="name", type="string", description="Название продукта"),
 *     @OA\Property(property="description", type="string", description="Описание продукта"),
 *     @OA\Property(property="price", type="string", description="Цена продукта"),
 *     @OA\Property(property="stock_quantity", type="integer", description="Количество на складе"),
 *     @OA\Property(property="image_url", type="string", description="URL изображения продукта"),
 *     @OA\Property(property="color", type="string", description="Цвет продукта"),
 *     @OA\Property(property="size", type="string", description="Размер продукта"),
 *     @OA\Property(property="category", type="string", description="Категория продукта"),
 *     @OA\Property(property="type_product", type="string", description="Тип продукта"),
 *     @OA\Property(property="dress_style", type="string", description="Стиль одежды"),
 *     @OA\Property(property="review", type="array", @OA\Items(ref="#/components/schemas/Review")),
 *     @OA\Property(property="cartitem", type="array", @OA\Items(ref="#/components/schemas/CartItem")),
 *     @OA\Property(property="wishlistitem", type="array", @OA\Items(ref="#/components/schemas/WishlistItem")),
 *     @OA\Property(property="orderitem", type="array", @OA\Items(ref="#/components/schemas/OrderItem"))
 * )
 */
class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use Filterable;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'image_url',
        'color',
        'size',
        'category',
        'type_product',
        'dress_style'
    ];

    public function review(): BelongsTo {
        return $this->belongsTo(Review::class, 'review_id');
    }

    public function cartitem(): BelongsTo {
        return $this->belongsTo(Cartitem::class, 'cartitem_id');
    }

    public function wishlistitem(): BelongsTo {
        return $this->belongsTo(WishlistItem::class, 'wishlistitem_id');
    }

    public function orderitem(): BelongsTo {
        return $this->belongsTo(OrderItem::class, 'orderitem_id');
    }
}
