<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Address
 * @property int $id
 * @property string $country
 * @property string $company
 * @property string $street
 * @property int $house
 * @property int $apartment
 * @property string $city
 * @property string $state
 * @property int $postal_code
 * @property string $delivery_instruction
 */

/**
 * @OA\Schema(
 *     title="Address",
 *     description="Address model",
 *     @OA\Property(property="id", type="integer", format="int64", description="ID of the address"),
 *     @OA\Property(property="country", type="string", description="Country of the address"),
 *     @OA\Property(property="company", type="string", description="Company name"),
 *     @OA\Property(property="street", type="string", description="Street name"),
 *     @OA\Property(property="house", type="integer", format="int32", description="House number"),
 *     @OA\Property(property="apartment", type="integer", format="int32", description="Apartment number"),
 *     @OA\Property(property="city", type="string", description="City name"),
 *     @OA\Property(property="state", type="string", description="State name"),
 *     @OA\Property(property="postal_code", type="integer", format="int32", description="Postal code"),
 *     @OA\Property(property="delivery_instruction", type="string", description="Delivery instructions")
 * )
 */
class Address extends Model
{
    /** @use HasFactory<\Database\Factories\AddressFactory> */
    use HasFactory;

    protected $fillable = [
        'country',
        'company',
        'street',
        'house',
        'apartment',
        'city',
        'state',
        'postal_code',
        'delivery_instruction',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function orderdetail(): BelongsTo {
        return $this->belongsTo(OrderDetail::class, 'orderdetail_id');
    }
}
