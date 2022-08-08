<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Mail\PasswordMail;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class UserService
{
    public function store(array $params): void
    {
        DB::beginTransaction();

        try
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

            isset($permissions) ? $user->givePermissionTo($permissions) : null;

            Mail::to($params['email'])->send(new PasswordMail($params['password']));
            event(new Registered($user));

            DB::commit();
        } catch (\Exception $exception)
        {
            DB::rollback();
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
