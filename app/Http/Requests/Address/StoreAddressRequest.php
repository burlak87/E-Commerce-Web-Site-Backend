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
            'addresses.country' => 'required|string',
            'addresses.company' => 'sometimes|string',
            'addresses.street' => 'required|string',
            'addresses.house' => 'required|integer',
            'addresses.apartment' => 'sometimes|integer',
            'addresses.city' => 'required|string',
            'addresses.state' => 'sometimes|string',
            'addresses.postal_code' => 'required|integer',
            'addresses.delivery_instruction' => 'required|string',
        ];
    }
}
