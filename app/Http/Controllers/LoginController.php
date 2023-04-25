<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function index() {
        return view('login.index2', [
            'title' => 'Login'
        ]);
    }
    public function authenticate(Request $request) {
        $credentials = $request->validate([
            // 'email' => 'required|email:dns',
            'nim' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['nim' => $credentials['nim'], 'password' => $credentials['password'], 'status' => 1])){
            $request->session()->regenerate();
            if (Auth::user()->role == 'admin'){
                return redirect()->intended('dashboard');
            }elseif(Auth::user()->role == 'dosen'){
                return redirect()->intended('dashboard/calendar');
            }elseif(Auth::user()->role == 'fungsionaris'){
                return redirect()->intended('dashboard/calendar');
            }elseif(Auth::user()->role == 'chaplin'){
                return redirect()->intended('dashboard/calendar');
            }elseif(Auth::user()->role == 'mahasiswa'){
                return redirect()->intended('dashboard/choose');
            }else{
                return back();
            }
            // if (Auth::user()->role != 'superadmin'){
            //     return redirect()->intended('dashboard/choose');
            // }else{
            //     return redirect()->intended('dashboard');
            // }
        }
        return back()->with('loginError' , 'Login Failed!');
    }

    public function logout() {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }

    public function recoverpw() {
        return view('forgetpw.index');
    }
}
