<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;

class DeleteUserServices extends BaseService
{
    public function handle()
    {
        $user = User::find($this->data['id']);

        if ($user) {
            $user->delete();

            return response()->json([
                'message' => 'Xoá người dùng thành công',
                'id' => $this->data['id'],
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'ID người dùng không tồn tại',
        ], Response::HTTP_BAD_REQUEST);
    }
}
