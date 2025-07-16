<?php

namespace App\Domain\Interface;


use App\Models\Category;

interface CategoryInterface
{
    public function CreateCategory(array $data): Category;
}
