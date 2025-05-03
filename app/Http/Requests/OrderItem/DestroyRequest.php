<?php

namespace App\Http\Requests\OrderItem;

use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        $orderItem = $this->route('orderItem');
        return $orderItem && $orderItem->orderDetail && $orderItem->orderDetail->myOrders && $orderItem->orderDetail->myOrders->user_id === auth()->id(); 
    }

    public function rules(): array
    {
        return [];
    }
}
