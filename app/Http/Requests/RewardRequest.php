<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class RewardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $reward = $this->route('reward');

        return [

            'code' => [
                'required',
                'max:20',
                Rule::unique('rewards','code')
                    ->ignore($reward?->id),
            ],

            'name' => [
                'required',
                'max:255',
            ],

            'type' => [
                'required',
                Rule::in([
                    'Uang',
                    'Voucher',
                    'Pulsa',
                    'Sembako',
                    'Barang',
                    'Lainnya',
                ]),
            ],

            'required_point' => [
                'required',
                'integer',
                'min:1',
            ],

            'nominal' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'description' => [
                'nullable',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],

        ];
    }
}
