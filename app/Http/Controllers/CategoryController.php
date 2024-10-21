<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{

    public function getData()
    {
        $category = Category::get();

        return response()->json([
            'message' => 'Lấy dữ liệu category thành công',
            'data' => $category
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $category = Category::where('name', $request->name)->first();

        if ($category) {
            return response()->json([
                'message' => 'Category đã tồn tại',
            ], Response::HTTP_BAD_REQUEST);
        }

        $category = Category::create([
            'status'   => $request->status,
            'name'   => $request->name,
        ]);

        return response()->json([
            'message' => 'Tạo category thành công',
            'data' => $category,
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request)
    {
        $category = Category::where('name', $request->name)->first();


        if (!$category) {
            return response()->json([
                'message' => 'Không có category này',
                'data' => $category,
            ], Response::HTTP_BAD_REQUEST);
        }

        $category->update($request->all());

        return response()->json([
            'message' => 'Cập nhật category thành công',
            'data' => $category,
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $category = Category::where('name', $id)->first();

        if ($category) {
            $category->delete();

            return response()->json([
                'message' => 'Xoá category thành công',
                'data' => $id,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Không có category này',
            'data' => $category,
        ], Response::HTTP_BAD_REQUEST);
    }
}
