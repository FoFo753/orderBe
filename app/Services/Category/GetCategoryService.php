<?php

namespace App\Services\Category;

use App\Enums\Category\StatusCategory;
use App\Models\Category;
use App\Services\BaseService;

class GetCategoryService extends BaseService
{
    public function handle()
    {
        return Category::where('status', StatusCategory::OPEN)->get();
    }
}
