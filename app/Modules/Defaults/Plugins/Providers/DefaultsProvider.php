<?php

namespace Asterisk\Modules\Defaults\Plugins\Providers;

use Asterisk\Modules\Defaults\Plugins\DefaultsGeo;
use Asterisk\Modules\Defaults\Plugins\DefaultsOccupation;
use Illuminate\Support\ServiceProvider;


class DefaultsProvider extends ServiceProvider
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
        $this->app->bind('geo', function(){
            return new DefaultsGeo();
        });
        $this->app->alias('geo', 'DefaultsGeo');

        $this->app->bind('occupation', function(){
            return new DefaultsOccupation();
        });
        $this->app->alias('occupation', 'DefaultsOccupation');
    }
}
