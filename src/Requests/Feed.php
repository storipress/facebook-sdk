<?php

declare(strict_types=1);

namespace Storipress\Facebook\Requests;

use stdClass;
use Storipress\Facebook\Objects\CursorPagination;
use Storipress\Facebook\Objects\Feed as FeedObject;
use Storipress\Facebook\Requests\Traits\HasAll;

class Feed extends Request
{
    /**
     * @phpstan-use HasAll<FeedObject>
     */
    use HasAll;

    /**
     * @param  array<string, string>  $options
     * @return array{
     *     data: array<int, FeedObject>,
     *     paging: CursorPagination,
     * }
     *
     * @link https://developers.facebook.com/docs/graph-api/reference/page/feed
     */
    public function list(string $id, array $options = [], bool $isPage = true): array
    {
        $data = $this->request(
            'get',
            sprintf('/%s/feed', $id),
            $options,
            $isPage,
        );

        return [
            'data' => array_map(
                fn (stdClass $feed) => FeedObject::from($feed),
                $data->data,
            ),
            'paging' => CursorPagination::from(
                $data->paging ?? new stdClass(),
            ),
        ];
    }

    /**
     * @param array{
     *     message?: string,
     *     link?: string,
     * } $options
     *
     * @link https://developers.facebook.com/docs/pages-api/posts#publish-posts
     * @link https://developers.facebook.com/docs/graph-api/reference/page/feed#publish
     */
    public function create(string $id, array $options, bool $isPage = true): FeedObject
    {
        $data = $this->request(
            'post',
            sprintf('/%s/feed', $id),
            $options,
            $isPage,
        );

        return FeedObject::from($data);
    }

    /**
     * @param array{
     *     message?: string,
     *     link?: string,
     * } $options
     *
     * @link https://developers.facebook.com/docs/pages-api/posts#update-a-post
     */
    public function update(string $postId, array $options, bool $isPage = true): FeedObject
    {
        $data = $this->request(
            'post',
            sprintf('/%s', $postId),
            $options,
            $isPage,
        );

        return FeedObject::from($data);
    }

    /**
     * @link https://developers.facebook.com/docs/pages-api/posts#delete-a-post
     */
    public function delete(string $postId, bool $isPage = true): bool
    {
        $data = $this->request(
            'delete',
            sprintf('/%s', $postId),
            usePageToken: $isPage,
        );

        return $data->success;
    }
}
