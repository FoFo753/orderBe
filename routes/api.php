<?php

use App\Http\Controllers\SaleController;
use App\Http\Controllers\TableController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//get, post, put, delete
Route::group(['prefix' => 'table'], function () {
    Route::get('/', [TableController::class, 'getData']); //=> domain/api/table/
    Route::post('/', [TableController::class, 'create']);
    Route::put('/', [TableController::class, 'update']);
    Route::delete('/{id}', [TableController::class, 'delete']);
});

Route::group(['prefix' => 'sale'], function () {
    Route::get('/', [SaleController::class, 'getData']); 
    Route::post('/', [SaleController::class, 'create']); 
    Route::put('/', [SaleController::class, 'update']); 
    Route::delete('/{id}', [SaleController::class, 'delete']); 
});
