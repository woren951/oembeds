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
    | OEmbed enabled drivers
    |--------------------------------------------------------------------------
    */

    'drivers' => [
        FacebookPost::class,
        FacebookVideo::class,
        Instagram::class,
        Twitter::class,
        Youtube::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | OEmbed drivers configuration
    |--------------------------------------------------------------------------
    */

    'configs' => [
        FacebookPost::class => [
            'access_token' => env('FACEBOOK_ACCESS_TOKEN')
        ],
        FacebookVideo::class => [
            'access_token' => env('FACEBOOK_ACCESS_TOKEN')
        ],
        Instagram::class => [
            'access_token' => env('FACEBOOK_ACCESS_TOKEN')
        ],
    ],

];
