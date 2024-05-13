<?php

use App\Exceptions\Handler;
use App\Http\Controllers\Ajax\LocationController;
use App\Http\Controllers\Ajax\DashboardController as AjaxDashboardController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\RolesController;

// FrontEnd
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\CartController;
use Illuminate\Support\Facades\Route;



/* AJAX */

Route::get('ajax/location/getLocation', [LocationController::class, 'getLocation'])->name('ajax.location.index');
Route::post('ajax/dashboard/changeStatus', [AjaxDashboardController::class, 'changeStatus'])->name('ajax.dashboard.changeStatus');
Route::post('ajax/dashboard/deleteProduct/{id}', [AjaxDashboardController::class, 'deleteProduct'])->name('ajax.dashboard.deleteProduct');


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


/* PRODUCTS */
Route::group(['prefix' => 'product'], function () {
    Route::get('index', [ProductController::class, 'index'])->name('product.index')->middleware('admin');
    Route::get('create', [ProductController::class, 'create'])->name('product.create')->middleware('admin');
    Route::post('store', [ProductController::class, 'store'])->name('product.store')->middleware('admin');
    Route::get('detail/{id}', [ProductController::class, 'detail'])->name('product.detail')->middleware('admin');
    Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product.edit')->middleware('admin');
    Route::put('update/{id}', [ProductController::class, 'updateProduct'])->name('product.update')->middleware('admin');
    Route::delete('delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    // Route::put('removePost/{id}', [ProductController::class, 'removePost'])->name('product.removePost')->middleware('admin');
});

/* ATTRIBUTES */
Route::group(['prefix' => 'attribute'], function () {
    Route::get('index', [AttributeController::class, 'index'])->name('attribute.index')->middleware('admin');
    Route::get('create', [AttributeController::class, 'create'])->name('attribute.create')->middleware('admin');
    Route::post('store', [AttributeController::class, 'store'])->name('attribute.store')->middleware('admin');

});

/* CATEGORIES */
Route::group(['prefix' => 'category'], function () {
    Route::get('index', [CategoryController::class, 'index'])->name('category.index')->middleware('admin');
    Route::post('store', [CategoryController::class, 'store'])->name('category.store')->middleware('admin');
    Route::delete('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete')->middleware('admin');
    Route::put('edit/{id}', [CategoryController::class, 'update'])->name('category.update')->middleware('admin');
});

/* ROLES */
Route::group(['prefix' => 'role'], function () {
    Route::get('index', [RolesController::class, 'index'])->name('role.index')->middleware('admin');
    Route::post('store', [RolesController::class, 'store'])->name('role.store')->middleware('admin');
    Route::delete('delete/{id}', [RolesController::class, 'delete'])->name('role.delete')->middleware('admin');
    Route::put('edit/{id}', [RolesController::class, 'update'])->name('role.update')->middleware('admin');
});

/*FRONTEND ROUTES */

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');


/*BACKEND ROUTES */



Route::get('admin', [AuthController::class, 'index'])->name('auth.admin');
Route::post('login', [AuthController::class, 'login'])->name('auth.login')->middleware('login');
Route::post('test', [AuthController::class, 'test'])->name('auth.test');

Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('admin');
Route::post('/clear-notifications', [DashboardController::class, 'clearNotifications'])->name('dashboard.clearNotifications');
