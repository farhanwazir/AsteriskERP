<?php namespace Asterisk\Modules\MenuManager\Plugins;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Illuminate\Html\HtmlBuilder
 */
class MenuFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'menu'; }

}