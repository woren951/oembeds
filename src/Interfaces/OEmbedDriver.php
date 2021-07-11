<?php

namespace Woren951\OEmbeds\Interfaces;

interface OEmbedDriver
{
    /**
     * @return string
     */
    public static function id(): string;

    /**
     * @return string
     */
    public function endpoint(): string;

    /**
     * @return array
     */
    public function filters(): array;
}
