<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Services\User\CreateUserServices;
use App\Services\User\DeleteUserServices;
use App\Services\User\GetUserServices;
use App\Services\User\UpdateUserServices;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function getData()
    {
        $dataUser = resolve(GetUserServices::class)->handle();

        if (!$dataUser) {
            return response()->json([
                'message' => 'Không có dữ liệu người dùng',
            ], Response::HTTP_NO_CONTENT);
        }

        return response()->json([
            'message' => 'Lấy dữ liệu người dùng thành công',
            'data' => $dataUser
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $userService = resolve(CreateUserServices::class)->setParams($request->all());
        $response = $userService->handle();

        return response()->json($response->getData(), $response->getStatusCode());
    }

    public function update(Request $request)
    {
        $updateUserService = resolve(UpdateUserServices::class)
            ->setParams($request->all());
        $response = $updateUserService->handle();

        return response()->json($response->getData(), $response->getStatusCode());
    }

    public function delete($id)
    {
        $deleteUserService = resolve(DeleteUserServices::class)->setParams(['id' => $id]);
        $response = $deleteUserService->handle();

        return response()->json(
            $response->getData(),
            $response->getStatusCode()
        );
    }
}
