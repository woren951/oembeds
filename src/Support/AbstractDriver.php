<?php

namespace Woren951\OEmbeds\Support;

use Woren951\OEmbeds\Interfaces\OEmbedDriver;
use Woren951\OEmbeds\Managers\OEmbeds;

abstract class AbstractDriver implements OEmbedDriver
{
    /**
     * @var OEmbeds
     */
    protected $manager;

    /**
     * @var array
     */
    protected $config = [];

    /**
     * @param OEmbeds $manager
     * @param array $config
     */
    public function __construct(OEmbeds $manager, array $config)
    {
        $this->manager = $manager;
        $this->config = $config;
    }
}
