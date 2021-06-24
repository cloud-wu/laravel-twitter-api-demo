<?php
/**
 * Created by PhpStorm.
 * User: cloudwu
 * Date: 2021/6/23
 * Time: 9:53 PM
 */

namespace App\Foundation\Twitter;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class Client
{
    private $client;

    public function __construct($token, $secret)
    {
        $this->client = $this->getHttpClient($token, $secret);
    }

    public function post(...$args)
    {
        return $this->client->post(...$args);
    }

    public function get(...$args)
    {
        return $this->client->get(...$args);
    }

    private function getHttpClient($token, $secret)
    {
        $stack = HandlerStack::create();
        $middleware = new Oauth1([
            'consumer_key' => config('twitter.consumer_key'),
            'consumer_secret' => config('twitter.consumer_secret'),
            'token' => $token,
            'token_secret' => $secret,
        ]);
        $stack->push($middleware);

        return new HttpClient(
            [
                'handler' => $stack,
                'auth' => 'oauth',
            ]
        );
    }
}