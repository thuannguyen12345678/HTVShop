<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
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

//danh mục:
Route::prefix('categories')->group(function () {
    Route::get('/trash', [CategoryController::class, 'trashedItems'])->name('categories.trash');
    Route::put('/force_destroy/{id}', [CategoryController::class, 'force_destroy'])->name('categories.force_destroy');
    Route::put('/restore/{id}', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::get('categories/showStatus/{id}', [CategoryController::class, 'showStatus'])->name('categories.showStatus');
    Route::get('categories/hideStatus/{id}', [CategoryController::class,'hideStatus'])->name('categories.hideStatus');
});
Route::resource('categories',CategoryController::class);

//Nhãn hiệu:

Route::prefix('brands')->group(function () {
    Route::get('/trash', [BrandController::class, 'trashedItems'])->name('brands.trash');
    Route::put('/force_destroy/{id}', [BrandController::class, 'force_destroy'])->name('brands.force_destroy');
    Route::put('/restore/{id}', [BrandController::class, 'restore'])->name('brands.restore');
    Route::get('search_brand', [BrandController::class, 'searchByName'])->name('brand.searchKey');
    Route::get('searchBrand', [BrandController::class, 'searchBrand'])->name('brand.search');
});
Route::resource('brands',BrandController::class);