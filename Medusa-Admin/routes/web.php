<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminPermissionController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;

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

Route::get('/',[AdminLoginController::class,'viewLoginAdmin']);
Route::get('/admin-login',[AdminLoginController::class,'viewLoginAdmin'])->name('login');
Route::post('/admin-login',[AdminLoginController::class,'checkLoginAdmin']);

// Route::get('/', function () {
//     return view('admin/home');
// })->name('/');

Route::group(['prefix'=>'admin','middleware'=>['auth']],function(){
    Route::get('logout',[AdminLoginController::class,'logoutAdmin'])->name('logout');
    Route::get('/', function () {
        return view('admin.home');
    });
    Route::group(['prefix'=>'category'],function(){
        Route::get('/', [CategoryController::class,'listCategory'])->middleware('can:list-category');
        Route::get('/add-category', [CategoryController::class,'addCategory'])->middleware('can:add-category');
        Route::post('/save-category', [CategoryController::class,'saveCategory'])->middleware('can:add-category');
        Route::get('/edit-category/{id}', [CategoryController::class,'editCategory'])->middleware('can:edit-category');
        Route::post('/update-category/{id}', [CategoryController::class,'updateCategory'])->middleware('can:edit-category');
        Route::get('/delete-category/{id}', [CategoryController::class,'deleteCategory'])->middleware('can:delete-category');
    });
    Route::group(['prefix'=>'brand'],function(){
        Route::get('/', [BrandController::class,'listBrand'])->middleware('can:list-category');
        Route::post('/save-brand', [BrandController::class,'saveBrand'])->middleware('can:add-category');
        Route::get('/edit-brand/{id}', [BrandController::class,'editBrand'])->middleware('can:edit-category');
        Route::get('/update-brand/{id}', [BrandController::class,'updateBrand'])->middleware('can:edit-category');
        Route::get('/delete-brand/{id}', [BrandController::class,'deleteBrand'])->middleware('can:delete-category');
    });
    Route::group(['prefix'=>'menu'],function(){
        Route::get('/', [MenuController::class,'listMenu'])->middleware('can:list-menu');
        Route::get('/add-menu', [MenuController::class,'addMenu'])->middleware('can:add-menu');
        Route::post('/save-menu', [MenuController::class,'saveMenu'])->middleware('can:add-menu');
        Route::get('/edit-menu/{id}', [MenuController::class,'editMenu'])->middleware('can:edit-menu');
        Route::post('/update-menu/{id}', [MenuController::class,'updateMenu'])->middleware('can:edit-menu');
        Route::get('/delete-menu/{id}', [MenuController::class,'deleteMenu'])->middleware('can:delete-menu');
    });
    Route::group(['prefix'=>'product'],function(){
        Route::get('/', [ProductController::class,'listProduct'])->middleware('can:list-product');
        Route::get('/add-product', [ProductController::class,'addProduct'])->middleware('can:add-product');
        Route::post('/save-product', [ProductController::class,'saveProduct'])->middleware('can:add-product');
        Route::get('/edit-product/{id}', [ProductController::class,'editProduct'])->middleware('can:edit-product,id');
        Route::post('/update-product/{id}', [ProductController::class,'updateProduct'])->middleware('can:edit-product,id');
        Route::get('/delete-product/{id}', [ProductController::class,'deleteProduct'])->middleware('can:delete-product,id');
        // setting=====================================
        Route::get('/product-color', [ProductController::class,'listProductColor']);
        Route::post('/save-product-color', [ProductController::class,'saveProductColor']);
        Route::get('/delete-product-color/{id}', [ProductController::class,'deleteProductColor']);
        // Size
        Route::get('/product-size', [ProductController::class,'listProductSize']);
        Route::post('/save-product-size', [ProductController::class,'saveProductSize']);
        Route::get('/delete-product-size/{id}', [ProductController::class,'deleteProductSize']);

    });
    Route::group(['prefix'=>'order'],function(){
        Route::get('/', [OrderController::class,'listOrder']);
        Route::get('/view-order/{id}', [OrderController::class,'viewOrder']);
        Route::post('/update-status/{id}', [OrderController::class,'updateOrderStatus']);

    });
    Route::group(['prefix'=>'slider'],function(){
        Route::get('/', [SliderController::class,'listSlider'])->middleware('can:list-slider');
        Route::get('/add-slider', [SliderController::class,'addSlider'])->middleware('can:add-slider');
        Route::post('/save-slider', [SliderController::class,'saveSlider'])->middleware('can:add-slider');
        Route::get('/edit-slider/{id}', [SliderController::class,'editSlider'])->middleware('can:edit-slider');
        Route::post('/update-slider/{id}', [SliderController::class,'updateSlider'])->middleware('can:edit-slider');
        Route::get('/delete-slider/{id}', [SliderController::class,'deleteSlider'])->middleware('can:delete-slider');
    });
    Route::group(['prefix'=>'user'],function(){
        Route::get('/', [AdminUserController::class,'listUser'])->middleware('can:list-user');
        Route::get('/add-user', [AdminUserController::class,'addUser'])->middleware('can:add-user');
        Route::post('/save-user', [AdminUserController::class,'saveUser'])->middleware('can:add-user');
        Route::get('/edit-user/{id}', [AdminUserController::class,'editUser'])->middleware('can:edit-user');
        Route::post('/update-user/{id}', [AdminUserController::class,'updateUser'])->middleware('can:edit-user');
        Route::get('/delete-user/{id}', [AdminUserController::class,'deleteUser'])->middleware('can:delete-user');
    });

    Route::group(['prefix'=>'role'],function(){
        Route::get('/', [AdminRoleController::class,'listRole'])->middleware('can:list-role');
        Route::get('/add-role', [AdminRoleController::class,'addRole'])->middleware('can:add-role');
        Route::post('/save-role', [AdminRoleController::class,'saveRole'])->middleware('can:add-role');
        Route::get('/edit-role/{id}', [AdminRoleController::class,'editRole'])->middleware('can:edit-role');
        Route::post('/update-role/{id}', [AdminRoleController::class,'updateRole'])->middleware('can:edit-role');
        Route::get('/delete-role/{id}', [AdminRoleController::class,'deleteRole'])->middleware('can:delete-role');
    });
    Route::group(['prefix'=>'permission'],function(){
        // Route::get('/', [AdminPermissionController::class,'listPermission']);
        Route::get('/add-permission', [AdminPermissionController::class,'addPermission']);
        Route::post('/save-permission', [AdminPermissionController::class,'savePermission']);
        // Route::get('/edit-role/{id}', [AdminRoleController::class,'editRole']);
        // Route::post('/update-role/{id}', [AdminRoleController::class,'updateRole']);
        // Route::get('/delete-role/{id}', [AdminRoleController::class,'deleteRole']);
    });
});

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
