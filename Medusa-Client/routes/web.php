<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\LoginController;
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
Route::group(['prefix'=>'checkout','middleware'=>['auth']],function(){
    Route::get('/',[CartController::class,'viewCheckOut']);

});



