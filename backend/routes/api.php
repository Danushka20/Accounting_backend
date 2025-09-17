<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\FiscalYearController;
use App\Http\Controllers\SalesAreaController;
use App\Http\Controllers\SalesGroupController;
use App\Http\Controllers\SalesTypeController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::resource("user-managements", UserManagementController::class);
Route::resource("currencies", CurrencyController::class);
Route::resource("fiscal-years", FiscalYearController::class);

Route::resource("sales-groups", SalesGroupController::class);
Route::resource("sales-areas", SalesAreaController::class);
Route::resource("sales-types", SalesTypeController::class);