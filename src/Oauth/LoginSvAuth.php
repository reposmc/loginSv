<?php

namespace Leolopez\Loginsv\Oauth;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class LoginSvAuth extends AbstractProvider implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(config('loginsv.authorize_url'), $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return config('loginsv.token_url');
    }

    /**
     * {@inheritdoc}
     */
    protected function getAccessToken($code)
    {
        $response = $this->getHttpClient()->post($this->getTokenUrl(), [
            'headers' => [
                'Authorization' => env('LOGIN_SV_CLIENT_ID'). ' ' . env('LOGIN_SV_CLIENT_SECRET'),
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'form_params' => $this->getTokenFields($code),
        ]);

        return $this->parseAccessToken($response->getBody());
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return array(
            'code'=>$code,
            'grant_type'=>'authorization_code',
            'client_id'=> env('LOGIN_SV_CLIENT_ID'),
            'client_secret'=> env('LOGIN_SV_CLIENT_SECRET'),
            'redirect_uri'=> env('LOGIN_SV_REDIRECT')
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->post(config('loginsv.user_url'), [
            'query' => [
                'prettyPrint' => 'false',
            ],
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        $user = (new User)->setRaw($user)->map([
            'name'     => $user['name'],
            'email'     => $user['email'],
            'dui'     => $user['dui'],
        ]);

        return $user;
    }
}
