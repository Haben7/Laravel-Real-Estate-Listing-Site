<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('owner.index');
            }
        } else {
            return redirect()->route('login')->with('error', 'Email or password is incorrect.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}





  // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $user = Auth::user();
    //         return $this->authenticated($request, $user);
    //     }

    //     return back()->withErrors(['email' => 'Invalid credentials.']);
    // }