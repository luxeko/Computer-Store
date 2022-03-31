<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\HomeController;
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
        Route::get('/search',[CategoryController::class,'search'])->name('category.search');
    });

    // Xử lý CRUD Product
    Route::group(['prefix'=>'admin/products'], function(){
        Route::get('/index',[ProductController::class,'index'])->name('product.index');
        Route::get('/create',[ProductController::class,'create'])->name('product.create');
        Route::post('/store',[ProductController::class,'store'])->name('product.store');
        Route::get('/delete/{id}',[ProductController::class,'delete'])->name('product.delete');
        Route::get('/search',[ProductController::class,'search'])->name('product.search');
        Route::get('/details',[ProductController::class,'show']);
        Route::get('/getCategoryById/{id}',[ProductController::class,'get_category_name']);
        Route::get('/getThumbnailById/{id}',[ProductController::class,'get_thumbnail']);
        Route::get('/getTagsById/{id}',[ProductController::class,'get_tag']);
        Route::get('/getSpecificationById/{id}',[ProductController::class,'get_specification']);
    });

    // Xử lý CRUD Discount
    Route::group(['prefix'=>'admin/discounts'], function(){
        Route::get('/index', [DiscountController::class, 'index'])->name('discount.index');
        Route::get('/create', [DiscountController::class, 'create'])->name('discount.create');
        Route::post('/store', [DiscountController::class, 'store'])->name('discount.store');
    });
});