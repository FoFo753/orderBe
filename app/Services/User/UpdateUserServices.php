<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserServices extends BaseService
{
    public function handle()
    {
        $user = User::find($this->data['id']);

        if (!$user) {
            return response()->json([
                'message' => 'Không tìm thấy người dùng',
                'data' => null,
            ], Response::HTTP_BAD_REQUEST);
        }

        $user->update($this->data);

        return response()->json([
            'message' => 'Cập nhật người dùng thành công',
            'data' => $user,
        ], Response::HTTP_OK);
    }
}
