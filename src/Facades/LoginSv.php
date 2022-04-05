<?php

namespace Leolopez\Backup\Facades;

use \Illuminate\Support\Facades\Facade;

class LoginSv extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'loginsv';
    }
}
