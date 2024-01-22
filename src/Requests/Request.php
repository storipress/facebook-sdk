<?php

declare(strict_types=1);

namespace Storipress\Facebook\Requests;

use Illuminate\Http\Client\Response;
use stdClass;
use Storipress\Facebook\Exceptions\ExpiredAccessToken;
use Storipress\Facebook\Exceptions\MissingAccessToken;
use Storipress\Facebook\Exceptions\UnexpectedResponseData;
use Storipress\Facebook\Exceptions\UnknownError;
use Storipress\Facebook\Facebook;

abstract class Request
{
    const ENDPOINT = 'https://graph.facebook.com';

    const VERSION = 'v18.0';

    /**
     * Create a new request instance.
     */
    public function __construct(
        protected readonly Facebook $app,
    ) {
        //
    }

    /**
     * @param  'get'|'post'|'delete'  $method
     * @param  non-empty-string  $path
     * @param  array<string, string>  $options
     *
     * @throws UnexpectedResponseData
     */
    protected function request(
        string $method,
        string $path,
        array $options = [],
        bool $usePageToken = false,
    ): stdClass {
        $app = $this->app;

        $query = [
            'debug' => $app->getDebug(),
        ];

        if ($usePageToken) {
            $query['access_token'] = $app->getPageToken();
        } else {
            $query['access_token'] = $app->getUserToken();
        }

        if (! empty($app->getSecret())) {
            $query['appsecret_proof'] = hash_hmac(
                'sha256',
                $query['access_token'],
                $app->getSecret(),
            );
        }

        $response = $app->http
            ->acceptJson()
            ->asJson()
            ->withUserAgent($app->getUserAgent())
            ->withQueryParameters(array_filter($query))
            ->{$method}($this->url($path), $options);

        if (! ($response instanceof Response)) {
            throw new UnexpectedResponseData();
        }

        if (! $response->successful()) {
            $this->error($response);
        }

        $data = $response->object();

        if (! ($data instanceof stdClass)) {
            throw new UnexpectedResponseData();
        }

        return $data;
    }

    /**
     * Build up the request API URL.
     */
    protected function url(string $path): string
    {
        return sprintf(
            '%s/%s/%s',
            rtrim(self::ENDPOINT, '/'),
            self::VERSION,
            ltrim($path, '/'),
        );
    }

    /**
     * Convert response error to exception.
     */
    public function error(Response $response): void
    {
        throw match ($response->json('error.code')) {
            190 => new ExpiredAccessToken(),

            2500 => new MissingAccessToken(),

            default => new UnknownError(),
        };
    }
}
