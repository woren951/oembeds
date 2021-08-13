<?php

namespace Woren951\OEmbeds\Managers;

use Closure;
use InvalidArgumentException;
use Woren951\OEmbeds\Interfaces\OEmbedDriver;

use GuzzleHttp\{
    Exception\ClientException,
    Client
};
use Woren951\OEmbeds\Exceptions\BadRequestException;

class OEmbeds
{
    /**
     * @var array
     */
    protected $drivers = [];

    /**
     * @var Closure|null
     */
    protected $httpResolver;

    /**
     * @var Client
     */
    protected $defaultHttpClient;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->defaultHttpClient = new Client();
    }

    /**
     * @param string $target
     * @return array
     */
    public function extract(string $target): array
    {
        $driver = $this->matchDriver($target);

        $oembed = [];

        if ($this->httpResolver) {
            $oembed = $this->httpResolver($target, $driver);

            return $oembed;
        }

        try {
            $oembed = $this->defaultHttpClient->request(
                'GET',
                $this->endpoint($driver, $target)
            );
        } catch (ClientException $ce) {
            throw (new BadRequestException("Bad request!", 400, $ce))
                ->setResponseCode(
                    $ce->getCode()
                )
                ->setResponseBody(
                    $ce->getResponse()->getBody()->getContents()
                );
        }

        return $oembed;
    }

    /**
     * @param Closure $httpResolver
     * @return self
     */
    public function setHttpResolver(Closure $httpResolver): self
    {
        $this->httpResolver = $httpResolver;

        return $this;
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
     * @param OEmbedDriver $driver
     * @param string $target
     * @return string
     */
    public function endpoint(OEmbedDriver $driver, string $target): string
    {
        $endpoint = $driver->endpoint();

        return str_replace(':url', $target, $endpoint);
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
