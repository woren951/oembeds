<?php

namespace Woren951\OEmbeds\Drivers;

use Woren951\OEmbeds\Support\AbstractDriver;

class Youtube extends AbstractDriver
{
    /**
     * @return string
     */
    public static function id(): string
    {
        return 'youtube';
    }

    /**
     * @return string
     */
    public function endpoint(): string
    {
        return 'https://www.youtube.com/oembed?format=json&url=:url';
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return [
            '~youtube\.com|youtu\.be~i'
        ];
    }
}
