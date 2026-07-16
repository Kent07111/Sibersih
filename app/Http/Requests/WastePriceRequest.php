<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WastePriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'category_id' => [
                'required',
                'exists:waste_categories,id',
            ],

            'price_per_kg' => [
                'required',
                'numeric',
                'min:0',
            ],

            'point_per_kg' => [
                'required',
                'integer',
                'min:0',
            ],

            'effective_date' => [
                'required',
                'date',
            ],

            'expired_date' => [
                'nullable',
                'date',
                'after_or_equal:effective_date',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],

        ];
    }
}
