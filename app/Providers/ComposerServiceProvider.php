<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Composers\CartComposer;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function register()
    {
    }
    public function boot()
    {
        View::composer('client.partials.header', CartComposer::class);
    }
}
