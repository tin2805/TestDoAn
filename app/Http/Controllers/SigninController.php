<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Jobs\SendEmail;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;


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

    public function forgotPassView() {
        return view('forgot_pass');
    }

    public function forgotPass(Request $request) {
        $employee = Employee::where('email', $request->email)->first();
        if (!$employee) {
            return redirect()->back()->with('message', 'Sorry, email not found.');
        }

        $codeVerify = random_int(10000, 99999);
        $employee->update(['code' => $codeVerify]);
        $message = [
            'type' => 'Forgot Password',
            'task' => 'Forgot Password Code',
            'content' => $codeVerify,
        ];
        Mail::to($employee->email)->send(new MailNotify($message));
        
        return view('passwords.email')->with(compact('employee'));
    }

    public function forgotPassInput(Request $request){
        $employee = Employee::where('email', $request->email)->first();
        if($request->code = $employee->code) {
            return view('passwords.reset')->with(compact('employee'));
        }
        else {
            return redirect()->back()->with('message', 'invalid code');
        }
    }

    public function changePassword(Request $request){
        $employee = Employee::where('email', $request->email)->first();
        if($request->password == $request->password_confirmation){
            $employee->update(['password' => Hash::make($request->password)]);
            Auth::loginUsingId($employee->id);

            $this->redirectTo = "/dashboard";
            
            return redirect($redirectTo ?? "/dashboard");
        }
        else{
            return view('passwords.reset')->with(compact('employee'))->with('message', 'Wrong Re Password');
        }
    }
}
