<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class DashboardController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function index() {
        return view('welcome');
    }

    public function logout() {
        Auth::guard()->logout();

        return redirect('/signin');
    }
}
