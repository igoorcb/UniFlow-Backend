<?php

namespace App\Domain\Repositories;


use App\Models\Category;

interface CategoryInterface
{
    public function CreateCategory(array $data): Category;
}
