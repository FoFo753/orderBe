<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;

class CreateCategoryService extends BaseService
{

    public function handle()
    {

        $category = Category::where('name', $this->data['name'])->first();

        if ($category) {
            return response()->json([
                'message' => 'Category đã tồn tại',
            ], Response::HTTP_BAD_REQUEST);
        }

        $category = Category::create([
            'status' => $this->data['status'],
            'name' => $this->data['name'],
        ]);

        return response()->json([
            'Category' => $category,
        ], Response::HTTP_CREATED);
    }
}
