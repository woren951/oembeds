<?php

namespace Woren951\OEmbeds\Drivers;

use Woren951\OEmbeds\Interfaces\OEmbedDriver;

class FacebookPost implements OEmbedDriver
{
    /**
     * @return string
     */
    public static function id(): string
    {
        return 'facebook-post';
    }

    /**
     * @return string
     */
    public function endpoint(): string
    {
        return 'https://www.facebook.com/plugins/post/oembed.json/?url=:url';
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return [
            '~facebook\.com\/[\S]+\/(photos|posts).+~i'
        ];
    }
}
