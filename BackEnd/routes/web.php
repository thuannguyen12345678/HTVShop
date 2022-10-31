<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BannerController;
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
    return view('backend.dashboard.index');
})->name('dashboard');

//Customer
Route::prefix('customers')->group(function () {
    Route::get('customers/trash', [CustomerController::class, 'getTrash'])->name('customer.trash');
    Route::post('customers/trash/restore/{id}', [CustomerController::class, 'restore'])->name('customer.restore');
    Route::delete('customers/trash/force-delete/{id}', [CustomerController::class, 'forceDelete'])->name('customer.forceDelete');
});
Route::resource('customers', CustomerController::class);

//Order
Route::prefix('orders')->group(function () {
    Route::get('orders/trash', [OrderController::class, 'getTrash'])->name('order.trash');
    Route::post('orders/trash/restore/{id}', [OrderController::class, 'restore'])->name('order.restore');
    Route::delete('orders/trash/force-delete/{id}', [OrderController::class, 'forceDelete'])->name('order.forceDelete');
    Route::get('searchOrders', [OrderController::class, 'searchByName'])->name('order.searchKey');
    Route::get('searchOrders', [OrderController::class, 'searchOrder'])->name('order.search');
});
Route::resource('orders', OrderController::class);

//danh mục
Route::prefix('categories')->group(function () {
    Route::get('/trash', [CategoryController::class, 'trashedItems'])->name('categories.trash');
    Route::put('/force_destroy/{id}', [CategoryController::class, 'force_destroy'])->name('categories.force_destroy');
    Route::put('/restore/{id}', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::get('categories/showStatus/{id}', [CategoryController::class, 'showStatus'])->name('categories.showStatus');
    Route::get('categories/hideStatus/{id}', [CategoryController::class,'hideStatus'])->name('categories.hideStatus');
});
Route::resource('categories',CategoryController::class);

//nhân viên
Route::prefix('users')->middleware(['auth', 'PreventBackHistory'])->group(function () {
    Route::put('softDeletes/{id}',[UserController::class,'softDeletes'])->name('users.softDeletes');
    Route::get('trash',[UserController::class,'trash'])->name('users.trash');
    Route::put('restore/{id}',[UserController::class, 'restore'])->name('users.restore');
});
Route::resource('users',UserController::class)->middleware(['auth', 'PreventBackHistory']);

//đăng nhập
Route::prefix('login')->group(function (){
    route::get('/',[UserController::class,'login'])->name('login');
    route::post('loginprocessing',[UserController::class,'loginProcessing'])->name('login.processing');
    route::get('logout',[UserController::class,'logout'])->name('login.logout');
});
//Nhãn hiệu:
Route::prefix('brands')->group(function () {
    Route::get('/trash', [BrandController::class, 'trashedItems'])->name('brands.trash');
    Route::put('/force_destroy/{id}', [BrandController::class, 'force_destroy'])->name('brands.force_destroy');
    Route::put('/restore/{id}', [BrandController::class, 'restore'])->name('brands.restore');
    Route::get('search_brand', [BrandController::class, 'searchByName'])->name('brand.searchKey');
    Route::get('searchBrand', [BrandController::class, 'searchBrand'])->name('brand.search');
});
Route::resource('brands',BrandController::class);
//Sản phẩm:
Route::prefix('products')->group(function () {
    Route::get('/trash', [ProductController::class, 'trashedItems'])->name('products.trash');
    Route::put('/force_destroy/{id}', [ProductController::class, 'force_destroy'])->name('products.force_destroy');
    Route::put('/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
    Route::get('products/showStatus/{id}', [ProductController::class, 'showStatus'])->name('products.showStatus');
    Route::get('products/hideStatus/{id}', [ProductController::class,'hideStatus'])->name('products.hideStatus');
    Route::get('/export-products', [ProductController::class, 'exportProducts'])->name('export-products');
});
Route::resource('products',ProductController::class);
Route::resource('groups',GroupController::class);

//Banner
Route::controller(BannerController::class)->group(function () {
    Route::post('banner/updatestatus/{id}/{status?}', 'updateStatus')->name('banner.updatestatus');
    Route::delete('banner/destroy/{id}', 'destroy')->name('banner.destroy');
    Route::get('banner/showStatus/{id}',  'showStatus')->name('banner.showStatus');
    Route::get('banner/hideStatus/{id}', 'hideStatus')->name('banner.hideStatus');
});
Route::resource('banners', BannerController::class);

