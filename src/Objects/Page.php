<?php

declare(strict_types=1);

namespace Storipress\Facebook\Objects;

class Page extends FacebookObject
{
    public string $id;

    public string $name;

    public string $category;

    public string $access_token;
}
