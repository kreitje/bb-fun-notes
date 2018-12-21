<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{

    public function create()
    {
        return view('session.create');
    }

    public function store(Request $request)
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        if (auth()->attempt($credentials)) {
            return redirect()->intended('/')->withSuccess('Welcome back ' . auth()->user()->name . '!');
        }

        return redirect()->back()->with('loginError', 'Your email or password did not match.');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/login')->withSuccess('You have been logged out.');
    }
}