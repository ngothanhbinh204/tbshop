<?php

use App\Exceptions\Handler;
use App\Http\Controllers\Ajax\LocationController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\PostController;
use Illuminate\Support\Facades\Route;



/* AJAX */

Route::get('ajax/location/getLocation', [LocationController::class, 'getLocation'])->name('ajax.location.index');


Route::get('/', function () {
    return  view('welcome');
});

/*USERS */
Route::group(['prefix' => 'user'], function () {
    Route::get('index', [UserController::class, 'index'])->name('user.index')->middleware('admin');
    Route::get('create', [UserController::class, 'create'])->name('user.create')->middleware('admin');
    Route::post('store', [UserController::class, 'store'])->name('user.store')->middleware('admin');
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit')->middleware('admin');
    Route::put('update/{id}', [UserController::class, 'updateUser'])->name('user.update')->middleware('admin');
    Route::post('updateAvatar/{id}', [UserController::class, 'updateAvatar'])->name('user.updateAvatar')->middleware('admin');
    Route::delete('delete/{id}', [UserController::class, 'deleteUser'])->name('user.delete')->middleware('admin');
});

/* POSTS */
Route::group(['prefix' => 'post'], function () {
    Route::get('index', [PostController::class, 'index'])->name('post.index')->middleware('admin');
    Route::get('create', [PostController::class, 'create'])->name('post.create')->middleware('admin');
    Route::post('store', [PostController::class, 'store'])->name('post.store')->middleware('admin');
    Route::get('detail/{id}', [PostController::class, 'detail'])->name('post.detail')->middleware('admin');
    Route::get('edit/{id}', [PostController::class, 'edit'])->name('post.edit')->middleware('admin');
    Route::get('update/{id}', [PostController::class, 'updatePost'])->name('post.update')->middleware('admin');
    Route::put('uploadPost/{id}', [PostController::class, 'uploadPost'])->name('post.uploadPost')->middleware('admin');
    Route::put('removePost/{id}', [PostController::class, 'removePost'])->name('post.removePost')->middleware('admin');
});








/*BACKEND ROUTES */



Route::get('admin', [AuthController::class, 'index'])->name('auth.admin');
Route::post('login', [AuthController::class, 'login'])->name('auth.login')->middleware('login');
Route::post('test', [AuthController::class, 'test'])->name('auth.test');

Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('admin');
Route::post('/clear-notifications', [DashboardController::class, 'clearNotifications'])->name('dashboard.clearNotifications');
