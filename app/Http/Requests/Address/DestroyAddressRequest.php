<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class DestroyAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        $address = $this->route('address');
        return $address && $address->user_id === auth()->id(); 
    }

    public function rules(): array
    {
        return [];
    }
}
