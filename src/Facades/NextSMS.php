<?php

namespace NgarakDev\NextSMS\Facades;

use Illuminate\Support\Facades\Facade;

class NextSMS extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'nextsms';
    }
}
