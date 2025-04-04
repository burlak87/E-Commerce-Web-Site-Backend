<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'total_amount' => $this->total_amount,
            'address_id' => $this->address_id,
            'order_item' => [
                // ...
            ]
        ];
    }
}
