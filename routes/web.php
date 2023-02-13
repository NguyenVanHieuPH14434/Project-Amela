<?php

use App\Http\Controllers\Api\ProductController as ApiProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackEnd\AdminController;
use App\Http\Controllers\BackEnd\AttributeController;
use App\Http\Controllers\BackEnd\CategoryController;
use App\Http\Controllers\BackEnd\CategoryNewController;
use App\Http\Controllers\BackEnd\NewsController;
use App\Http\Controllers\BackEnd\OrderCOntroller;
use App\Http\Controllers\BackEnd\OrderStatus;
use App\Http\Controllers\BackEnd\OrderStatusController;
use App\Http\Controllers\BackEnd\PermissionController;
use App\Http\Controllers\BackEnd\ProductController;
use App\Http\Controllers\BackEnd\RoleController;
use App\Http\Controllers\BackEnd\UserController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Controller;
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
    return view('auth.login');
    // return view('welcome');
});

Auth::routes();

Route::middleware(['auth', 'checkRole'])->prefix('/admin')->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // permissions
    Route::prefix('/permissions')->name('permissions.')->group(function(){
        Route::middleware(['can:list-pms'])->get('/', [PermissionController::class, 'index'])->name('index');
        Route::middleware(['can:add-pms'])->get('/create', [PermissionController::class, 'create'])->name('create');
        Route::middleware(['can:add-pms'])->post('/store', [PermissionController::class, 'store'])->name('store');
        Route::middleware(['can:edit-pms'])->get('/edit/{id}', [PermissionController::class, 'edit'])->name('edit');
        Route::middleware(['can:edit-pms'])->put('/update/{id}', [PermissionController::class, 'update'])->name('update');
        Route::middleware(['can:delete-pms'])->delete('/destroy/{id}', [PermissionController::class, 'destroy'])->name('destroy');
        Route::get('/search', [PermissionController::class, 'search'])->name('search');
    });

    // roles
    Route::prefix('/roles')->name('roles.')->group(function(){
        Route::middleware(['can:list-role'])->get('/', [RoleController::class, 'index'])->name('index');
        Route::middleware(['can:add-role'])->get('/create', [RoleController::class, 'create'])->name('create');
        Route::middleware(['can:add-role'])->post('/store', [RoleController::class, 'store'])->name('store');
        Route::middleware(['can:edit-role'])->get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
        Route::middleware(['can:edit-role'])->put('/update/{id}', [RoleController::class, 'update'])->name('update');
        Route::middleware(['can:delete-role'])->delete('/destroy/{id}', [RoleController::class, 'destroy'])->name('destroy');
        Route::get('/search', [RoleController::class, 'search'])->name('search');
    });

    // categories
    Route::prefix('/categories')->name('categories.')->group(function(){
        Route::middleware(['can:list-cate'])->get('/', [CategoryController::class, 'index'])->name('index');
        Route::middleware(['can:add-cate'])->get('/create', [CategoryController::class, 'create'])->name('create');
        Route::middleware(['can:add-cate'])->post('/store', [CategoryController::class, 'store'])->name('store');
        Route::middleware(['can:edit-cate'])->get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::middleware(['can:edit-cate'])->put('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::middleware(['can:delete-cate'])->delete('/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
        Route::get('/search', [CategoryController::class, 'search'])->name('search');
    });

    // attributes
    Route::prefix('/attributes')->name('attributes.')->group(function(){
        Route::middleware(['can:list-attr'])->get('/', [AttributeController::class, 'index'])->name('index');
        Route::middleware(['can:add-attr'])->get('/create', [AttributeController::class, 'create'])->name('create');
        Route::middleware(['can:add-attr'])->post('/store', [AttributeController::class, 'store'])->name('store');
        Route::middleware(['can:edit-attr'])->get('/edit/{id}', [AttributeController::class, 'edit'])->name('edit');
        Route::middleware(['can:edit-attr'])->put('/update/{id}', [AttributeController::class, 'update'])->name('update');
        Route::middleware(['can:delete-attr'])->delete('/destroy/{id}', [AttributeController::class, 'destroy'])->name('destroy');
        Route::get('/search', [AttributeController::class, 'search'])->name('search');
    });

    // users
    Route::prefix('/users')->name('users.')->group(function(){
        Route::middleware(['can:list-user'])->get('/', [UserController::class, 'index'])->name('index');
        Route::middleware(['can:add-user'])->get('/create', [UserController::class, 'create'])->name('create');
        Route::middleware(['can:add-user'])->post('/store', [UserController::class, 'store'])->name('store');
        Route::middleware(['can:edit-user'])->get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::middleware(['can:edit-user'])->put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::middleware(['can:delete-user'])->delete('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/search', [UserController::class, 'search'])->name('search');
    });

    // products
    Route::prefix('/products')->name('products.')->group(function(){
        Route::middleware(['can:list-product'])->get('/', [ProductController::class, 'index'])->name('index');
        Route::middleware(['can:add-product'])->get('/create', [ProductController::class, 'create'])->name('create');
        Route::middleware(['can:add-product'])->post('/store', [ProductController::class, 'store'])->name('store');
        Route::middleware(['can:edit-product'])->get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::middleware(['can:edit-product'])->put('/update/{id}', [ProductController::class, 'update'])->name('update');
        Route::middleware(['can:add-product'])->get('/create-attr/{id}', [ProductController::class, 'createAttr'])->name('createAttr');
        Route::middleware(['can:add-product'])->post('/store-attr/{id}', [ProductController::class, 'storeAttr'])->name('storeAttr');
        Route::middleware(['can:edit-product'])->get('/edit-attr/{id}', [ProductController::class, 'editAttr'])->name('editAttr');
        Route::middleware(['can:edit-product'])->put('/update-attr/{id}', [ProductController::class, 'updateAttr'])->name('updateAttr');
        Route::middleware(['can:delete-product'])->post('/delete-attr/{id}', [ProductController::class, 'deleteAttr'])->name('deleteAttr');
        Route::middleware(['can:delete-product'])->delete('/destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
        Route::get('/search', [ProductController::class, 'search'])->name('search');

    });

    // category new
    Route::prefix('/categoryNews')->name('categoryNews.')->group(function(){
        Route::get('/', [CategoryNewController::class, 'index'])->name('index');
        Route::get('/create', [CategoryNewController::class, 'create'])->name('create');
        Route::post('/store', [CategoryNewController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryNewController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CategoryNewController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [CategoryNewController::class, 'destroy'])->name('destroy');
        Route::get('/search', [CategoryNewController::class, 'search'])->name('search');
    });

    // news
    Route::prefix('/news')->name('news.')->group(function(){
        Route::get('/', [NewsController::class, 'index'])->name('index');
        Route::get('/create', [NewsController::class, 'create'])->name('create');
        Route::post('/store', [NewsController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [NewsController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [NewsController::class, 'destroy'])->name('destroy');
        Route::get('/search', [NewsController::class, 'search'])->name('search');
    });

    // order status
    Route::prefix('/orderStatus')->name('orderStatus.')->group(function(){
        Route::get('/', [OrderStatusController::class, 'index'])->name('index');
        Route::get('/create', [OrderStatusController::class, 'create'])->name('create');
        Route::post('/store', [OrderStatusController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [OrderStatusController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [OrderStatusController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [OrderStatusController::class, 'destroy'])->name('destroy');
        Route::get('/search', [OrderStatusController::class, 'search'])->name('search');
    });

    // order 
    Route::prefix('/orders')->name('orders.')->group(function(){
        Route::get('/', [OrderCOntroller::class, 'index'])->name('index');
        Route::get('/show/{id}', [OrderCOntroller::class, 'show'])->name('show');
        Route::delete('/destroy/{id}', [OrderCOntroller::class, 'destroy'])->name('destroy');
        Route::get('/search', [OrderCOntroller::class, 'search'])->name('search');
    });

    Route::get('/chart', [AdminController::class, 'dataChart'])->name('chart');

});

Route::middleware('auth')->post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('/client')->group(function(){
    Route::get('/home1', [ClientController::class, 'index'])->name('home1');
});

Route::middleware('guest')->prefix('/')->group(function(){
    Route::post('/register', [RegisterController::class, 'create'])->name('register');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/checklogin', [LoginController::class, 'checklogin'])->name('checklogin');
});

Route::any('{url}', function(){
    return view('errors.404');
})->where('url', '.*');


