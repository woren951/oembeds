<?php

namespace Woren951\OEmbeds\Drivers;

use GuzzleHttp\Exception\ClientException;
use JsonException;
use Woren951\OEmbeds\Support\AbstractDriver;

use Woren951\OEmbeds\Exceptions\{
    BadRequestException,
    UnauthorizedException
};


class Instagram extends AbstractDriver
{
    /**
     * @return string
     */
    public static function id(): string
    {
        return 'instagram';
    }

    /**
     * @return string
     */
    public function endpoint(): string
    {
        return 'https://graph.facebook.com/v11.0/instagram_oembed';
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return [
            '~instagr(\.am|am\.com)\/p\/.+~i'
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
                        'access_token' => $this->config['access_token']
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
        preg_match('/p\/(.+)\//', $target, $matches);

        return $matches[1];
    }
}
