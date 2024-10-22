<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return $this->authenticated($request, $user);
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            return redirect('/admin');
        }

        if ($user->role === 'owner') {
            return redirect('/owner');
        }

        return redirect('/home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

