<?php

declare(strict_types=1);

namespace Storipress\Facebook\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Storipress\Facebook\Facebook instance()
 */
class Facebook extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'facebook';
    }
}
