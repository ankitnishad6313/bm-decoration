<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Artisan;
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
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $role = Auth::user()->role;
        if($role == 'admin'){
            return redirect("$role/dashboard")->with('success', 'Login Successfully!');
        }else{
            return redirect()->back()->with('success', 'Login Successfully!');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request, $key = null): RedirectResponse
    {
        Auth::guard('web')->logout();
        switch($key){
            case 'down':
                Artisan::call('down');
                break;
            case 'up':
                Artisan::call('up');
            break;
        }

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout Successfully!');
    }
}
