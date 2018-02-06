<?php

namespace Flagrow\Twitch\Provider;

use Flagrow\Twitch\Resource\TwitchUser;
use Illuminate\Support\Arr;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

class Twitch extends AbstractProvider
{

    protected $domain = 'https://api.twitch.tv';

    protected $scopes = ['user_read'];

    /**
     * Returns the base URL for authorizing a client.
     *
     * Eg. https://oauth.service.com/authorize
     *
     * @return string
     */
    public function getBaseAuthorizationUrl()
    {
        return sprintf("%s/kraken/oauth2/authorize", $this->domain);
    }

    /**
     * Returns the base URL for requesting an access token.
     *
     * Eg. https://oauth.service.com/token
     *
     * @param array $params
     * @return string
     */
    public function getBaseAccessTokenUrl(array $params)
    {
        return sprintf("%s/kraken/oauth2/token", $this->domain);
    }

    /**
     * Returns the URL for requesting the resource owner's details.
     *
     * @param AccessToken $token
     * @return string
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return sprintf("%s/kraken/user?oauth_token=%s", $this->domain, $token->getToken());
    }

    /**
     * Returns the default scopes used by this provider.
     *
     * This should only be the scopes that are required to request the details
     * of the resource owner, rather than all the available scopes.
     *
     * @return array
     */
    protected function getDefaultScopes()
    {
        return $this->scopes;
    }

    protected function getScopeSeparator()
    {
        return ' ';
    }

    /**
     * Checks a provider response for errors.
     *
     *
     * @param  ResponseInterface $response
     * @param  array|string $data Parsed response data
     * @throws \Exception
     */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        if ($response->getStatusCode() >= 400) {
            throw new \Exception(Arr::get($data, 'message', $response->getReasonPhrase()));
        }

        if (isset($data['error'])) {
            throw new \Exception(Arr::get($data, 'error', $response->getReasonPhrase()));
        }
    }

    /**
     * Generates a resource owner object from a successful resource owner
     * details request.
     *
     * @param  array $response
     * @param  AccessToken $token
     * @return ResourceOwnerInterface
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return TwitchUser::create($response);
    }

    protected function getAuthorizationHeaders($token = null)
    {
        if ($token) {
            return ['Authorization' => 'OAuth '. $token->getToken()];
        }

        return [];
    }
}
