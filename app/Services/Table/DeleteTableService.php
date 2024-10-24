<?php

namespace App\Services\Table;

use App\Models\Table;
use App\Services\BaseService;

class DeleteTableService extends BaseService
{

    public function handle()
    {
        $table = Table::find($this->data);

        if (!$table) return false;

        return $table->delete();
    }
}
