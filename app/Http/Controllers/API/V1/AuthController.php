<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Jobs\SendNewRegistrationNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('MyAppToken')->accessToken;
            return $this->success(['access_token' => $token]);
        } else {
            return $this->failed(message:'Unauthorized', status:401);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->attachRole('user');

        dispatch(new SendNewRegistrationNotification($user));

        Auth::login($user);
        $token = $user->createToken('MyAppToken')->accessToken;
        return $this->success(['access_token' => $token]);
    }
}
