<?php

declare(strict_types=1);

namespace Storipress\Facebook\Requests;

use Storipress\Facebook\Objects\Me as MeObject;

class Me extends Request
{
    /**
     * @param  array<string, string>  $options
     *
     * @link https://developers.facebook.com/docs/graph-api/overview#me
     */
    public function get(array $options): MeObject
    {
        $data = $this->request(
            'get',
            '/me',
            $options,
        );

        return MeObject::from($data);
    }
}
