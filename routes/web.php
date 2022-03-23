<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
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
    return view('admin.partials.dashboard');
});

Route::group(['namespace'=>'Admin'], function() {
    // Xử lý login 
    // Route::get('/admin-dashboard');

    // Xử lý khi đã đăng xuất


    // Xử lý khi quên mật khẩu

    // XỬ lý CRUD Category
    Route::group(['prefix'=>'admin/categories'], function(){
        Route::get('/index',[CategoryController::class,'index'])->name('category.index');
        Route::get('/create',[CategoryController::class,'create'])->name('category.create');
        Route::post('/store',[CategoryController::class,'store'])->name('category.store');
        Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
        Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
        Route::post('/update/{id}',[CategoryController::class,'update'])->name('category.update');
    });

    // Xử lý CRUD Product
    Route::group(['prefix'=>'admin/products'], function(){
        Route::get('/index',[ProductController::class,'index'])->name('product.index');
        Route::get('/create',[ProductController::class,'create'])->name('product.create');
        Route::post('/store',[ProductController::class,'store'])->name('product.store');

        Route::get('/delete/{id}',[ProductController::class,'delete'])->name('product.delete');
    });
});