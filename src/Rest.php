<?php

namespace Jason\Rest;

use Illuminate\Support\Facades\Facade;

/**
 * Class Api
 * @package Jason
 * @method static \Jason\Rest\Factory userId()
 * @method static \Jason\Rest\Factory user()
 */
class Rest extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return 'rest';
    }

}
