<?php

namespace App\Http\Controllers;

use App\Services\Customer\CreateCustomerService;
use App\Services\Customer\DeleteCustomerService;
use App\Services\Customer\GetCustomerDataService;
use App\Services\Customer\UpdateCustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getData(Request $request)
    {
        $customer = resolve(GetCustomerDataService::class)->handle();

        return response()->json($customer->getData(), $customer->getStatusCode());
    }

    public function create(Request $request)
    {
        $customer = resolve(CreateCustomerService::class)->setParams($request->all())->handle();

        return response()->json($customer->getData(), $customer->getStatusCode());
    }
    
    public function update(Request $request)
    {
        $customer = resolve(UpdateCustomerService::class)->setParams($request->all())->handle();

        return response()->json($customer->getData(), $customer->getStatusCode());
    }

    public function delete($id)
    {
        $customer = resolve(DeleteCustomerService::class)
            ->setParams(['id' => $id])
            ->handle();
    
        return response()->json($customer->getData(), $customer->getStatusCode());
    }
}
