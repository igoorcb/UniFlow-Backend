<?php

namespace App\Application\Repository;

use App\Domain\Repositories\CreateProductInterface;
use Illuminate\Http\Request;
use App\Models\Product;

class CreateProductRepository implements CreateProductInterface
{

    public function createProduct($request)
    {

        $create = new product();
        $create->name = $request->name;
        $create->description = $request->description;
        $create->price = $request->price;
        $create->stock = $request->stock;
        $create->category_id = $request->category_id;
        $create->sku = $request->sku;
        $create->image_url = $request->image_url;
        $create->is_active = $request->is_active;

        $create->save();

        return $create;
    }

}
