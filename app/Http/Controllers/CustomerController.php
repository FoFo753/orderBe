<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    public function getData()
    {
        $data = Customer::get();
        
        return response()->json([
            'data' => $data,
            'message' => 'Lấy dữ liệu thành công'
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $check = Customer::where('phoneNumber', $request->phoneNumber)->first();
        if ($check) {
            return response()->json([
                'message' => 'Số điện thoại đã tồn tại'
            ], Response::HTTP_BAD_REQUEST);
        }

        $customer = Customer::create([
            'phoneNumber'  => $request->phoneNumber,
            'fullName'     => $request->fullName,
            'OTP'          => $request->OTP,
            'point'        => 0, 
            'pointRank'    => 0, 
        ]);

        return response()->json([
            'data' => $customer,
            'message' => 'Tạo mới thành công'
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request)
    {
        $customer = Customer::find($request->id);
        if (!$customer) {
            return response()->json([
                'message' => 'Không tìm thấy khách hàng'
            ], Response::HTTP_NOT_FOUND);
        }

        $customer->update($request->all());

        return response()->json([
            'data' => $customer,
            'message' => 'Cập nhật thành công'
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete();

            return response()->json([
                'message' => 'Xóa thành công',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Khách hàng này không tồn tại',
        ], Response::HTTP_BAD_REQUEST);
    }
}
