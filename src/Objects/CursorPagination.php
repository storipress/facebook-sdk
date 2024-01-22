<?php

declare(strict_types=1);

namespace Storipress\Facebook\Objects;

use stdClass;

class CursorPagination extends FacebookObject
{
    /**
     * @var stdClass{
     *     before: string,
     *     after: string,
     * }|null
     */
    public ?stdClass $cursors = null;

    public ?string $previous = null;

    public ?string $next = null;
}
