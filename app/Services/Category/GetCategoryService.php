<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\BaseService;

class GetCategoryService extends BaseService
{
    public function handle()
    {
        return Category::all();
    }
}
