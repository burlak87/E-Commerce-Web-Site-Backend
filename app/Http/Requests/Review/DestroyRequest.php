<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('review')->user->id === auth()->id();
    }

    public function rules(): array
    {
        return [];
    }
}
