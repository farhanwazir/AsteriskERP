<?php

namespace Asterisk\Modules\MenuManager\Plugins\Providers;

use Asterisk\Modules\MenuManager\Plugins\AppMenus;
use Illuminate\Support\ServiceProvider;


class MenuManagerProvider extends ServiceProvider
{


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('menu', function(){
            return new AppMenus();
        });
        $this->app->alias('menu', 'AppMenus');
    }
}
