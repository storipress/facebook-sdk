<?php

declare(strict_types=1);

namespace Storipress\Facebook\Objects;

class Feed extends FacebookObject
{
    public string $id;

    public ?string $message = null;

    public ?string $created_time = null;
}
