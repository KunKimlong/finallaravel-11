<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\LogoController;

Route::get('/getlogo',[LogoController::class,'viewLogo']);
Route::get('/openaddlogo',[LogoController::class,'openAdd']);
Route::post('/addlogo',[LogoController::class,'addLogo']);
Route::get('/openupdatelogo/{id}',[LogoController::class,'openUpdate']);
Route::post('/updateLogo',[LogoController::class,'updateLogo']);
Route::post('/deleteLogo',[LogoController::class,'deleteLogo']);