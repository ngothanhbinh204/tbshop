<?php

use Illuminate\Support\Facades\Route;
use App\Exceptions\Handler;
use App\Http\Controllers\Ajax\LocationController;
use App\Http\Controllers\Ajax\DashboardController as AjaxDashboardController;

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\OrderController as AdminOrderController;

// FrontEnd
use App\Http\Controllers\Frontend\MailController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\AuthController as AccountController;
use App\Http\Controllers\Frontend\CommentController as CommentClientController;
use App\Http\Controllers\Frontend\BaseClientController;


// use App\Http\Controllers\Auth\ForgotPasswordController;
// use App\Http\Controllers\Auth\ResetPasswordController;

/* AJAX */

Route::get('ajax/location/getLocation', [LocationController::class, 'getLocation'])->name('ajax.location.index');
Route::post('ajax/dashboard/changeStatus', [AjaxDashboardController::class, 'changeStatus'])->name('ajax.dashboard.changeStatus');
Route::post('ajax/dashboard/deleteProduct/{id}', [AjaxDashboardController::class, 'deleteProduct'])->name('ajax.dashboard.deleteProduct');


Route::get('/', function () {
    return  view('welcome');
});
Route::get('send-mail', [MailController::class, 'sendTestMail']);

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

Route::group(['prefix' => 'account'], function () {
    Route::get('ajax/location/getLocation', [LocationController::class, 'getLocation'])->name('ajax.location.index');
    Route::get('/login', [AccountController::class, 'index'])->name('account.login');
    Route::get('/verify-account/{email}', [AccountController::class, 'verify'])->name('account.verify');
    Route::post('/login', [AccountController::class, 'login'])->name('account.check_login');

    Route::post('/register', [AccountController::class, 'register'])->name('account.register');
    Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');

    Route::group(['middleware' => 'user.profile'], function () {
        Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::post('/profile', [AccountController::class, 'profile'])->name('account.profile_update');

        Route::get('/change-password', [AccountController::class, 'change_password'])->name('account.change_password');
        Route::post('/change-password', [AccountController::class, 'check_change_password'])->name('account.check_change_password');
    });



    Route::get('/forgot-password', [AccountController::class, 'index'])->name('account.forgot');
    Route::post('/forgot-password', [AccountController::class, 'index'])->name('account.check_forgot');

    // sau khi nhấn vào forgot -> gửi mail tạoo mk mới
    Route::get('/reset-password', [AccountController::class, 'index'])->name('account.reset');
    Route::post('/reset-password', [AccountController::class, 'index'])->name('account.check_reset');
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
    Route::get('product_attribute/{id}', [ProductController::class, 'productAttributes'])->name('product.productAttributes')->middleware('admin');
    Route::get('detail/{id}', [ProductController::class, 'detail'])->name('product.detail')->middleware('admin');
    Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product.edit')->middleware('admin');
    Route::post('update/{id}', [ProductController::class, 'update'])->name('product.update')->middleware('admin');
    Route::delete('delete', [ProductController::class, 'delete'])->name('product.delete');
    // Route::put('removePost/{id}', [ProductController::class, 'removePost'])->name('product.removePost')->middleware('admin');
});

/* ATTRIBUTES */
Route::group(['prefix' => 'attribute'], function () {
    Route::get('index', [AttributeController::class, 'index'])->name('attribute.index')->middleware('admin');
    Route::get('create', [AttributeController::class, 'create'])->name('attribute.create')->middleware('admin');
    Route::post('store', [AttributeController::class, 'store'])->name('attribute.store')->middleware('admin');
    // Route::post('update', [AttributeController::class, 'update'])->name('attribute.update')->middleware('admin');
});

/* GALLERY */
Route::get('gallery/add/{product_id}', [GalleryController::class, 'addGallery'])->name('admin.gallery.add');

Route::post('gallery/select-gallery', [GalleryController::class, 'selectGallery'])->name('admin.gallery.select');
Route::post('gallery/insert-gallery/{pro_id}', [GalleryController::class, 'insertGallery'])->name('admin.gallery.insert');
Route::post('gallery/update-gallery-image', [GalleryController::class, 'updateGalleryImage'])->name('admin.gallery.update_image');
Route::post('gallery/update-gallery-name', [GalleryController::class, 'updateGalleryName'])->name('admin.gallery.update_name');
Route::post('gallery/delete-gallery', [GalleryController::class, 'deleteGallery'])->name('admin.gallery.delete');


/* CATEGORIES */
Route::group(['prefix' => 'category'], function () {
    Route::get('index', [CategoryController::class, 'index'])->name('category.index')->middleware('admin');
    Route::get('product-in-category/{id}', [CategoryController::class, 'productInCate'])->name('category.product_in_cate')->middleware('admin');
    Route::post('store', [CategoryController::class, 'store'])->name('category.store')->middleware('admin');
    Route::put('edit/{id}', [CategoryController::class, 'update'])->name('category.update')->middleware('admin');
    Route::delete('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete')->middleware('admin');
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
Route::group(['prefix' => 'shop'], function () {
    Route::get('/', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/categories/{slug}/{category_id}', [ShopController::class, 'filterProductByCategories'])->name('client.category.index');
    Route::get('/brands/{brand_id}', [ShopController::class, 'filterProductByBrands'])->name('client.brand.index');
    Route::get('/filter/price/{price_min}-{price_max}', [ShopController::class, 'filterProductByPrice'])->name('client.filter.price');
});



Route::get('/product-detail/{id}', [ShopController::class, 'productDetail'])->name('client.product.detail');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blog-detail/{id}', [BlogController::class, 'blogDetail'])->name('client.blog.detail');


Route::post('/comment-store/{id}', [CommentClientController::class, 'store'])->name('client.comment.store');

// CARTS

Route::get('/cart', [CartController::class, 'index'])->name('client.cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('client.cart.add');
Route::post('/session-update-quantity-product-in-cart', [CartController::class, 'sessionUpdateQuantityProduct'])->name('client.cart.session_update_quantity_product');
Route::post('/session-remove-product-in-cart/{productId}', [CartController::class, 'sessionRemoveProductInCart'])->name('client.cart.session_remove_product');

Route::middleware(['cart'])->group(function () {
    Route::post('/update-quantity-product-in-cart/{cart_product_id}/{id_cart}', [CartController::class, 'updateQuantityProduct'])->name('client.cart.update_quantity_product');
    Route::post('/remove-product-in-cart/{cart_product_id}', [CartController::class, 'removeProductInCart'])->name('client.cart.remove_product');

    // COUPONS
    Route::post('/apply-coupon/{id_cart}', [CartController::class, 'applyCoupon'])->name('client.cart.apply_coupon');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index')->middleware('user.can_checkout_cart', 'check_payment');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('client.checkout.store')->middleware('user.can_checkout_cart');

    // DONE CHECKOUT
    Route::get('/checkout-success', [CheckoutController::class, 'checkoutSuccess'])->name('checkout.success');
});
//  ORDER CLIENT
Route::get('/list-order', [OrderController::class, 'index'])->name('client.orders.index');
Route::post('/order-cancel/{id}', [OrderController::class, 'cancel'])->name('client.orders.cancel');

// ORDER MANNAGER 
Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
Route::post('/update-status/{id}', [AdminOrderController::class, 'updateStatus'])->name('orders.update_status');
Route::get('/orders-detail/{id}', [AdminOrderController::class, 'detail'])->name('orders.details');
Route::post('/remove-order/{id}', [AdminOrderController::class, 'remove'])->name('orders.remove');
Route::post('/update-order/{id}', [AdminOrderController::class, 'updateQuantityOrder'])->name('order.update_quantity_product');


Route::post('/get60DaysOrder', [DashboardController::class, 'get60DaysOrder'])->name('dashboard_get60DaysOrder');

Route::post('/filter-by-date', [DashboardController::class, 'filterByDate'])->name('orders.filter_by_date');
Route::post('/dashboard-filter', [DashboardController::class, 'dashboardFilter'])->name('dashboard_filter');


Route::get('/search', [HomeController::class, 'search']);




Route::get('/contact', [BaseClientController::class, 'contact'])->name('contact.index');
Route::get('/about', [BaseClientController::class, 'about'])->name('about.index');

Route::group(['prefix' => 'ajax'], function () {
    Route::get('/get-infoproduct-by-color-size', [ShopController::class, 'getInfoProByAttribute'])->name('client.getInfoProductByAttribute');
});


// Route::group(['prefix' => 'password'], function () {
//     Route::get('reset', [ForgotPasswordController::class, 'index'])->name('password.request');
//     Route::post('email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
//     Route::get('reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
//     Route::post('reset', [ResetPasswordController::class, 'reset'])->name('password.update');
// });



/*BACKEND ROUTES ADMIN */

Route::get('admin', [AuthController::class, 'index'])->name('auth.admin');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::post('test', [AuthController::class, 'test'])->name('auth.test');

Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('admin');
Route::post('/clear-notifications', [DashboardController::class, 'clearNotifications'])->name('dashboard.clearNotifications');


Route::group(['prefix' => 'laravel-filemanager', 'middleware'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
