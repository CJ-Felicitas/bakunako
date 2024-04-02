<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect('/');
            } else {
                throw new \Exception('Invalid credentials');
            }
        } catch (\Exception $e) {
            return redirect('/login')->with('error', $e->getMessage());
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
