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

    /**
     * @param string $target
     * @return array
     */
    public function extract(string $target): array;
}
