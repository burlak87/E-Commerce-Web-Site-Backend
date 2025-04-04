<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public static $wrap = 'product';
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock_quantity' => $this->stock_quantity,
            'image_url' => $this->image_url,
            'color' => $this->color,
            'size' => $this->size,
            'category' => $this->category,
            'type_product' => $this->type_product,
            'dress_style' => $this->dress_style,
        ];
    }
}
