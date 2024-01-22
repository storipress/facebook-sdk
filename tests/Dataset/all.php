<?php

declare(strict_types=1);

return [
    'graph.facebook.com/*/me/ok' => [
        'id' => '7010624026006887',
        'name' => 'Lilyan Cormier III',
    ],
    'graph.facebook.com/*/me/expired' => [
        'error' => [
            'message' => 'Error validating access token: The session has been invalidated because the user changed their password or Facebook has changed the session for security reasons.',
            'type' => 'OAuthException',
            'code' => 190,
            'error_subcode' => 460,
            'fbtrace_id' => 'A_LrzommvgmnCY9ilAkqDv6',
        ],
    ],
    'graph.facebook.com/*/me/invalid' => [
        'error' => [
            'message' => 'The access token could not be decrypted',
            'type' => 'OAuthException',
            'code' => 190,
            'fbtrace_id' => 'A9Gypd41HDkelmUtKp4uhf9',
        ],
    ],
    'graph.facebook.com/*/me/missing' => [
        'error' => [
            'message' => 'An active access token must be used to query information about the current user.',
            'type' => 'OAuthException',
            'code' => 2500,
            'fbtrace_id' => 'AiWcLwzJ6vQnqnO9n599KYp',
        ],
    ],
    'graph.facebook.com/*/me/debug' => [
        'id' => '7010624026006887',
        'name' => 'Lilyan Cormier III',
        '__debug__' => [
            'messages' => [
                [
                    'link' => 'https://developers.facebook.com/docs/apps/versions/',
                    'message' => 'No API version was specified. This request defaulted to version v12.0.',
                    'type' => 'warning',
                ],
            ],
        ],
    ],
    'graph.facebook.com/*/me/debug/empty' => [
        'id' => '7010624026006887',
        'name' => 'Lilyan Cormier III',
        '__debug__' => [],
    ],
];
