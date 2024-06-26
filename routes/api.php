<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Api\OrderController;

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

// Route::middleware('auth:sanctum')->group(function () {
    Route::get('/usersAPI', [UserController::class, 'userAPI'])->name('user.index')->middleware('admin');
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::get('/orders', [OrderController::class, 'index']);

    Route::post('/orders', [OrderController::class, 'store']);
    Route::post('/get60DaysOrder', [DashboardController::class, 'get60DaysOrderAPI']);

// });
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group([

//     'middleware' => 'api',
//     'prefix' => 'auth'

// ], function ($router) {
//     Route::post('login', [AuthController::class, 'login2']);
//     Route::get('profile', [AuthController::class, 'profile']);
//     Route::post('logout', [AuthController::class, 'logout2']);
//     Route::post('refresh', [AuthController::class, 'refresh']);
//     // Route::post('refresh', 'AuthController@refresh');

// });
