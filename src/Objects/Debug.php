<?php

declare(strict_types=1);

namespace Storipress\Facebook\Objects;

use stdClass;

class Debug extends FacebookObject
{
    /**
     * @var array<int, array{
     *     type: 'warning'|'info',
     *     message: string,
     *     link?: string,
     * }>
     */
    public array $messages = [];

    /**
     * Wrapper for class initialization.
     */
    public static function from(stdClass $data): static
    {
        return new static($data);
    }
}
