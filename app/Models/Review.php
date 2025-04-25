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

/**
 * @OA\Schema(
 *     title="Review",
 *     description="Review model",
 *     @OA\Property(property="id", type="integer", format="int64", description="ID of the review"),
 *     @OA\Property(property="rating", type="integer", description="Rating given by the user"),
 *     @OA\Property(property="comment", type="string", description="Comment provided by the user"),
 *     @OA\Property(property="createdAt", type="string", format="date-time", description="Timestamp when the review was created"),
 *     @OA\Property(property="user", ref="#/components/schemas/User"),
 *     @OA\Property(property="product", ref="#/components/schemas/Product")
 * )
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
