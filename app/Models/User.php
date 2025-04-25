<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

/**
 * @OA\Schema(
 *     title="User ",
 *     description="User  model",
 *     @OA\Property(property="id", type="integer", format="int64", description="ID of the user"),
 *     @OA\Property(property="first_name", type="string", description="First name of the user"), 
 *     @OA\Property(property="last_name", type="string", description="Last name of the user"),
 *     @OA\Property(property="email", type="string", format="email", description="Email address of the user"),
 *     @OA\Property(property="phone", type="string", description="Phone number of the user"),
 *     @OA\Property(property="role", type="string", description="Role of the user in the application"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Timestamp when the user was created"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Timestamp when the user was last updated")
 * )
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasApiTokens, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password_hash',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'username';
    }

    public function wishlist(): HasOne {
        return $this->hasOne(Wishlist::class, 'wishlist_id');
    }

    public function myorders(): HasMany {
        return $this->hasMany(MyOrders::class, 'myorders_id');
    }

    public function address(): HasMany {
        return $this->hasMany(Address::class, 'address_id');
    }

    public function cart(): BelongsTo {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function review(): BelongsTo {
        return $this->belongsTo(Review::class, 'review_id');
    }

    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = bcrypt($password);
    }
}