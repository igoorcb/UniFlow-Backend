<?php

namespace App\Http\Controllers;

use App\Domain\Interface\ProductInterface;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductInterface $productRepository;

    public function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $product = $this->productRepository->updateProduct($id, $request);
            return response()->json(['product' => $product], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Falha ao atualizar produto',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function store(ProductRequest $request)
    {
        try {
            $product = $this->productRepository->createProduct($request->validated());

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
    public function destroy($id){
        try {
            $product = $this->productRepository->deleteProduct($id);
            return response()->json(['message' => 'Produto deletado com sucesso.'], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Falha ao deletar produto',
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
