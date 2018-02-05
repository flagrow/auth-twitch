<?php

namespace Flagrow\Twitch\Listeners;

use Flagrow\Twitch\Controllers\TwitchController;
use Flarum\Event\ConfigureForumRoutes;
use Illuminate\Contracts\Events\Dispatcher;

class RegisterAuthRoute
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureForumRoutes::class, [$this, 'add']);
    }

    public function add(ConfigureForumRoutes $event)
    {
        $event->get('/auth/twitch', 'auth.twitch', TwitchController::class);
    }
}
