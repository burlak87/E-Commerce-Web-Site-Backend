<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public static $wrap = 'address';
    public function toArray($request): array
    {
        return [
            'country' => $this->country,
            'company' => $this->company,
            'street' => $this->street,
            'house' => $this->house,
            'apartment' => $this->apartment,
            'city' => $this->city,
            'state' => $this->state,
            'postal_code' => $this->postal_code,
            'delivery_instruction' => $this->delivery_instruction,
        ];
    }
}