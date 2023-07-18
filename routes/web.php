<?php

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\CartController;
//use App\Http\Controllers\Admin\Users\MainController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MenuController as ControllersMenuController;
use App\Http\Controllers\ProductController as ControllersProductController;
use Illuminate\Support\Facades\Route;

Route::get('/Admin/users/login',[LoginController::class,'index'])->name('login');
Route::post('/admin/users/login/store',[LoginController::class,'store']);


Route::middleware(['auth'])->group(function () {
   
    Route::prefix('admin')->group(function () {
        Route::get('main',[MainController::class,'index'])->name('admin.main');


        //Menus
        Route::prefix('menus')->group(function() {
            Route::get('/add',[MenuController::class,'create'])->name('admin.menu.add');
            Route::post('/add',[MenuController::class,'store']);
            Route::get('/list',[MenuController::class,'index'])->name('admin.menu.list');
            Route::delete('/destroy',[MenuController::class,'destroy']);
            Route::get('/edit/{menu}',[MenuController::class,'show']);
            Route::post('/edit/{menu}',[MenuController::class,'update']);
        });
        Route::prefix('products')->group(function() {
            Route::get('list',[ProductController::class,'index'])->name('admin.product.list');
            Route::get('add',[ProductController::class,'add']);
            Route::post('add',[ProductController::class,'store']);
            Route::get('/edit/{product}',[ProductController::class,'show']);
            Route::post('edit/{product}',[ProductController::class,'update']);
            Route::delete('/destroy',[ProductController::class,'destroy']);
        });
        //Slider
        Route::prefix('slider')->group(function() {
            Route::get('list',[SliderController::class,'index'])->name('admin.slide.list');
            Route::get('add',[SliderController::class,'add']);
            Route::post('add',[SliderController::class,'store']);
            Route::get('/edit/{slider}',[SliderController::class,'show']);
            Route::post('edit/{slider}',[SliderController::class,'update']);
            Route::delete('/destroy',[SliderController::class,'destroy']);
        });
        Route::prefix('orders')->group(function() {
           Route::get('list',[OrderController::class,'list']);
           Route::get('view/{id}',[OrderController::class,'view']);
        });
        //upload
        Route::post('upload/service',[UploadController::class,'upload']);
    
    });
    });

  Route::get('/',[MainController::class,'index']);
  Route::post('/loadProduct',[MainController::class,'loadProduct']);
  Route::get('/danh-muc/{id}-{slug}',[ControllersMenuController::class,'index']);
  Route::get('/san-pham/{id}/{slug}',[ControllersProductController::class,'index']);
  Route::get('/service/product/Preview',[MainController::class,'productPreview']);

  //Cart
  Route::post('add-cart',[CartController::class,'index']);
  Route::get('/cart',[CartController::class,'show']);
  Route::post('/update-cart',[cartController::class,'update']);
   
  Route::get('/carts/delete/{id}',[CartController::class,'delete']);
  Route::post('/cart',[CartController::class,'add']);

