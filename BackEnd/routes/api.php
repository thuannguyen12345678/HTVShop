<?php

use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Order
Route::get('orders/create', [OrderController::class, 'create']);
Route::get('orders/list-province', [OrderController::class, 'getAllProvince']);
Route::get('orders/list-district/{id}', [OrderController::class, 'getAllDistrictByProvinceId']);
Route::get('orders/list-ward/{id}', [OrderController::class, 'getAllWardByDistrictId']);
Route::post('orders/store', [OrderController::class, 'store']);
Route::get('orders/show/{id}', [OrderController::class, 'show']);
