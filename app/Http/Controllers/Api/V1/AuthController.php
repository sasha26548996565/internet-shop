<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\User\StoreRequest;
use App\Http\Requests\Api\User\UpdateRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(StoreRequest $request)
    {
        $params = $request->validated();
        $params['password'] = Hash::make($params['password']);

        $user = User::create($params);
        $user->assignRole(User::ROLE_USER);

        return response()->json($user);
    }

    public function login(UpdateRequest $request)
    {
        $params = $request->validated();

        if (Auth::attempt($params))
        {
            $user = User::where('email', $params['email'])->first();
            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json(compact('token'));
        }

        return response()->json(['messages' => 'error']);
    }
}
