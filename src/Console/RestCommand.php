<?php

namespace Jason\Rest\Console;

use Illuminate\Console\Command;

class RestCommand extends Command
{

    /**
     * artisan 执行的命令
     * @var string
     */
    protected $signature   = 'rest:install';

    protected $description = 'Install the RESTful API package';

    public function handle()
    {
    }

}