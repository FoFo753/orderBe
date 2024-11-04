<?php

namespace App\Services\Customer;

use App\Models\Customer;
use App\Models\Rank;
use App\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;

class GetCustomerDataService extends BaseService
{
    public function handle()
    {
        $customers = Customer::all();

        foreach ($customers as $key => $value) {
            $rank = Rank::where('necessaryPoints', '<=', $value['pointRank'])
                ->orderByDesc('necessaryPoints')
                ->first();

            $customers[$key]['ranks'] = trim($rank->nameRank);
        }

        return response()->json([
            'message' => 'Lấy dữ liệu thành công',
            'data' => $customers
        ], Response::HTTP_OK);
    }
}
