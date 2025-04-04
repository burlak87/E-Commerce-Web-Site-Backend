<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MyOrdersCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'myOrders' => $this->collection,
            'myOrdersCount' => $this->count(),
        ];
    }
}
