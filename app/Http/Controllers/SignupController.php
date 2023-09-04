<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    //
    public function index() {
        return view('signup');
    }

    public function register(Request $request) {
        $post_data = $request->all();
        $post_data = $this->validation($post_data)->validate();
        if($post_data['password'] == $post_data['confirm_password']) {
            $post_data['password'] = $post_data['password'];
            $user = Employee::create($post_data);
            Auth::loginUsingId($user->id);
        }
        else {
            return redirect()->back()->withInput()
                                    ->withErrors(['confirm_password' => 'The confirm password did not match']);
        }
        return redirect('/dashboard');
    }

    public function validation($data) {
        $rules = [
            'fullname' => ['required', 'string', 'max:200'],
            'user_name' => ['required', 'string', 'max:200', 'unique:employees'],
            'email' => ['required', 'string', 'max:200', 'unique:employees'],
            'phone' => ['required', 'string', 'max:200'],
            'password' => ['required', 'string', 'min:8', 'max:20'],
            'confirm_password' => ['required'],
        ];
        return Validator::make($data, $rules);
    }
}
