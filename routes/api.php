<?php

use App\Http\Controllers\bookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\foodsController;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\RankController;
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

Route::group(['prefix' => 'rank'], function () {
    Route::get('/', [RankController::class, 'getData']);
    Route::post('/', [RankController::class, 'create']);
    Route::put('/', [RankController::class, 'update']);
    Route::delete('/{id}', [RankController::class, 'delete']);
});

Route::group(['prefix' => 'category'], function () {
    Route::get('/', [CategoryController::class, 'getData']);
    Route::post('/', [CategoryController::class, 'create']);
    Route::put('/', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'delete']);
});
