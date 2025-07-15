<?php

namespace App\Http\Controllers;

use App\Domain\Repositories\CategoryInterface;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected CategoryInterface $createCategory;

    public function __construct(CategoryInterface $createCategory)
    {
        $this->createCategory = $createCategory;
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
}
