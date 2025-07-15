<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|string|unique:products,sku',
            'category_id' => 'required|string',
            'image_url' => 'nullable|url',
            'is_active' => 'boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
        ];
    }
}
