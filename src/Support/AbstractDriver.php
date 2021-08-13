<?php

namespace Woren951\OEmbeds\Support;

use Woren951\OEmbeds\Interfaces\OEmbedDriver;

abstract class AbstractDriver implements OEmbedDriver
{
    /**
     * @var array
     */
    protected $config = [];

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }
}
