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
        $createCategory = $this->createCategory->CreateCategory($request);

        $category = [
            'id' => $createCategory['id'],
            'name' => $createCategory['name'],
            'description' => $createCategory['description'],
            'is_active' => $createCategory['is_active'],
            'updated_at' => $createCategory['updated_at'],
            'created_at' => $createCategory['created_at'],
        ];

        return response()->json([
            'category' => $category,
        ], 201);
    }


}
