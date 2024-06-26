<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Composers\CartComposer;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
class AppServiceProvider extends ServiceProvider
{

    public $bindings = [
        // SERVICES
        'App\Services\Interfaces\UserServiceInterface' => 'App\Services\UserService',
        'App\Services\Interfaces\ProductServiceInterface' => 'App\Services\ProductService',

        // REPOSITORIES
        'App\Repositories\Interfaces\UserRepositoryInterface' => 'App\Repositories\UserRepository',
        'App\Repositories\Interfaces\ProductRepositoryInterface' => 'App\Repositories\ProductRepository',
        'App\Repositories\Interfaces\ProductAttributeRepositoryInterface' => 'App\Repositories\ProductAttributeRepository',
        'App\Repositories\Interfaces\ProvinceRepositoryInterface' => 'App\Repositories\ProvinceRepository',
        'App\Repositories\Interfaces\DistrictRepositoryInterface' => 'App\Repositories\DistrictRepository',
        'App\Repositories\Interfaces\WardRepositoryInterface' => 'App\Repositories\WardRepository',


    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        foreach ($this->bindings as $key => $value) {
            $this->app->bind($key, $value);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Lấy mảng thông báo từ session flash (nếu có) và chia sẻ với tất cả các view
        $notifications = session('notifications', []);
        view()->share('notifications', $notifications);

        View::composer("frontend.client.partials.header", CartComposer::class);
        View::composer("frontend.client.cart", CartComposer::class);

        Carbon::setLocale('vi');
        Schema::defaultStringLength(191);
    }
}
