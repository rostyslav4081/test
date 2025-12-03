<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Показати форму логіну
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Обробка логіну
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $request->session()->put('auth_expiration', now()->addDays(14));

            // як у тебе було
            return redirect()->intended(route('overview.index'));
        }

        return back()
            ->withErrors(['email' => 'Neplatné přihlašovací údaje.'])
            ->onlyInput('email');
    }

    /**
     * Вихід
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Реєстрація нового користувача (якщо хочеш її залишити)
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'email'    => ['required', 'email', 'unique:sys_users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'role'       => 'user',
            'locationId' => null,
            'locName'    => null,
        ]);

        Auth::login($user);

        return redirect()->route('overview.index');
    }
}
