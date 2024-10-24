<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\BaseService;

class DeleteCategoryService extends BaseService
{

    public function handle()
    {
        $category = Category::find($this->data);

        if (!$category) return false;

        return $category->delete();
    }
}
