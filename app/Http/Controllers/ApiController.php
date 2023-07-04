<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\CheckInOut;

class ApiController extends Controller
{
    public function login(Request $request) {
        $post_data = $request->all();
        $customer = Employee::where('email', $post_data['email'])->first();
        if (@$customer->id) {
            if (Hash::check($post_data['password'], $customer->password)) {

                $user = Auth::loginUsingId($customer->id);
                return $user;
            }
        }
        else {
            return false;
        }
    }
    public function checkin() {
        $ip_company = $this->setting('site.ip_company');
        $ip_company = explode(',',$ip_company);
        $client_ip = request()->ip();
        $checkin = CheckInOut::where('employee_id', 2)->whereBetween('created_at', [date("Y-m-d H:i:s", strtotime("midnight", time())), date("Y-m-d H:i:s", strtotime("tomorrow", time()) - 1)])->first();
        if($checkin){
            return response()->json([
                'success' => false,
                'message' => 'you have been checkin to day'
            ]);
        }
        if(in_array($client_ip, $ip_company)){
            $args = [
                'employee_id' => 2,
                'start_time' => now(),
                'end_time' => null,
                'reason_late' => null,
                'reason_early' => null,
                'OT' => false,
                'late' => false,
            ];
            if(now() > "9:30 AM"){
                $args['start_time'] = now();
                $args['reason_late'] = $request->reason_late;
                $args['late'] = true;        
            }
            CheckInOut::create($args);        
        }
        else{
            return redirect()->back()->with('error_message', 'Wrong Ip Company');
        }

    }

    public function checkout() {
        $ip_company = $this->setting('site.ip_company');
        $ip_company = explode(',',$ip_company);
        $client_ip = request()->ip();
        if(in_array($client_ip, $ip_company)){
            $checkin = CheckInOut::where('employee_id', 2)->whereBetween('created_at', [date("Y-m-d H:i:s", strtotime("midnight", time())), date("Y-m-d H:i:s", strtotime("tomorrow", time()) - 1)])->first();
            $checkin['end_time'] = now();
            $checkin['reason_early'] = @$request->reason_early ?? null;
            $checkin['OT'] = false;

            if(now() > "7:00 PM"){
                $checkin['OT'] = true;
            }

            $checkin->save();
        }
        else{
            return redirect()->back()->with('error_message', 'Wrong Ip Company');
        }

    }

    //
    public function setting($key) {

        $setting = \DB::table('settings')->where('key', $key)->first();

        return $setting->value;
    }
}
