<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Review
 * @property int $id
 * @property int $rating
 * @property string $comment
 * @property mixed $createdAt
 * @property Collection $user
 * @property Collection $product
 */
class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;

    protected $fillable = [
        'rating',
        'comment',
        'createdAt'
    ];

    public function user(): HasOne {
        return $this->hasOne(User::class, 'user_id');
    }

    public function product(): HasOne {
        return $this->hasOne(Product::class, 'product_id');
    }
}
