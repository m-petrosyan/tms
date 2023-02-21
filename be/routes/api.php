<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
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

Route::post('user', [UserController::class, 'store']);
Route::get('user/{user}', [UserController::class, 'show']);
Route::resource('task', TaskController::class)->only('index', 'show');

Route::middleware(['auth:api', 'verified'])->group(function () {
    Route::get('auth', [UserController::class, 'auth']);
    Route::post('user/img', [UserController::class, 'updateImg']);
    Route::put('user', [UserController::class, 'update']);
    Route::delete('user', [UserController::class, 'destroy']);

    Route::post('task/{user}', [TaskController::class, 'store']);
    Route::middleware(['task-permission'])->group(function () {
        Route::put('task/{task}/{user}', [TaskController::class, 'update']);
        Route::post('task/{task}/img', [TaskController::class, 'updateImg']);
        Route::delete('task/{task}', [TaskController::class, 'destroy']);
    });
});
