<?php

declare(strict_types=1);

namespace Tests;

use Storipress\Facebook\Exceptions\FacebookException;
use Storipress\Facebook\Objects\FacebookObject;
use Storipress\Facebook\Requests\Request;

test('There are no debugging statements remaining in our code.')
    ->expect(['dd', 'dump', 'ray', 'var_dump', 'echo'])
    ->not
    ->toBeUsed();

test('Strict typing must be enforced in the code.')
    ->expect('Storipress\Facebook')
    ->toUseStrictTypes();

test('The code should not utilize the "final" keyword.')
    ->expect('Storipress\Facebook')
    ->not()
    ->toBeFinal();

test('All Request classes should extend "Request".')
    ->expect('Storipress\Facebook\Requests')
    ->classes()
    ->toExtend(Request::class);

test('All Object classes should extend "FacebookObject".')
    ->expect('Storipress\Facebook\Objects')
    ->classes()
    ->toExtend(FacebookObject::class);

test('All Exception classes should extend "Exception".')
    ->expect('Storipress\Facebook\Exceptions')
    ->classes()
    ->toExtend(FacebookException::class);
