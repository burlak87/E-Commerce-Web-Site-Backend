<?php

namespace App\Http\Requests\OrderDetail;

use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    // public function authorize(): bool
    // {
    //     $orderDetail = $this->route('orderDetail');
    //     return $orderDetail && $orderDetail->order && $orderDetail->order->user_id === auth()->id(); 
    // }

    public function rules(): array
    {
        return [];
    }
}
