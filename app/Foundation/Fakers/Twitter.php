<?php
/**
 * Created by PhpStorm.
 * User: cloudwu
 * Date: 2021/6/24
 * Time: 9:07 AM
 */

namespace App\Foundation\Fakers;


use Faker\Provider\Base;

class Twitter extends Base
{
    public function twitterPostTweetResponse(array $params = [])
    {
        return array_merge(json_decode('{"created_at":"Thu Jun 24 01:09:56 +0000 2021","id":111111,"id_str":"111111","text":"test","truncated":false,"entities":{"hashtags":[],"symbols":[],"user_mentions":[],"urls":[]},"source":"\u003ca href=\"https:\/\/laravel-twitter-api-demo.test.parenting.com.tw\/\" rel=\"nofollow\"\u003eCloud-Demo\u003c\/a\u003e","in_reply_to_status_id":null,"in_reply_to_status_id_str":null,"in_reply_to_user_id":null,"in_reply_to_user_id_str":null,"in_reply_to_screen_name":null,"user":{"id":12345,"id_str":"12345","name":"Cloud Wu","screen_name":"Tester","location":"","description":"","url":null,"entities":{"description":{"urls":[]}},"protected":false,"followers_count":0,"friends_count":38,"listed_count":0,"created_at":"Tue Oct 29 14:29:58 +0000 2019","favourites_count":0,"utc_offset":null,"time_zone":null,"geo_enabled":false,"verified":false,"statuses_count":13,"lang":null,"contributors_enabled":false,"is_translator":false,"is_translation_enabled":false,"profile_background_color":"F5F8FA","profile_background_image_url":null,"profile_background_image_url_https":null,"profile_background_tile":false,"profile_image_url":"http:\/\/pbs.twimg.com\/profile_images\/123456\/So0PF8Vz_normal.jpg","profile_image_url_https":"https:\/\/pbs.twimg.com\/profile_images\/123456\/So0PF8Vz_normal.jpg","profile_link_color":"1DA1F2","profile_sidebar_border_color":"C0DEED","profile_sidebar_fill_color":"DDEEF6","profile_text_color":"333333","profile_use_background_image":true,"has_extended_profile":false,"default_profile":true,"default_profile_image":false,"following":false,"follow_request_sent":false,"notifications":false,"translator_type":"none","withheld_in_countries":[]},"geo":null,"coordinates":null,"place":null,"contributors":null,"is_quote_status":false,"retweet_count":0,"favorite_count":0,"favorited":false,"retweeted":false,"lang":"und"}', true), $params);
    }
}