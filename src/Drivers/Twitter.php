<?php

namespace Woren951\OEmbeds\Drivers;

use Woren951\OEmbeds\Interfaces\OEmbedDriver;

class Twitter implements OEmbedDriver
{
    /**
     * @return string
     */
    public static function id(): string
    {
        return 'twitter';
    }

    /**
     * @return string
     */
    public function endpoint(): string
    {
        return 'https://api.twitter.com/1/statuses/oembed.json?url=:url';
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return [
            '~twitter\.com/[a-zA-Z0-9_]+/status(es)?/.+~i'
        ];
    }
}
