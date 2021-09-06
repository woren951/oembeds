<?php

namespace Woren951\OEmbeds\Drivers;

use GuzzleHttp\Exception\ClientException;
use JsonException;
use Woren951\OEmbeds\Support\AbstractDriver;

use Woren951\OEmbeds\Exceptions\{
    BadRequestException,
    UnauthorizedException
};

class Soundcloud extends AbstractDriver
{
    /**
     * @return string
     */
    public static function id(): string
    {
        return 'soundcloud';
    }

    /**
     * @return string
     */
    public function endpoint(): string
    {
        return 'https://soundcloud.com/oembed';
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return [
            '~soundcloud\.com\/[a-zA-Z0-9-_]+\/[a-zA-Z0-9-_]+~i'
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

        return array_merge(
            json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR),
            [
                'id' => $this->resolveId($target)
            ]
        );
    }

    /**
     * @param string $target
     * @return string
     */
    protected function resolveId(string $target): string
    {
        preg_match('/soundcloud\.com\/([a-zA-Z0-9-_]+\/[a-zA-Z0-9-_]+)/', $target, $matches);

        return $matches[1];
    }
}
