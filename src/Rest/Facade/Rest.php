<?php

use Illuminate\Support\Facades\Facade;

class REST extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return 'rest';
    }

}
