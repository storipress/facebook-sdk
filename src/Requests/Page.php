<?php

declare(strict_types=1);

namespace Storipress\Facebook\Requests;

use stdClass;
use Storipress\Facebook\Objects\CursorPagination;
use Storipress\Facebook\Objects\Page as PageObject;
use Storipress\Facebook\Objects\SearchPage;
use Storipress\Facebook\Requests\Traits\HasAll;

class Page extends Request
{
    /**
     * @phpstan-use HasAll<PageObject>
     */
    use HasAll;

    /**
     * @param  array<string, string>  $options
     * @return array{
     *     data: array<int, PageObject>,
     *     paging: CursorPagination,
     * }
     *
     * @link https://developers.facebook.com/docs/graph-api/reference/user/accounts
     */
    public function list(string $userId, array $options = []): array
    {
        $data = $this->request(
            'get',
            sprintf('/%s/accounts', $userId),
            $options,
        );

        return [
            'data' => array_map(
                fn (stdClass $page) => PageObject::from($page),
                $data->data,
            ),
            'paging' => CursorPagination::from(
                $data->paging ?? new stdClass(),
            ),
        ];
    }

    /**
     * @param  array<string, string>  $options
     * @return array<int, SearchPage>
     *
     * @link https://developers.facebook.com/docs/pages-api/search-pages
     */
    public function search(string $keyword, array $options = []): array
    {
        $data = $this->request(
            'get',
            sprintf('/pages/search?q=%s', $keyword),
            $options,
        );

        return array_map(
            fn (stdClass $page) => SearchPage::from($page),
            $data->data,
        );
    }
}
