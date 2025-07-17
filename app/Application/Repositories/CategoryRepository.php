<?php

namespace App\Application\Repositories;

use App\Domain\Interfaces\CategoryInterface;
use App\Models\Category;
use Exception;
use Illuminate\Database\Eloquent\Collection;

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

    public function getCategories(): Collection
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
