<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'stock' => 'sometimes|integer',
            'category_id' => 'sometimes|integer',
            'sku' => 'sometimes|string|max:255',
            'image_url' => 'sometimes|url',
            'is_active' => 'sometimes|boolean',
        ];
    }
}
