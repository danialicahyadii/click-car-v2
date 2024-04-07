<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Display the login redirect to Kifest.
     */
    public function redirectToKifest()
    {
        if (env('APP_ENV') == 'local') {
            return redirect(url('login-for-admin'));
        } else {
            return redirect()->away('https://kifest.kimiafarma.co.id/');
        }
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        activity()->log('Melakukan Login Aplikasi');

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        activity()->log('Melakukan Logout Aplikasi');

        Auth::guard('web')->logout();

        $request->session()->flush();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
