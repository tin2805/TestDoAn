<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;

class SigninController extends Controller
{
    protected function guard()
    {
        return Auth::guard('employee');
    }

    public function showLogin() {
        return view('signin');
    }
    public function login(Request $request) {
        $post_data = $request->all();
        $customer = Employee::where('email', $post_data['email'])->first();
        if (@$customer->id) {
            if (Hash::check($post_data['password'], $customer->password)) {

                Auth::loginUsingId($customer->id);

                $this->redirectTo = "/dashboard";

                return redirect($redirectTo ?? "/dashboard");
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
}
