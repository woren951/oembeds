<?php

namespace Woren951\OEmbeds\Managers;

use InvalidArgumentException;
use Woren951\OEmbeds\Interfaces\OEmbedDriver;

use GuzzleHttp\{
    Client,
    ClientInterface
};

class OEmbeds
{
    /**
     * @var array
     */
    protected $drivers = [];

    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->httpClient = new Client();
    }

    /**
     * @param string $target
     * @return array
     */
    public function extract(string $target): array
    {
        $driver = $this->matchDriver($target);

        return $driver->extract($target);
    }

    /**
     * @param OEmbedDriver $driver
     * @return $this
     */
    public function registerDriver(OEmbedDriver $driver): self
    {
        $this->drivers[$driver->id()] = $driver;

        return $this;
    }

    /**
     * @param ClientInterface $client
     * @return $this
     */
    public function setHttpClient(ClientInterface $client): self
    {
        $this->httpClient = $client;

        return $this;
    }

    /**
     * @return ClientInterface
     */
    public function httpClient(): ClientInterface
    {
        return $this->httpClient;
    }

    /**
     * @param string $target
     * @return OEmbedDriver
     *
     * @throws InvalidArgumentException
     */
    protected function matchDriver(string $target): OEmbedDriver
    {
        foreach ($this->drivers as $key => $driver) {
            foreach ($driver->filters() as $filter) {
                if (preg_match($filter, $target)) {
                    return $driver;
                }
            }
        }

        throw new InvalidArgumentException("Can't define driver for {$target}", 404);
    }
}
