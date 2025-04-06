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
class product extends Model
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
