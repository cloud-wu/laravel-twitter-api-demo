<?php
/**
 * Created by PhpStorm.
 * User: cloudwu
 * Date: 2021/6/23
 * Time: 11:56 PM
 */

namespace App\Foundation\Twitter;


class Auth
{
    private $client;
    private $url;

    public function __construct(ClientFactory $clientFactory)
    {
        $this->url = config('twitter.api_url');
        $this->client = $clientFactory->make(
            config('twitter.access_token'),
            config('twitter.access_token_secret')
        );
    }

    public function getRequestToken()
    {
        $response = $this->client->post("{$this->url}/oauth/request_token", [
            'form_params' => [
                'oauth_callback' => (route('twitter.callback')),
            ]
        ]);

        parse_str($response->getBody()->getContents(), $token);
        if (isset($token['oauth_token'], $token['oauth_token_secret'])) {
            return $token;
        }

        throw new \Exception('Failed to fetch token');
    }

    public function getAccessToken($token, $verifier)
    {
        $response = $this->client->post("{$this->url}/oauth/access_token", [
            'query' => [
                'oauth_token' => $token,
                'oauth_verifier' => $verifier,
            ]
        ]);

        parse_str($response->getBody()->getContents(), $token);
        return $token;
    }

    public function getAuthenticateUrl($token) : string
    {
        return "{$this->url}/oauth/authenticate?oauth_token={$token}";
    }
}