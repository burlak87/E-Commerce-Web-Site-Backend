<?php

namespace App\Http\Requests\MyOrders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('my-orders')->user->id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'status' => 'sometimes|string|max:255',
            'number' => 'sometimes|string',
            'date' => 'sometimes|date_format:Y_m_d',
            'estimated_date' => 'sometimes|date_format:Y_m_d',
            'payment_method' => 'sometimes|string|max:19',
            'order_details_id' => 'sometimes|integer',
        ];
    }
}
