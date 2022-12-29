<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BackEnd\AdminController;
use App\Http\Controllers\BackEnd\AttributeController;
use App\Http\Controllers\BackEnd\CategoryController;
use App\Http\Controllers\BackEnd\PermissionController;
use App\Http\Controllers\BackEnd\RoleController;
use App\Http\Controllers\BackEnd\UserController;
use App\Http\Controllers\Client\ClientController;
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
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->prefix('/admin')->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // permissions
    Route::prefix('/permissions')->name('permissions.')->group(function(){
        Route::get('/', [PermissionController::class, 'index'])->name('index');
        Route::get('/create', [PermissionController::class, 'create'])->name('create');
        Route::post('/store', [PermissionController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PermissionController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [PermissionController::class, 'destroy'])->name('destroy');
    });

    // roles
    Route::prefix('/roles')->name('roles.')->group(function(){
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/store', [RoleController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [RoleController::class, 'destroy'])->name('destroy');
    });

    // categories
    Route::prefix('/categories')->name('categories.')->group(function(){
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    // attributes
    Route::prefix('/attributes')->name('attributes.')->group(function(){
        Route::get('/', [AttributeController::class, 'index'])->name('index');
        Route::get('/create', [AttributeController::class, 'create'])->name('create');
        Route::post('/store', [AttributeController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AttributeController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [AttributeController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [AttributeController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware('auth')->post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('/client')->group(function(){
    Route::get('/home1', [ClientController::class, 'index'])->name('home1');
});

Route::middleware('guest')->prefix('/')->group(function(){
    Route::post('/register', [RegisterController::class, 'create'])->name('register');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/checklogin', [LoginController::class, 'checklogin'])->name('checklogin');
    // Route::get('/cates', [CategoryController::class, 'cate']);
});


