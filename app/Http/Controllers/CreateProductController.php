<?php

namespace App\Http\Controllers;

use App\Domain\Repositories\CreateProductInterface;
use App\Http\Requests\CreateProductRequest;
use Illuminate\Http\Request;

class CreateProductController extends Controller
{
    protected CreateProductInterface $createProduct;

    public function __construct(CreateProductInterface $createProduct)
    {
        $this->createProduct = $createProduct;
    }

    public function store(CreateProductRequest $request)
    {
        $createProduct = $this->createProduct->createProduct($request);
        $createProduct = [
            'name' => $createProduct['name'],
            'description' => $createProduct['description'],
            'price' => $createProduct['price'],
            'stock' => $createProduct['stock'],
            'category_id' => $createProduct['category_id'],
            'sku' => $createProduct['sku'],
            'image_url' => $createProduct['image_url'],
            'is_active' => $createProduct['is_active'],
            'updated_at' => $createProduct['updated_at'],
            'created_at' => $createProduct['created_at'],
        ];
        return response()->json([
            'products' => $createProduct,
        ], 201);
    }

}
