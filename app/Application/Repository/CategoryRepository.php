<?php

namespace App\Application\Repository;

use App\Domain\Interface\CategoryInterface;
use App\Models\Category;
use Exception;

class CategoryRepository implements CategoryInterface
{

    public function CreateCategory(array $data): Category
    {
        return Category::create([
            'name'        => $data['name'],
            'description' => $data['description'] ?? null,
            'is_active'   => $data['is_active'] ?? true,
        ]);
    }
    public function getCategories()
    {
        return Category::all();
    }
    public function updateCategories($id, $request): Category
    {
        $category = Category::find($id);
        $category->fill($request->all());
        $category->save();
        return $category;
    }
    public function deleteCategories($id): Category
    {
        $categories = Category::find($id);

        if(!$categories){
            throw new Exception('Category not found');
        }

        $categories->delete();
        return $categories;
    }

}
