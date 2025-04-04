<?php

namespace App\Http\Requests\MyOrders;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'required|string|max:255',
            'number' => 'required|string',
            'date' => 'required|date_format:Y_m_d',
            'estimated_date' => 'required|date_format:Y_m_d',
            'payment_method' => 'required|string|max:19',
            'order_details_id' => 'required|integer',
        ];
    }
}
