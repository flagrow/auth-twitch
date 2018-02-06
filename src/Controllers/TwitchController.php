<?php

namespace Flagrow\Twitch\Controllers;

use Flagrow\Twitch\Provider\Twitch;
use Flagrow\Twitch\Resource\TwitchUser;
use Flarum\Forum\AuthenticationResponseFactory;
use Flarum\Forum\Controller\AbstractOAuth2Controller;
use Flarum\Settings\SettingsRepositoryInterface;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class TwitchController extends AbstractOAuth2Controller
{
    /**
     * @var SettingsRepositoryInterface
     */
    private $settings;

    public function __construct(AuthenticationResponseFactory $authResponse, SettingsRepositoryInterface $settings)
    {
        $this->authResponse = $authResponse;
        $this->settings = $settings;
    }

    /**
     * @param string $redirectUri
     * @return \League\OAuth2\Client\Provider\AbstractProvider
     */
    protected function getProvider($redirectUri)
    {
        return new Twitch([
            'clientId' => $this->settings->get('flagrow-twitch.client_id'),
            'clientSecret' => $this->settings->get('flagrow-twitch.client_secret'),
            'redirectUri' => $redirectUri
        ]);
    }

    /**
     * @return array
     */
    protected function getAuthorizationUrlOptions()
    {
        return ['scope' => ['user:read:email', 'user_read']];
    }

    /**
     * @param ResourceOwnerInterface $resourceOwner
     * @return array
     */
    protected function getIdentification(ResourceOwnerInterface $resourceOwner)
    {
        return [
            'email' => $resourceOwner->getEmail()
        ];
    }

    /**
     * @param ResourceOwnerInterface|TwitchUser $resourceOwner
     * @return array
     */
    protected function getSuggestions(ResourceOwnerInterface $resourceOwner)
    {
        return [
            'avatarUrl' => $resourceOwner->logo
        ];
    }
}
