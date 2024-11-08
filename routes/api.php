<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FoodController;
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
    Route::get('/', [TableController::class, 'getData']);
    Route::post('/', [TableController::class, 'create']);
    Route::put('/', [TableController::class, 'update']);
    Route::delete('/{id}', [TableController::class, 'delete']);
});

Route::group(['prefix' => 'food'], function () {
    Route::get('/', [FoodController::class, 'getData']);
    Route::post('/', [FoodController::class, 'create']);
    Route::put('/', [FoodController::class, 'update']);
    Route::delete('/{id}', [FoodController::class, 'delete']);
});

Route::group(['prefix' => 'category'], function () {
    Route::get('/', [CategoryController::class, 'getData']);
    Route::post('/', [CategoryController::class, 'create']);
    Route::put('/', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'delete']);
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

Route::group(['prefix' => 'customer'], function () {
    Route::get('/', [CustomerController::class, 'getData']);
    Route::post('/', [CustomerController::class, 'create']);
    Route::put('/', [CustomerController::class, 'update']);
    Route::delete('/{id}', [CustomerController::class, 'delete']);
});

Route::group(['prefix' => 'evaluate'], function () {
    Route::get('/', [EvaluateController::class, 'getData']);
    Route::post('/', [EvaluateController::class, 'create']);
    Route::put('/', [EvaluateController::class, 'update']);
    Route::delete('/{id}', [EvaluateController::class, 'delete']);
});

Route::group(['prefix' => 'cart'], function () {
    Route::get('/{id_table}', [CartController::class, 'getData']);
    Route::post('/', [CartController::class, 'create']);
    Route::put('/', [CartController::class, 'update']);
    Route::delete('/{id}', [CartController::class, 'delete']);
    Route::delete('/table/{id_table}', [CartController::class, 'deleteAllFoodFromTable']);
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'getData']);
    Route::post('/', [UserController::class, 'create']);
    Route::put('/', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'delete']);
});
