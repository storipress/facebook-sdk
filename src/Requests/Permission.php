<?php

declare(strict_types=1);

namespace Storipress\Facebook\Requests;

use stdClass;
use Storipress\Facebook\Objects\CursorPagination;
use Storipress\Facebook\Objects\Permission as PermissionObject;
use Storipress\Facebook\Requests\Traits\HasAll;

class Permission extends Request
{
    /**
     * @phpstan-use HasAll<PermissionObject>
     */
    use HasAll;

    /**
     * @param  array<string, string>  $options
     * @return array{
     *     data: array<int, PermissionObject>,
     *     paging: CursorPagination,
     * }
     */
    public function list(string $userId, array $options = []): array
    {
        $data = $this->request(
            'get',
            sprintf('/%s/permissions', $userId),
        );

        return [
            'data' => array_map(
                fn (stdClass $permission) => PermissionObject::from($permission),
                $data->data,
            ),
            'paging' => CursorPagination::from(
                new stdClass(),
            ),
        ];
    }

    /**
     * @return array<int, PermissionObject>
     */
    public function granted(string $userId): array
    {
        return $this->status($userId, 'granted');
    }

    /**
     * @return array<int, PermissionObject>
     */
    public function declined(string $userId): array
    {
        return $this->status($userId, 'declined');
    }

    /**
     * @return array<int, PermissionObject>
     */
    public function expired(string $userId): array
    {
        return $this->status($userId, 'expired');
    }

    /**
     * @return array<int, PermissionObject>
     *
     * @internal
     */
    public function status(string $userId, string $status): array
    {
        $permissions = [];

        foreach ($this->all($userId) as $permission) {
            if ($permission->status === $status) {
                $permissions[] = $permission;
            }
        }

        return $permissions;
    }
}
