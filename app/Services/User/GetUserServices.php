<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\BaseService;

class GetUserServices extends BaseService
{
    public function handle()
    {
        $data = User::get();

        if (!$data) return false;

        return $data;
    }
}
