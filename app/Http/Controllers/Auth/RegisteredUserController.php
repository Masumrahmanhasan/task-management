<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Jobs\SendNewRegistrationNotification;
use App\Models\User;
use App\Notifications\NewRegistrationNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(RegistrationRequest $request): RedirectResponse
    {
        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $user->attachRole('user');

        SendNewRegistrationNotification::dispatchAfterResponse($user);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
