<?php

use Woren951\OEmbeds\Drivers\{
    FacebookPost,
    FacebookVideo,
    Infogram,
    Instagram,
    Soundcloud,
    Twitter,
    Vimeo,
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
        Infogram::class,
        Instagram::class,
        Soundcloud::class,
        Twitter::class,
        Vimeo::class,
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
