<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $request->session()->put('auth_expiration', now()->addDays(14));

            return redirect()->intended(route('overview.index'));
        }

        return back()
            ->withErrors(['email' => 'Neplatné přihlašovací údaje.'])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'email'         => $data['email'],
            'password'      => Hash::make($data['password']),
            'role'          => 'user',
            'location_id'   => null,
            'location_name' => null,
        ]);

        Auth::login($user);

        return redirect()->route('overview.index');
    }
}
