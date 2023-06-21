<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class SignupController extends Controller
{
    //
    public function index() {
        return view('signup');
    }

    public function register(Request $request) {
        $post_data = $request->all();
        if($post_data['password'] == $post_data['confirm_password']) {
            $user = User::create($post_data);
            Auth::loginUsingId($user->id);
        }
        else {
            return redirect()->back();
        }
        return redirect('/dashboard');
    }
}
