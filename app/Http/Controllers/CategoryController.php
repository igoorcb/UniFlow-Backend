<?php

namespace App\Http\Controllers;

use App\Domain\Interface\CategoryInterface;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected CategoryInterface $createCategory;
    public function __construct(CategoryInterface $createCategory)
    {
        $this->createCategory = $createCategory;
    }
    public function index()
    {
        $categories = $this->createCategory->getCategories();
        return response()->json([
            'categories' => $categories,
        ], 200);
    }
    public function store(CategoryRequest $request): JsonResponse
    {
        try {
            $category = $this->createCategory->CreateCategory($request->validated());

            return response()->json([
                'category' => $category,
            ],201);

        }  catch (\Exception $e) {
            return response()->json([
                'error' => 'Falha ao criar a categoria',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function update(UpdateCategoryRequest $request, $id)
    {
        try {
            $category = $this->createCategory->updateCategories($id, $request);
            return response()->json(['category' => $category], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Falha ao atualizar categoria',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $category = $this->createCategory->deleteCategories($id);
            return response()->json(['message' => 'Produto deletado com sucesso.'], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Falha ao deletar produto',
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
