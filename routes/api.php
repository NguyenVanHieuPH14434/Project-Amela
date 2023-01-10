<?php

use App\Http\Controllers\Api\AuthController as ApiAuthController;
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

Route::post('/test', [TestController::class, 'test'])->name('test');
Route::post('/test123', [AuthController::class, 'login']);
Route::get('/test1234', [AuthController::class, 'refresh']);
Route::get('/logouts', [AuthController::class, 'logout']);
Route::post('/sendMail', [Controller::class, 'sendMailtest']);
Route::post('/registers', [ApiAuthController::class, 'store']);
Route::get('/listt123', [ApiAuthController::class, 'index']);
Route::get('/listtCate', [ApiAuthController::class, 'cate']);
