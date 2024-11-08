<?php

namespace App\Services\Table;

use App\Models\Table;
use App\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;

class UpdateTableService extends BaseService
{
    public function handle()
    {
        $table = Table::find($this->data['id']);

        if (!$table) return false;

        return $table->update([
            'number' => $this->data['number'],
            'status' => $this->data['status'],
        ]);
    }
}
