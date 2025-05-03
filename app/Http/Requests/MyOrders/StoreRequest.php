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
            'my-order.status' => 'required|string|max:255',
            'my-order.number' => 'required|string',
            'my-order.date' => 'required|date_format:Y-m-d',
            'my-order.estimated_date' => 'required|date_format:Y-m-d',
            'my-order.payment_method' => 'required|string|max:19',
            'my-order.order_details_id' => 'required|integer',
        ];
    }
}
