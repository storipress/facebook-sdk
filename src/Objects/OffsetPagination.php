<?php

declare(strict_types=1);

namespace Storipress\Facebook\Objects;

class OffsetPagination extends FacebookObject
{
    // offset

    public ?string $previous = null;

    public ?string $next = null;
}
