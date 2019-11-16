<?php

namespace App\Http\Controllers;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoggedUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('web');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
}
