<?php

namespace App\Domain\Interfaces;


use App\Models\Product;

interface ProductInterface
{
    public function createProduct(array $data): Product;
    public function updateProduct($id, $request): Product;
    public function deleteproduct($id): Product;
}
