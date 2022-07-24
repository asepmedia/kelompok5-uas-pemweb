<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if(Auth::check()) {
            return redirect('/');
        }
        return view('auth.login');
    }

    public function store(Request $request)
    {
        if(Auth::attempt([
            'email'     => $request->email,
            'password'  => $request->password
        ])) {
            $request->session()->regenerate();
            return redirect('/');
        }
        return view('web.auth.login');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');
    }

    public function username()
    {
        return 'email';
    }
}
