<?php

namespace App\Services\Customer;

use App\Models\Customer;
use App\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;

class DeleteCustomerService extends BaseService
{
    public function handle()
    {
        $customer = Customer::find($this->data['id']);

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
