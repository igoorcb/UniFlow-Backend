<?php

namespace App\Domain\Repositories;


use App\Models\Product;

interface ProductInterface
{
    public function createProduct(array $data): Product;
    public function updateProduct($id, $request): Product;
}
