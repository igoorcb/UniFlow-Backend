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
