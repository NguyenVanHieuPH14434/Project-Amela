<?php

use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\NewCategoryController;
use App\Http\Controllers\Api\NewController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RepliesController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [UserController::class, 'store']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/profile', [AuthController::class, 'profile']);
Route::middleware('auth:api')->post('/edit-profile/{id}', [UserController::class, 'update']);
Route::get('/list-categories', [CategoryController::class, 'index']);
Route::get('/list-product', [ProductController::class, 'index']);
Route::get('/product-detail/{id}', [ProductController::class, 'show']);
Route::get('/list-new-category', [NewCategoryController::class, 'index']);
Route::get('/list-new', [NewController::class, 'index']);
Route::get('/list-new/{id}', [NewController::class, 'show']);
Route::post('/order', [OrderController::class, 'store']);
Route::get('/list-order', [OrderController::class, 'index']);
Route::get('/list-order/{id}', [OrderController::class, 'show']);
Route::post('/comment', [CommentController::class, 'store']);
Route::post('/replies', [RepliesController::class, 'store']);
Route::get('/testCount', [CategoryController::class, 'testCount']);

Route::any('{url}', function(){
    return response()->json([
        "success"=>false,
        "message"=>"Not found!"
    ], 404);
})->where('url', '.*');
