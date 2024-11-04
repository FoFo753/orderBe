<?php

namespace App\Services\Evaluate;

use App\Models\Evaluate;
use App\Services\BaseService;

class UpdateEvaluateService extends BaseService
{
    public function handle()
    {
        $evaluate = Evaluate::find($this->data['id']);

        if (!$evaluate) {
            return false;
        }

        return $evaluate->update([
            'star' => $this->data['star'],
            'detail' => $this->data['detail'],
        ]);
    }
}

