<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Jobs\SendNewRegistrationNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('MyAppToken')->accessToken;
            return $this->success(['access_token' => $token]);
        } else {
            return $this->failed(message:'Unauthorized', status:401);
        }
    }

    public function register(RegistrationRequest $request)
    {
        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $user->attachRole('user');

        SendNewRegistrationNotification::dispatchAfterResponse($user);

        Auth::login($user);

        $token = $user->createToken('MyAppToken')->accessToken;

        return $this->success(['access_token' => $token]);
    }
}
