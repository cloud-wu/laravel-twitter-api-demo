<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TweetController;

Route::get('/twitter/callback', [LoginController::class, 'twitterCallback'])
    ->name('twitter.callback');

Route::post('tweet', [TweetController::class, 'store'])
    ->name('tweet.store');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
