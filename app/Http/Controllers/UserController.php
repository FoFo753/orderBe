<?php

namespace App\Http\Controllers;

use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function getData()
    {
        $data = User::get(); 
        
        return response()->json([
            'data' => $data,
            'message' => 'Lấy dữ liệu thành công'
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $check = User::where('email', $request->email)->first();
        if ($check) {
            return response()->json([
                'message' => 'Người đã tồn tại'
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'phoneNumber'   => $request->phoneNumber,
            'birth'         => $request->birth,
            'role'          => UserRole::STAFF,
            'status'        => UserStatus::ACTIVE,
        ]);

        return response()->json([
            'data' => $user,
            'message' => 'Tạo người dùng thành công'
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        if (!$user) {
            return response()->json([
                'message' => 'Người dùng không tồn tại'
            ], Response::HTTP_NOT_FOUND);
        }

        $user->update($request->all());

        return response()->json([
            'data' => $user,
            'message' => 'Cập nhật người dùng thành công'
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();

            return response()->json([
                'message' => 'Xóa thành công',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Người dùng này không tồn tại',
        ], Response::HTTP_BAD_REQUEST);
    }
}
