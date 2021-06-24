<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Token;
use App\Entities\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Token::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'token' => Str::random(10),
        'secret' => Str::random(10),
    ];
});
