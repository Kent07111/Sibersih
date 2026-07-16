<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WasteDepositRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'note'=>[
                'nullable'
            ],

            'category_id'=>[
                'required',
                'array',
                'min:1'
            ],

            'category_id.*'=>[
                'exists:waste_categories,id'
            ],

            'weight'=>[
                'required',
                'array'
            ],

            'weight.*'=>[
                'required',
                'numeric',
                'min:0.1'
            ]

        ];
    }
}