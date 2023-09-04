<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Auth;
use Hash;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function profile() {
        $userDetail = Employee::find(Auth::id());
        
        return view('user.profile')->with(compact('userDetail'));
    }

    public function updateAccount(Request $request) {
        $employee = Employee::find(Auth::id());
        $post_data = $request->only('fullname', 'email');
        if($request->profile) {
            $file= $request->file('profile');
            $filename= date('YmdHi').Str::random(8). '.'.$file->getClientOriginalExtension();
            \Storage::disk('public')->putFileAs('/avatar/'.date('FY') ,$file,  $filename );
            $filePath ='avatar/'. date('FY').'/'. $filename;
            $post_data['avatar'] =  $filePath;
        }

        $employee->update($post_data);
        return redirect()->back()->with('success', __('Update account successfully.'));
    }

    public function updatePassword(Request $request) {
        $employee = Employee::find(Auth::id());
        $post_data = $request->only('old_password', 'password', 'password_confirmation');
        if(Hash::check($post_data['old_password'], $employee->password)){        
            if($post_data['password'] == $post_data['password_confirmation']){
                $post_data['password'] = Hash::make($post_data['password']);
                $employee->update($post_data);
                return redirect()->back()->with('success', __('Update password successfully.'));
            }
            else{
                return redirect()->back()->with('error', __('Confirmation Password Wrong, Please Try Again.'));
            }
        }
        else{
            return redirect()->back()->with('error', __('Old Password Wrong, Please Try Again.'));
        }

    }
}
