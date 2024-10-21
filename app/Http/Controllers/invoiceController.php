<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class invoiceController extends Controller
{
    public function getData()
    {
        $invoice = Invoice::get();

        return response()->json([
            'message' => 'Lấy Data Invoice thành công',
            'data' => $invoice,
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $invoice = Invoice::where('id_booking', $request->id_booking)->first();

        if ($invoice) {
            return response()->json([
                'message' => 'Invoice này đã tồn tại',
            ], Response::HTTP_BAD_REQUEST);
        }

        $invoice = Invoice::create([
            'id_booking'   => $request->id_booking,
            'timeEnd'   => $request->timeEnd,
            'total'   => $request->total,
            'id_user'   => $request->id_user,
        ]);

        return response()->json([
            'message' => 'Tạo Invoice thành công',
            'data' => $invoice,
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request)
    {
        $invoice = Invoice::find($request->id_booking)->first();

        if (!$invoice) {
            return response()->json([
                'message' => 'Không có Invoice này',
                'data' => $invoice,
            ], Response::HTTP_BAD_REQUEST);
        }

        $invoice->update($request->all());

        return response()->json([
            'message' => 'Cập nhật hoá đơn thành công',
            'data' => $invoice,
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $invoice = Invoice::find($id);

        if ($invoice) {
            $invoice->delete();

            return response()->json([
                'message' => 'Xoá hoá đơn thành công',
                'id' => $id,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Hoá đơn ko tồn tại',
        ], Response::HTTP_BAD_REQUEST);
    }
}
