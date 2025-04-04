<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'country' => 'required|string|max:255',
            'company' => 'sometimes|string|max:255',
            'street' => 'required|string|max:2048',
            'house' => 'required|integer',
            'apartment' => 'sometimes|integer',
            'city' => 'required|string|max:255',
            'state' => 'sometimes|string|max:255',
            'postal_code' => 'required|integer',
            'delivery_instruction' => 'required|string|max:2048'
        ];
    }
}
