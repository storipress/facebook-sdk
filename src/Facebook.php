<?php

declare(strict_types=1);

namespace Storipress\Facebook;

use Illuminate\Http\Client\Factory;
use Storipress\Facebook\Requests\Feed;
use Storipress\Facebook\Requests\Me;
use Storipress\Facebook\Requests\Page;
use Storipress\Facebook\Requests\Permission;

class Facebook
{
    protected string $secret = '';

    protected string $userToken = '';

    protected string $pageToken = '';

    protected string $userAgent = 'storipress/facebook-sdk (https://github.com/storipress/facebook-sdk; v1.0.0)';

    protected bool|string $debug = false;

    protected readonly Me $me;

    protected readonly Page $page;

    protected readonly Feed $feed;

    protected readonly Permission $permission;

    /**
     * Create a new facebook instance.
     */
    public function __construct(
        public Factory $http,
    ) {
        $this->me = new Me($this);

        $this->page = new Page($this);

        $this->feed = new Feed($this);

        $this->permission = new Permission($this);
    }

    /**
     * Get the current facebook instance.
     */
    public function instance(): static
    {
        return $this;
    }

    /**
     * Get the app secret for appsecret_proof.
     *
     * @link https://developers.facebook.com/docs/graph-api/guides/secure-requests#appsecret_proof
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * Set the app secret for future requests.
     *
     * @link https://developers.facebook.com/docs/graph-api/guides/secure-requests#appsecret_proof
     */
    public function setSecret(string $secret): static
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * Get the user access token.
     *
     * @link https://developers.facebook.com/docs/facebook-login/guides/access-tokens/#usertokens
     */
    public function getUserToken(): string
    {
        return $this->userToken;
    }

    /**
     * Set the user access token for future requests.
     *
     * @link https://developers.facebook.com/docs/facebook-login/guides/access-tokens/#usertokens
     */
    public function setUserToken(string $userToken): static
    {
        $this->userToken = $userToken;

        return $this;
    }

    /**
     * Get the page access token.
     *
     * @link https://developers.facebook.com/docs/facebook-login/guides/access-tokens/#pagetokens
     */
    public function getPageToken(): string
    {
        return $this->pageToken;
    }

    /**
     * Set the page access token for future requests.
     *
     * @link https://developers.facebook.com/docs/facebook-login/guides/access-tokens/#pagetokens
     */
    public function setPageToken(string $pageToken): static
    {
        $this->pageToken = $pageToken;

        return $this;
    }

    /**
     * Get the user agent.
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * Set user agent for future requests.
     */
    public function setUserAgent(string $userAgent): static
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * Get the debug.
     */
    public function getDebug(): bool|string
    {
        return $this->debug;
    }

    /**
     * Set debug mode for future requests.
     *
     * @param  'all'|'warning'|'info'|false  $debug
     */
    public function setDebug(bool|string $debug): static
    {
        $this->debug = $debug;

        return $this;
    }

    public function me(): Me
    {
        return $this->me;
    }

    public function page(): Page
    {
        return $this->page;
    }

    public function feed(): Feed
    {
        return $this->feed;
    }

    public function permission(): Permission
    {
        return $this->permission;
    }
}
