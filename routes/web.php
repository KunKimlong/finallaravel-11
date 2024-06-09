<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\CategoriesController;
use App\Http\Controllers\backend\ProductController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Home
Route::get('/',                [HomeController::class, 'Home']);
Route::get('/shop',            [HomeController::class, 'Shop']);
Route::get('/product/{slug}',  [HomeController::class, 'Product']);
Route::get('/news',            [HomeController::class, 'News']);
Route::get('/article/{slug}',  [HomeController::class, 'Article']);
Route::get('/search',          [HomeController::class, 'Search']);

// User SignIn & SignUp
Route::get('/signin',          [UserController::class, 'Signin'])->name('login');
Route::post('/signin-submit',  [UserController::class, 'SigninSubmit']);

Route::get('/signup',         [UserController::class, 'Signup']);
Route::post('/signup-submit', [UserController::class, 'SignupSubmit']);


// @Middleware Auth
Route::middleware(['auth'])->group(function () {
    Route::get('/admin',             [AdminController::class, 'index']);
    Route::get('/admin/add-post',    [AdminController::class, 'AddPost']);
    Route::get('/admin/list-post',   [AdminController::class, 'ListPost']);
    Route::get('/admin/signout',           [UserController::class, 'SignOut']);

    //List Log Activity
    Route::get('/admin/log-activity',      [AdminController::class, 'ListLogActivity']);

    //Website Logo 
    Route::get('/admin/list-logo',            [AdminController::class, 'ListLogo']);
    Route::get('/admin/add-logo',             [AdminController::class, 'AddLogo']);
    Route::post('/admin/add-logo-submit',     [AdminController::class, 'AddLogoSubmit']);
    Route::get('/admin/update-logo/{id}',     [AdminController::class, 'UpdateLogo']);
    Route::post('/admin/update-logo-submit',  [AdminController::class, 'UpdateLogoSubmit']);
    Route::post('/admin/delete-logo-submit',  [AdminController::class, 'DeleteLogoSubmit']);

    //Product
    Route::get('/admin/list-product',            [ProductController::class, 'ListProduct']);
    Route::get('/admin/add-product',             [ProductController::class, 'AddProduct']);
    Route::post('/admin/add-product-submit',     [ProductController::class, 'AddProductSubmit']);
    Route::get('/admin/update-product/{id}',     [ProductController::class, 'UpdateProduct']);
    Route::post('/admin/update-product-submit',  [ProductController::class, 'UpdateProductSubmit']);

    //News blog
    Route::get('/admin/add-news',            [AdminController::class, 'AddNews']);
    Route::post('/admin/add-news-submit',    [AdminController::class, 'AddNewsSubmit']);

});
