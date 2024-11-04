<?php

namespace App\Services\Evaluate;

use App\Models\Evaluate;
use App\Services\BaseService;

class GetEvaluateService extends BaseService
{
    public function handle()
    {
        $data = Evaluate::with('food')
            ->where('id_food', $this->data)
            ->get();

        if ($data->isEmpty()) return false;

        return $data;
    }
}
