<?php

namespace Woren951\OEmbeds\Drivers;

use GuzzleHttp\Exception\ClientException;
use JsonException;
use Woren951\OEmbeds\Support\AbstractDriver;

use Woren951\OEmbeds\Exceptions\{
    BadRequestException,
    UnauthorizedException
};

class Twitter extends AbstractDriver
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
        return 'https://publish.twitter.com/oembed';
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

    /**
     * @param string $target
     * @return array
     *
     * @throws UnauthorizedException|BadRequestException|JsonException
     */
    public function extract(string $target): array
    {
        try {
            $response = $this->manager->httpClient()
                ->request('GET', $this->endpoint(), [
                    'query' => [
                        'format' => 'json',
                        'url' => $target,
                    ],
                ]);
        } catch (ClientException $e) {
            if ($e->getCode() === 403) {
                throw UnauthorizedException::make($e);
            }

            throw BadRequestException::make($e);
        }

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }
}
