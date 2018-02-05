<?php

namespace Flagrow\Twitch\Controllers;

use Depotwarehouse\OAuth2\Client\Twitch\Provider\Twitch;
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
        return new Twitch(
            $this->settings->get('flagrow-twitch.client_id'),
            $this->settings->get('flagrow-twitch.client_secret'),
            $redirectUri
        );
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
     * @param ResourceOwnerInterface $resourceOwner
     * @return array
     */
    protected function getSuggestions(ResourceOwnerInterface $resourceOwner)
    {
        return [];
    }
}
