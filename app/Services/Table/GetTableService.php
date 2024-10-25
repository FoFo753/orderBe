<?php

namespace App\Services\Table;

use App\Enums\Table\TableStatus;
use App\Models\Table;
use App\Services\BaseService;

class GetTableService extends BaseService
{
    public function handle()
    {
        return Table::orderBy('status')->get();
    }
}
