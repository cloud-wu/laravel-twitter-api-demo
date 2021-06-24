<?php

namespace App\Http\Controllers;

use App\Services\TwitterService;

class HomeController extends Controller
{
    private $twitterService;

    /**
     * Create a new controller instance.
     *
     * @param TwitterService $twitterService
     */
    public function __construct(TwitterService $twitterService)
    {
        $this->twitterService = $twitterService;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tweets = $this->twitterService->getUserTimeLine();

        return view('home', compact('tweets'));
    }
}


