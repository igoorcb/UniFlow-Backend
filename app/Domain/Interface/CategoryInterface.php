<?php

namespace App\Domain\Interface;


use App\Models\Category;

interface CategoryInterface
{
    public function CreateCategory(array $data): Category;
    public function getCategories();
    public function updateCategories($id, $request): Category;
    public function deleteCategories($id): Category;
}
