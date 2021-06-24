<?php
/**
 * Created by PhpStorm.
 * User: cloudwu
 * Date: 2021/6/23
 * Time: 11:51 PM
 */

namespace App\Foundation\Twitter;


class ClientFactory
{
    public function make($token, $secret)
    {
        return new Client($token, $secret);
    }
}