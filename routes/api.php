<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

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
Route::post('register',[UserController::class,'register'])->name('register');
Route::post('login',[UserController::class,'login'])->name('register');

Route::middleware('auth:api')->group(function () {
    Route::get('user',[UserController::class,'index'])->name('user');
    Route::get('logout',[UserController::class,'logout'])->name('logout');
});
