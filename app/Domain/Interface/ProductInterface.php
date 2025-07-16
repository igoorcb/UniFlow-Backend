<?php

namespace App\Domain\Interface;


use App\Models\Product;

interface ProductInterface
{
    public function createProduct(array $data): Product;
    public function updateProduct($id, $request): Product;
    public function deleteproduct($id): Product;
}
