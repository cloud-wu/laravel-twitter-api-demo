<?php
/**
 * Created by PhpStorm.
 * User: cloudwu
 * Date: 2021/6/24
 * Time: 12:04 AM
 */

namespace App\Foundation\Twitter;


class Twitter
{
    private $client;
    private $clientFactory;
    private $url;

    public function __construct(ClientFactory $clientFactory)
    {
        $this->clientFactory = $clientFactory;
        $this->url = config('twitter.api_url') . '/' . config('twitter.api_version');
    }

    public function credential($token, $secret)
    {
        $this->client = $this->clientFactory->make($token, $secret);
    }

    public function getUserTimeLine($count = 20) : array
    {
        return json_decode($this->client->get("{$this->url}/statuses/user_timeline.json", [
            'query' => [
                'count' => $count,
            ]
        ])->getBody()->getContents());
    }

    public function postTweet($message) : array
    {
        return json_decode($this->client->post("{$this->url}/statuses/update.json", [
            'form_params' => [
                'status' => urlencode($message),
            ]
        ])->getBody()->getContents(), true);
    }
}