<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\CheckInOut;

class DashboardController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('auth');
    }

    // protected function guard()
    // {
    //     return Auth::guard();
    // }

    public function index() {
        return view('welcome');
    }

    public function logout() {
        Auth::guard()->logout();

        return redirect('/signin');
    }

    public function checkin() {
        $ip_company = $this->setting('site.ip_company');
        $ip_company = explode(',',$ip_company);
        $client_ip = request()->ip();
        $checkin = CheckInOut::where('employee_id', Auth::id())->whereBetween('created_at', [date("Y-m-d H:i:s", strtotime("midnight", time())), date("Y-m-d H:i:s", strtotime("tomorrow", time()) - 1)])->first();
        if($checkin){
            return redirect()->back()->with('error_message', 'You have been checkin to day');
        }
        if(in_array($client_ip, $ip_company)){
            $args = [
                'employee_id' => Auth::user()->id,
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
            return redirect()->back()->with('success_message', 'Success checkin to day');
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
            $checkin = CheckInOut::where('employee_id', Auth::id())->whereBetween('created_at', [date("Y-m-d H:i:s", strtotime("midnight", time())), date("Y-m-d H:i:s", strtotime("tomorrow", time()) - 1)])->first();
            $args = [
                'end_time' => now(),
                'reason_early' => @$request->reason_early ?? null,
                'OT' => false,
            ];
            if(now() > "7:00 PM"){
                $args['OT'] = true;
            }
    
            $checkin::update($args);
            return redirect()->back()->with('success_message', 'Success checkout to day');
        }
        else{
            return redirect()->back()->with('error_message', 'Wrong Ip Company');
        }

    }
}
