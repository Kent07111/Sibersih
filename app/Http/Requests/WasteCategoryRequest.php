<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WasteCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $category = $this->route('waste_category');

        return [

            'code' => [
                'required',
                'max:20',
                Rule::unique('waste_categories', 'code')
                    ->ignore($category?->id),
            ],

            'name' => [
                'required',
                'max:255',
            ],

            'description' => [
                'nullable',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],

        ];
    }
}
