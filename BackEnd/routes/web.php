<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
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

Route::prefix('categories')->group(function () {
    Route::get('/trash', [CategoryController::class, 'trashedItems'])->name('categories.trash');
    Route::put('/force_destroy/{id}', [CategoryController::class, 'force_destroy'])->name('categories.force_destroy');
    Route::put('/restore/{id}', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::get('categories/showStatus/{id}', [CategoryController::class, 'showStatus'])->name('categories.showStatus');
    Route::get('categories/hideStatus/{id}', [CategoryController::class,'hideStatus'])->name('categories.hideStatus');
});
Route::resource('categories',CategoryController::class);
Route::prefix('users')->middleware(['auth', 'PreventBackHistory'])->group(function () {
    Route::put('softDeletes/{id}',[UserController::class,'softDeletes'])->name('users.softDeletes');
    Route::get('trash',[UserController::class,'trash'])->name('users.trash');
    Route::put('restore/{id}',[UserController::class, 'restore'])->name('users.restore');
});
Route::resource('users',UserController::class)->middleware(['auth', 'PreventBackHistory']);
Route::prefix('login')->group(function (){
    route::get('/',[UserController::class,'login'])->name('login');
    route::post('loginprocessing',[UserController::class,'loginProcessing'])->name('login.processing');
    route::get('logout',[UserController::class,'logout'])->name('login.logout');
});
