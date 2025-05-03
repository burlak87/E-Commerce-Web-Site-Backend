<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        $review = $this->route('review');
        return $review && $review->user_id === auth()->id(); 
    }

    public function rules(): array
    {
        return [];
    }
}
