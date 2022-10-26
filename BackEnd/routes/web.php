<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('backend.master');
});

//Customer
Route::resource('customer', CustomerController::class);
Route::get('customers/trash', [CustomerController::class, 'getTrash'])->name('customer.trash');
Route::post('customers/trash/restore/{id}', [CustomerController::class, 'restore'])->name('customer.restore');
Route::delete('customers/trash/force-delete/{id}', [CustomerController::class, 'forceDelete'])->name('customer.forceDelete');
//Order
Route::resource('order', OrderController::class);
Route::get('orders/trash', [OrderController::class, 'getTrash'])->name('order.trash');
Route::post('orders/trash/restore/{id}', [OrderController::class, 'restore'])->name('order.restore');
Route::delete('orders/trash/force-delete/{id}', [OrderController::class, 'forceDelete'])->name('order.forceDelete');
Route::get('searchOrders', [OrderController::class, 'searchByName'])->name('order.searchKey');
Route::get('searchOrders', [OrderController::class, 'searchOrder'])->name('order.search');

