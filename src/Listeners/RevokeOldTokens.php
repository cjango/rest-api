<?php

namespace Jason\Rest\Listeners;

class RevokeOldTokens
{

    public function handle($event)
    {

        dump($event);

    }

    public function handleCreated($event)
    {
        dump($event);
    }

    public function subscribe($events)
    {
        $events->listen(
            'Laravel\Passport\Events\AccessTokenCreated',
            [RevokeOldTokens::class, 'handleCreated']
        );
    }

}