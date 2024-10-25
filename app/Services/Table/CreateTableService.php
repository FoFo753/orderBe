<?php

namespace App\Services\Table;

use App\Models\Table;
use App\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;

class CreateTableService extends BaseService
{

    public function handle()
    {
        $table = Table::where('number', $this->data['number'])->exists();

        if ($table) {
            return response()->json([
                'message' => 'Số bàn đã tồn tại',
            ], Response::HTTP_BAD_REQUEST);
        }

        $table = Table::create($this->data);

        return response()->json([
            'table' => $table,
        ], Response::HTTP_CREATED);
    }
}
