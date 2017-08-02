<?php

namespace Laralabs\DataTableJson\Facades;

use Illuminate\Support\Facades\Facade;

class DataTableJsonFacade extends Facade
{
    /**
     * The name of the binding in the IoC container.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'DataTableJsonFacade';
    }
}