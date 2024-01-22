<?php

declare(strict_types=1);

namespace Storipress\Facebook\Objects;

use stdClass;

abstract class FacebookObject
{
    /**
     * @var array<string, mixed>
     */
    private array $__map = [];

    public Debug $__debug__;

    /**
     * Create a new object instance.
     */
    final public function __construct(
        public readonly stdClass $raw,
    ) {
        foreach (get_object_vars($this->raw) as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Wrapper for class initialization.
     */
    public static function from(stdClass $data): static
    {
        $data->__debug__ = Debug::from(
            $data->__debug__ ?? new stdClass(),
        );

        return new static($data);
    }

    /**
     * Writing data to inaccessible (protected or private) or non-existing properties.
     */
    public function __set(string $key, mixed $value): void
    {
        $this->__map[$key] = $value;
    }

    /**
     * Reading data from inaccessible (protected or private) or non-existing properties.
     */
    public function __get(string $key): mixed
    {
        return $this->__map[$key] ?? null;
    }
}
