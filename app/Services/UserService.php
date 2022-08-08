<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;

class UserService
{
    public function store(array $params): void
    {
        if (isset($params['permissions']))
        {
            $permissions = $params['permissions'];
            unset($params['permissions']);
        }

        $role = $params['role'];
        unset($params['role']);

        $user = User::create($params);
        $user->assignRole($role);

        isset($permissions) ? $user->givePermissionsTo($permissions) : null;
    }
}
