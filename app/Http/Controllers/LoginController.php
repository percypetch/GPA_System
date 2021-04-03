<?php

namespace App\Http\Controllers;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function loginForm() {
        return view('login-form');
    }

    function authenticate(Request $request) {
        $data = $request->getParsedBody();
        $credentials = [
             'email' => $data['email'],
            'password' => $data['password'],
        ];

        if (Auth::attempt($credentials)) {
            session()->regenerate();
            
            return redirect()->intended(route('student-list'));
        }

        return back()->withErrors([
            'email' => 'D:',
        ]);
    }
    

    function logout() {
        Auth::logout();
        
        session()->invalidate();

        session()->regenerateToken();
        
        return redirect()->route('login');
    }
}
