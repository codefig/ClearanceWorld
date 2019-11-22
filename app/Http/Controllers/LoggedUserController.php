<?php

namespace App\Http\Controllers;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoggedUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->flush();
        return redirect()->route('user.login');
    }

    public function showDashboard()
    {
        $user = Auth::user();

        return view('user.dashboard', compact('user'));
    }

    public function showApply()
    {
        return view('user.apply');
    }
}
