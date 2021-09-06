<?php

namespace Woren951\OEmbeds\Drivers;

use GuzzleHttp\Exception\ClientException;
use JsonException;
use Woren951\OEmbeds\Support\AbstractDriver;

use Woren951\OEmbeds\Exceptions\{
    BadRequestException,
    UnauthorizedException
};

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
        return 'https://www.youtube.com/oembed';
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
            if ($e->getCode() === 401) {
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
        preg_match('/v=(.+)$|&/', $target, $matches);

        return $matches[1];
    }
}
