<?php

namespace Flagrow\Twitch\Resource;

use Illuminate\Support\Arr;
use Illuminate\Support\Fluent;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;

/**
 * @property $id
 * @property $display_name
 * @property $type
 * @property $bio
 * @property $email
 * @property $partnered
 * @property $name
 * @property $logo
 */
class TwitchUser extends Fluent implements ResourceOwnerInterface
{
    public static function create(array $attributes)
    {
        $attributes['id'] = Arr::pull($attributes, '_id');

        return new TwitchUser($attributes);
    }

    /**
     * Returns the identifier of the authorized resource owner.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}
