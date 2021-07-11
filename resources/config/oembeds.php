<?php

use Woren951\OEmbeds\Drivers\{
    FacebookPost,
    FacebookVideo,
    Instagram,
    Twitter,
    Youtube
};

return [

    /*
    |--------------------------------------------------------------------------
    | OEmbed drivers Configuration
    |--------------------------------------------------------------------------
    */

    'drivers' => [
        FacebookPost::class => [
            'config' => [
                'access_token' => env('FACEBOOK_ACCESS_TOKEN')
            ],
        ],

        FacebookVideo::class => [
            'config' => [
                'access_token' => env('FACEBOOK_ACCESS_TOKEN')
            ],
        ],

        Instagram::class => [
            'config' => [
                'access_token' => env('FACEBOOK_ACCESS_TOKEN')
            ],
        ],

        Twitter::class => [],

        Youtube::class => [],
    ],

];
