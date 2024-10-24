<?php

namespace App\Services\Customer;

use App\Models\Customer;
use App\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;

class UpdateCustomerService extends BaseService
{
    public function handle()
    {
        $customer = Customer::find($this->data['id']);

        if (!$customer) {
            return response()->json([
                'message' => 'Tìm không thấy khách hàng',
                'data' => null,
            ], Response::HTTP_BAD_REQUEST);
        }

        $customer->update($this->data);

        return response()->json([
            'message' => 'Cập nhật thành công',
            'data' => $customer,
        ], Response::HTTP_OK);
    }
}
