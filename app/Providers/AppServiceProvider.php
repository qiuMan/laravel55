<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libs\Md5;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //加载MD5类
        $this->app->singleton('hash', function () {
            return new Md5;
        });
    }
}
