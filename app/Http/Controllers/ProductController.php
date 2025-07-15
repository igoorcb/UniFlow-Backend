<?php

namespace App\Http\Controllers;

use App\Domain\Repositories\ProductInterface;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductInterface $createProduct;

    public function __construct(ProductInterface $createProduct)
    {
        $this->createProduct = $createProduct;
    }

    public function store(ProductRequest $request)
    {
        try {
            $product = $this->createProduct->createProduct($request);
            return response()->json([
                'product' => $product,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Falha ao criar produto',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
