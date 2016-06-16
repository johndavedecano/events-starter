<?php
/**
 * Created by PhpStorm.
 * User: jdecano
 * Date: 6/16/2016
 * Time: 2:05 PM
 */

namespace Jdecano\EventsStarter\Facades;


use Illuminate\Support\Facades\Facade;

class RecurringEvent extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'RecurringEvent';
    }
}