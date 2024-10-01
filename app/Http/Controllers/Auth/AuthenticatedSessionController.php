<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

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
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // $request->authenticate();

        $document = Document::where('number', $request->number)->first();

        if (!$document->is_primary) {
            return back()->withErrors([
                'number' => 'Se debe ingresar el documento primario',
            ]);
        }

        if ($document) {
            $user = User::where('person_id', $document->person_id)->first();

            // if ($user && Auth::attempt(['id' => $user->id, 'password' => $request->password])) {
            if ($user && $user->active && !$user->locked && Auth::attempt(['id' => $user->id, 'password' => $request->password])) {
 
                $request->session()->regenerate();
    
                return redirect()->intended(route('dashboard', absolute: false));
            }
        }
        
        return back()->withErrors([
            'number' => 'Las credenciales son incorrectas.',
        ]);
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
