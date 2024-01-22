<?php

declare(strict_types=1);

namespace Storipress\Facebook\Objects;

use stdClass;

class SearchPage extends FacebookObject
{
    public string $id;

    public string $name;

    public ?string $link = null;

    public ?PageLocation $location = null;

    public ?bool $is_eligible_for_branded_content = null;

    public ?bool $is_unclaimed = null;

    public static function from(stdClass $data): static
    {
        if (property_exists($data, 'location')) {
            if ($data->location instanceof stdClass) {
                $data->location = PageLocation::from($data->location);
            }
        }

        return parent::from($data);
    }
}
