<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //authentication
    public function loginPage()
    {
        return view('auth.superadmin_auth');
    }

    // auth check
    public function authCheck(Request $request)
    {
        $credientials = $request->only('email', 'password');

        if (Auth::attempt($credientials)) {
            return redirect()->route('superadmin.dashboard');
        } else {
            return back()->with('error', 'Email or Password is invalid');
        }
    }

    // logout
    public function logOut()
    {
        Auth::logout();

        return redirect()->route('superadmin.login')->with('success', 'You have logged out successfully');
    }
}
