<?php

namespace App\Services\Customer;

use App\Models\Customer;
use App\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;

class CreateCustomerService extends BaseService
{
    public function handle()
    {
        $check = Customer::where('phoneNumber', $this->data['phoneNumber'])->first();

        if ($check) {
            return response()->json([
                'message' => 'Số điện thoại này đã tồn tại',
            ], Response::HTTP_BAD_REQUEST);
        }

        $customer = Customer::create([
            'phoneNumber' => $this->data['phoneNumber'],
            'fullName'    => $this->data['fullName'],
            'OTP'         => $this->data['OTP'],
        ]);

        return response()->json([
            'message' => 'Tạo khách hàng thành công',
            'data' => $customer,
        ], Response::HTTP_CREATED);
    }
}
