<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\LogoController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;


Route::controller(UserController::class)->group(function(){
    Route::get('/login','openLogin')->name('login');
    Route::post('/login', 'login');
    Route::get('/register','openregister');
    Route::post('/register','register');
});

Route::get('/',[HomeController::class,'index']);
Route::get("/product/{id}",[HomeController::class,"productDetail"]);

Route::middleware('auth')->group(function(){

    Route::prefix('/dashboard')->group(function(){
        Route::get('/',function(){
            return view('backend.home');
        })->name('home');
        Route::post('/logout',[UserController::class,'logout']);

        Route::controller(LogoController::class)->group(function(){
            Route::get('/getlogo','viewLogo')->name('getLogo');
            Route::get('/openaddlogo','openAdd')->name('openaddLogo');
            Route::post('/addlogo','addLogo')->name('addLogo');
            Route::get('/openupdatelogo/{id}','openUpdate')->name('openUpdateLogo');
            Route::post('/updateLogo','updateLogo')->name('updateLogo');
            Route::post('/deleteLogo','deleteLogo')->name('deleteLogo');
        });

        Route::controller(CategoryController::class)->group(function(){
            Route::get('/getcategory','viewCategory')->name('viewCate');
            Route::get('/openaddcategory','openAdd')->name('openAddCate');
            Route::post('/addcategory','addCategory')->name('addCate');
            Route::get('/openupdatecategory/{id}','openUpdate')->name('openUpdateCate');
            Route::post('/updatecategory','updateCategory')->name('updateCate');
            Route::post('/deletecategory','deleteCategory')->name('deleteCAte');
        });


        Route::controller(ProductController::class)->group(function(){
            Route::get('/getproduct','viewProduct')->name('viewPro');
            Route::get('/addProduct','openAddProduct')->name('openAddPro');
            Route::post('/addProduct','addProduct')->name('addPro');
            Route::get('/openUpdateProduct/{id}','openUpdateProduct')->name('openUpdatePro');
            Route::post('/updateProduct','updateProduct')->name('updatePro');
            Route::post('/deleteProduct','deleteProduct')->name('deletePro');
        });
    });
});




