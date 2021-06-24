<?php

namespace App\Services;

use App\Exceptions\TwitterAuthException;
use App\Foundation\Twitter\Twitter;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Foundation\Twitter\Auth as TwitterAuth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class TwitterService
{
    private const KEY_OAUTH_STATE = 'oauth_state';
    private const OAUTH_STATE = 'start oauth';

    private $auth;
    private $twitter;
    private $userRepository;

    public function __construct(
        TwitterAuth $twitterAuth,
        Twitter $twitter,
        UserRepository $userRepository
    ) {
        $this->auth = $twitterAuth;
        $this->twitter = $twitter;
        $this->userRepository = $userRepository;
    }

    public function login()
    {
        $token = $this->auth->getRequestToken();
        if (! isset($token['oauth_token_secret'])) {
            throw new TwitterAuthException("Did not get request token");
        }

        Session::put(self::KEY_OAUTH_STATE, self::OAUTH_STATE);

        return Redirect::to($this->auth->getAuthenticateUrl($token['oauth_token']));
    }

    public function processCallback($token, $verifier)
    {
        if (Session::get(self::KEY_OAUTH_STATE) !== self::OAUTH_STATE) {
            throw new TwitterAuthException("Verify oauth state failed.");
        }

        $token = $this->auth->getAccessToken($token, $verifier);

        $user = $this->userRepository->firstOrCreate(['uid' => $token['user_id']]);
        $user->update(['name' => $token['screen_name']]);
        $user->tokens()->create([
            'token' => $token['oauth_token'],
            'secret' => $token['oauth_token_secret']
        ]);

        $user->token = $token['oauth_token'];
        $user->secret = $token['oauth_token_secret'];

        Auth::login($user);
    }

    public function getAccessToken($token, $verifier)
    {
        return $this->auth->getAccessToken($token, $verifier);
    }

    public function getUserTimeLine(int $count = 20)
    {
        $this->twitter->credential(
            Auth::user()->token->token,
            Auth::user()->token->secret
        );
        return $this->twitter->getUserTimeLine($count);
    }

    public function postTweet(string $message)
    {
        $this->twitter->credential(
            Auth::user()->token->token,
            Auth::user()->token->secret
        );
        $response = $this->twitter->postTweet($message);

        Auth::user()->tweets()->create([
            'twitter_id' => $response['id'],
            'text' => $response['text'],
        ]);
    }
}