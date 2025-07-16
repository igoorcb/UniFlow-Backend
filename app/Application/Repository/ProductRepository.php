<?php

namespace App\Application\Repository;

use App\Domain\Interface\ProductInterface;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductRepository implements ProductInterface
{

    public function createProduct(array $data): Product
    {
        return Product::create([
            'name'        => $data['name'],
            'description' => $data['description'],
            'price'       => $data['price'],
            'stock'    => $data['stock'],
            'category_id' => $data['category_id'],
            'sku'    => $data['sku'],
            'image_url'    => $data['image_url'] ,
            'is_active'    => $data['is_active'] ?? true,
        ]);
    }

    public function updateProduct($id, $request): Product
    {
        $product = Product::find($id);
        $product->fill($request->all());
        $product->save();
        return $product;
    }

    public function deleteProduct($id): Product
    {
        $product = Product::find($id);

        if(!$product){
            throw new Exception('Product not found');
        }

        $product->delete();
        return $product;
    }

}
