<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MyOrdersResource extends JsonResource
{
    public static $wrap = 'myOrders';

    public function toArray($request): array
    {
        return [
            'status' => $this->status,
            'number' => $this->number,
            'date' => $this->date,
            'estimated_date' => $this->estimated_date,
            'payment_method' => $this->payment_method,
        ];
    }
}
