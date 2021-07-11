<?php

namespace Woren951\OEmbeds\Drivers;

use Woren951\OEmbeds\Interfaces\OEmbedDriver;

class Instagram implements OEmbedDriver
{
    /**
     * @return string
     */
    public static function id(): string
    {
        return 'instagram';
    }

    /**
     * @return string
     */
    public function endpoint(): string
    {
        return 'http://api.instagram.com/oembed?format=json&url=:url';
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return [
            '~instagr(\.am|am\.com)/p/.+~i'
        ];
    }
}
