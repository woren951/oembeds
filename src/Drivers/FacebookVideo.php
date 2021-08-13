<?php

namespace Woren951\OEmbeds\Drivers;

use Woren951\OEmbeds\Support\AbstractDriver;

class FacebookVideo extends AbstractDriver
{
    /**
     * @return string
     */
    public static function id(): string
    {
        return 'facebook-video';
    }

    /**
     * @return string
     */
    public function endpoint(): string
    {
        return 'https://www.facebook.com/plugins/video/oembed.json/?url=:url';
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return [
            '~facebook\.com/.+/videos/.*~i'
        ];
    }
}
