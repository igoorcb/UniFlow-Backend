<?php

namespace App\Application\Repository;

use App\Domain\Interface\CategoryInterface;
use App\Models\Category;
use Illuminate\Support\Arr;

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

}
