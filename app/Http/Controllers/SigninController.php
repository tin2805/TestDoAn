<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class SigninController extends Controller
{
    public function showLogin() {
        return view('signin');
    }
    public function login(Request $request) {
        $post_data = $request->all();
        $customer = User::where('email', $post_data['email'])->first();
        if (@$customer->id) {
            if (Hash::check($post_data['password'], $customer->password)) {

                Auth::loginUsingId($customer->id);

                $this->redirectTo = "/chatify";

                return redirect($redirectTo ?? "/chatify");
            } else {
                return redirect('/signin/error/non_auth');
            }
        } else {
            return redirect('/signin/error/non_auth');
        }
    }
}
