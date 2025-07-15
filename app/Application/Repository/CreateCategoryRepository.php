<?php

namespace App\Application\Repository;

use App\Domain\Repositories\CreateCategoryInterface;
use App\Models\Category;

class CreateCategoryRepository implements CreateCategoryInterface
{

    public function CreateCategory($request)
    {

        $create = new category();
        $create->name = $request->name;
        $create->description = $request->description;
        $create->is_active = $request->is_active;

        $create->save();
        return $create;
    }

}
