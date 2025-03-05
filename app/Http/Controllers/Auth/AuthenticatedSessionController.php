<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
            'recaptchaSiteKey' => config('services.recaptcha.site_key'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->validate([
            'recaptcha_token' => ['required', 'string'],
            
        ]);
    
        // Verificar reCAPTCHA con Google
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $request->recaptcha_token,
        ]);
    
        // Si reCAPTCHA falla, devolver un error
        if (!$response->json()['success']) {
            return back()->withErrors([
                'recaptcha_token' => 'Error de reCAPTCHA. Por favor, inténtalo de nuevo.',
            ]);
        }

        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        $user->verification_token = Str::random(60);

        $user->verification_token_expires_at = Carbon::now()->addMinutes(10);

        $user->save();

        return redirect()->intended(RouteServiceProvider::VERIFY);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
