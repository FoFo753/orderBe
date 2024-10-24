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
        $customerDataService = resolve(GetCustomerDataService::class);
        $response = $customerDataService->handle();

        return response()->json($response->getData(), $response->getStatusCode());
    }

    public function create(Request $request)
    {
        $createCustomerService = resolve(CreateCustomerService::class)->setParams($request->all());
        $response = $createCustomerService->handle();

        return response()->json($response->getData(), $response->getStatusCode());
    }

    public function update(Request $request)
    {
        $updateCustomerService = resolve(UpdateCustomerService::class)->setParams($request->all());
        $response = $updateCustomerService->handle();

        return response()->json($response->getData(), $response->getStatusCode());
    }

    public function delete($id)
    {
        $deleteCustomerService = resolve(DeleteCustomerService::class)->setParams(['id' => $id]);
        $response = $deleteCustomerService->handle();

        return response()->json($response->getData(), $response->getStatusCode());
    }
}
