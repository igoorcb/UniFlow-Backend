<?php

namespace App\Http\Controllers;

use App\Domain\Repositories\CreateCategoryInterface;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Http\Request;

class CreateCategoryController extends Controller
{
    protected CreateCategoryInterface $createCategory;

    public function __construct(CreateCategoryInterface $createCategory)
    {
        $this->createCategory = $createCategory;
    }

    public function store(CreateCategoryRequest $request)
    {
        try {
            $category = $this->createCategory->createCategory($request);

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
