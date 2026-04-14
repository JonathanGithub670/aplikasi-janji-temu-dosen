<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('login.index2', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'nim' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['nim' => $credentials['nim'], 'password' => $credentials['password'], 'status' => 1])) {
            $request->session()->regenerate();
            if (Auth::user()->role == 'admin') {
                return redirect()->intended('dashboard');
            } elseif (Auth::user()->role == 'dosen') {
                return redirect()->intended('dashboard/calendar');
            } elseif (Auth::user()->role == 'fungsionaris') {
                return redirect()->intended('dashboard/calendar');
            } elseif (Auth::user()->role == 'chaplin') {
                return redirect()->intended('dashboard/calendar');
            } elseif (Auth::user()->role == 'mahasiswa') {
                return redirect()->intended('dashboard/choose');
            } else {
                return back();
            }
        }
        return back()->with('loginError', 'Login Failed!');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }

    public function recoverpw(): View
    {
        return view('forgetpw.index');
    }
}
