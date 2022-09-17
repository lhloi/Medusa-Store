<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class,'home']);
Route::get('/login', [LoginController::class,'login'])->name('login');
Route::post('/check-Login', [LoginController::class,'checkLoginClient']);
Route::post('/logout', [LoginController::class,'logout'])->name('logout');

Route::get('/danh-sach-san-pham',[CategoryController::class,'index']);
Route::get('/danh-muc/{slug}',[CategoryController::class,'getProductByCategory']);
Route::get('/thong-tin-san-pham/{slug}',[ProductController::class,'viewProductDetail']);
Route::group(['prefix'=>'cart','middleware'=>['auth']],function(){
    Route::post('/save-cart',[CartController::class,'saveCart']);
    Route::get('/show-cart',[CartController::class,'showCart']);
    Route::get('/delete-cart/{id}',[CartController::class,'deleteCart']);
    Route::get('/dec-quantity/{id}',[CartController::class,'decQuantityCart']);
    Route::get('/inc-quantity/{id}',[CartController::class,'incQuantityCart']);
});
Route::get('/checkout',[CartController::class,'viewCheckOut'])->middleware('auth');

Route::group(['prefix'=>'order','middleware'=>['auth']],function(){
    Route::post('/place',[CartController::class,'orderPlace']);


});

Route::group(['prefix'=>'user','middleware'=>['auth']],function(){
    Route::get('profile',[UserController::class,'Profile']);
    Route::post('save-profile',[UserController::class,'saveProfile']);
    Route::get('address',[UserController::class,'Address']);
    Route::post('save-address',[UserController::class,'saveAddress']);
    Route::get('default-address/{id}',[UserController::class,'defaultAddress']);
    Route::get('delete-address/{id}',[UserController::class,'deleteAddress']);
    Route::get('/purchase',[UserController::class,'viewOrder']);
    Route::get('/purchase-destroy/{id}',[UserController::class,'destroyOrder']);
});


