<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Repositories\UserRepository;
use App\Services\TwitterService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    private $twitterService;
    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @param TwitterService $twitterService
     * @param UserRepository $userRepository
     */
    public function __construct(TwitterService $twitterService, UserRepository $userRepository)
    {
        $this->middleware('guest')->except('logout');
        $this->twitterService = $twitterService;
        $this->userRepository = $userRepository;
    }

    public function login()
    {
        try {
            return $this->twitterService->login();
        } catch (\Exception $e) {
            return Redirect::route('login');
        }
    }

    public function twitterCallback(Request $request)
    {
        try {
            $this->twitterService->processCallback($request->oauth_token, $request->oauth_verifier);
        } catch (\Exception $e) {
            return Redirect::route('login');
        }

        return Redirect::route('home');
    }
}
