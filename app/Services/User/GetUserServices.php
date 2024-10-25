<?php

namespace App\Services\User;

use App\Enums\User\UserStatus;
use App\Models\User;
use App\Services\BaseService;

class GetUserServices extends BaseService
{
    public function handle()
{
    $data = User::where('status', UserStatus::ACTIVE)->get();

    if ($data->isEmpty()) return false;

    return $data;
}

}
