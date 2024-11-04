<?php

namespace App\Services\Evaluate;

use App\Models\Evaluate;
use App\Services\BaseService;

class DeleteEvaluateService extends BaseService
{
    public function handle()
    {
        $evaluate = Evaluate::find($this->data);

        if (!$evaluate) return false;

        return $evaluate->delete();
    }
}
