<?php

declare(strict_types=1);

namespace Storipress\Facebook\Requests\Traits;

use Generator;
use ReflectionException;
use ReflectionMethod;
use RuntimeException;
use Storipress\Facebook\Objects\CursorPagination;
use Storipress\Facebook\Objects\OffsetPagination;
use Storipress\Facebook\Objects\TimePagination;

/**
 * @template T
 */
trait HasAll
{
    /**
     * @return Generator<int, T>
     */
    public function all(): Generator
    {
        if (! method_exists($this, 'list')) {
            throw new RuntimeException(
                sprintf(
                    'The "%s" class does not have the "list" method implemented.',
                    get_class($this),
                ),
            );
        }

        $position = $this->optionsPosition();

        if ($position === -1) {
            throw new RuntimeException(
                sprintf(
                    'The "list" method in the "%s" class is missing the "options" parameter.',
                    get_class($this),
                ),
            );
        }

        $args = func_get_args();

        $options = &$args[$position];

        if (! is_array($options)) {
            if ($options === null) {
                $options = [];
            } else {
                throw new RuntimeException(
                    sprintf(
                        'The "options" parameter in the "list" method of the "%s" class should be an array.',
                        get_class($this),
                    ),
                );
            }
        }

        if (! isset($options['limit'])) {
            $options['limit'] = 100;
        }

        $after = '';

        do {
            $options['after'] = $after;

            [
                'data' => $items,
                'paging' => $paging,
            ] = $this->list(...$args); // @phpstan-ignore-line

            foreach ($items as $item) {
                yield $item;
            }

            if (empty($paging->next)) {
                break;
            }

            if ($paging instanceof CursorPagination) {
                $after = $paging->cursors?->after;
            } elseif ($paging instanceof TimePagination) { // @phpstan-ignore-line
                break;
            } elseif ($paging instanceof OffsetPagination) { // @phpstan-ignore-line
                break;
            } else { // @phpstan-ignore-line
                break;
            }
        } while (! empty($after));
    }

    /**
     * Find the options parameter position.
     */
    public function optionsPosition(): int
    {
        try {
            $reflection = new ReflectionMethod(
                $this,
                'list',
            );
        } catch (ReflectionException) {
            return -1;
        }

        $parameters = $reflection->getParameters();

        foreach ($parameters as $parameter) {
            if ($parameter->getName() === 'options') {
                return $parameter->getPosition();
            }
        }

        return -1;
    }
}
