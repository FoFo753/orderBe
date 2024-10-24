<?php

namespace App\Services\User;

use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use App\Models\User;
use App\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;

class CreateUserServices extends BaseService
{
    public function handle()
    {
        $check = User::where('email', $this->data['email'])
            ->orWhere('phoneNumber', $this->data['phoneNumber'])
            ->first();

        if ($check) {
            return response()->json([
                'message' => 'Email hoặc số điện thoại đã tồn tại',
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = User::create([
            'name'        => $this->data['name'],
            'email'       => $this->data['email'],
            'phoneNumber' => $this->data['phoneNumber'],
            'birth'       => $this->data['birth'],
            'role'        => UserRole::STAFF,
            'status'      => UserStatus::ACTIVE,
        ]);

        return response()->json([
            'message' => 'Tạo người dùng thành công',
            'data' => $user,
        ], Response::HTTP_CREATED);
    }
}
