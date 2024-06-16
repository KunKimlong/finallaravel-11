<?php

use App\Http\Controllers\Backend\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\LogoController;




Route::controller(LogoController::class)->group(function(){
    Route::get('/getlogo','viewLogo');
    Route::get('/openaddlogo','openAdd');
    Route::post('/addlogo','addLogo');
    Route::get('/openupdatelogo/{id}','openUpdate');
    Route::post('/updateLogo','updateLogo');
    Route::post('/deleteLogo','deleteLogo');
});

Route::controller(CategoryController::class)->group(function(){
    Route::get('/getcategory','viewCategory');
    Route::get('/openaddcategory','openAdd');
    Route::post('/addcategory','addCategory');
    Route::get('/openupdatecategory/{id}','openUpdate');
    Route::post('/updatecategory','updateCategory');
    Route::post('/deletecategory','deleteCategory');
});