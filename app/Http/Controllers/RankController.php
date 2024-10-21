<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RankController extends Controller
{
    public function getData()
    {
        $dataRank = Rank::get();

        return response()->json([
            'message' => 'Lấy dữ liệu Rank thành công',
            'data' => $dataRank
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $check = Rank::where('nameRank', $request->nameRank)->first();

        if ($check) {

            return response()->json([
                'message' => 'Rank đã tồn tại',
            ], Response::HTTP_BAD_REQUEST);
        }

        $rank = Rank::create([
            'nameRank'   => $request->nameRank,
            'necessaryPoints'   => $request->necessaryPoints,
            'saleRank'   => $request->saleRank,
        ]);

        return response()->json([
            'message' => 'Tạo Rank thành công',
            'data' => $rank,
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request)
    {
        $rank = Rank::find($request->id);

        if (!$rank) {

            return response()->json([
                'message' => 'Không có Rank này',
                'data' => $rank,
            ], Response::HTTP_BAD_REQUEST);
        }

        $rank->update($request->all());

        return response()->json([
            'message' => 'Cập nhật Rank thành công',
            'data' => $rank,
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $check = Rank::find($id);

        if ($check) {
            $check->delete();

            return response()->json([
                'message' => 'Xoá Rank thành công',
                'id' => $id,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Rank không tồn tại',
        ], Response::HTTP_BAD_REQUEST);
    }
}
