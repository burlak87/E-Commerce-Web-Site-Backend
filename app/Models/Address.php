<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderdetail(): BelongsTo {
        return $this->belongsTo(OrderDetail::class, 'orderdetail_id');
    }
}
