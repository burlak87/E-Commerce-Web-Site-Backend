<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WishlistResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'total_amount' => $this->total_amount,
            'wishlist_item' => [
                // ...
            ],
            'user' => [
                // ...
            ],
        ];
    }
}
