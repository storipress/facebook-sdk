<?php

declare(strict_types=1);

namespace Storipress\Facebook\Objects;

class Permission extends FacebookObject
{
    public string $permission;

    /**
     * @var 'granted'|'declined'|'expired'
     */
    public string $status;
}
