<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;

class UpdateCategoryService extends BaseService
{
    public function handle()
    {


        $category = Category::find($this->data['id']);

        if (!$category) return false;

        return $category->update([
            'status' => $this->data['status'],
            'name' => $this->data['name'],
        ]);
    }
}
