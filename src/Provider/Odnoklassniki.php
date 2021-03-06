<?php

declare(strict_types=1);

namespace League\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

class Odnoklassniki extends AbstractProvider
{
    use BearerAuthorizationTrait;

    private $apiServer = 'https://api.ok.ru/';

    /**
     * @var string
     */
    protected $clientPublic;

    /**
     * @inheritDoc
     */
    public function getBaseAuthorizationUrl()
    {
        return 'https://connect.ok.ru/oauth/authorize';
    }

    /**
     * @inheritDoc
     */
    public function getBaseAccessTokenUrl(array $params)
    {
        return $this->apiServer.'oauth/token.do';
    }

    /**
     * @inheritDoc
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        $params = [
            'application_key' => $this->clientPublic,
            'format' => 'json',
            'method' => 'users.getCurrentUser',
        ];
        $sign = md5(http_build_query($params, '','').md5($token.$this->clientSecret));
        return $this->apiServer.'fb.do?'.http_build_query($params).'&access_token='.$token.'&sig='.$sign;
    }

    /**
     * @inheritDoc
     */
    protected function getDefaultScopes()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (isset($data['error_code']) || isset($data['error'])) {
            throw new IdentityProviderException(
                json_encode($data),
                $response->getStatusCode(),
                $data
            );
        }
    }

    /**
     * @inheritDoc
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new OdnoklassnikiUser($response);
    }
}