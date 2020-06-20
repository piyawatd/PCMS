<?php

// Authentication mechanism
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials,true)) {
            // Authentication passed...
            $use = Auth::user();
            if($use->role == 'admin'){
                return redirect()->route('adminindex')->with('success', 'Login success.');
            }else{
                return redirect()->route('orderindex')->with('success', 'Login success.');
            }
        }else{
            return redirect()->route('login')->with('error', 'Username or Password is wrong.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
