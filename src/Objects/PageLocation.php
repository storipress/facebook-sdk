<?php

declare(strict_types=1);

namespace Storipress\Facebook\Objects;

class PageLocation extends FacebookObject
{
    public string $country;

    public string $state;

    public string $zip;

    public string $city;

    public string $street;

    public float $latitude;

    public float $longitude;
}
