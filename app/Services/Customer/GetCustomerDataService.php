<?php

namespace App\Services\Customer;

use App\Models\Customer;
use App\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;

class GetCustomerDataService extends BaseService
{
    public function handle()
    {
        $data = Customer::all();

        return response()->json([
            'data' => $data,
            'message' => 'Lấy dữ liệu thành công'
        ], Response::HTTP_OK);
    }
}
