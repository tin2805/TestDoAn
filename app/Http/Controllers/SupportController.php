<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Support;
use Auth;

class SupportController extends Controller
{
    public function index() {
        $supports = Support::where('employee_id', Auth::id())->get();
        $countTotal = Support::where('employee_id', Auth::id())->count();
        $countOpen = Support::where('employee_id', Auth::id())->where('status', 1)->count();
        $countClose = Support::where('employee_id', Auth::id())->where('status', 0)->count();
        $countOnHold = Support::where('employee_id', Auth::id())->where('status', 2)->count();
        return view('support.index')->with(compact('supports', 'countTotal', 'countOpen', 'countClose', 'countOnHold'));
    }
    public function create() {
        $priority = [
            __('Low'),
            __('Medium'),
            __('High'),
            __('Critical'),
        ];

        $status = [
            __('Open'),
            __('Close'),
        ];

        return view('support.create')->with(compact('priority', 'status'));
    }

    public function store(Request $request) {
        // dd($request->all());
        $support = $request->all();
        $support['type'] = 'support';
        $support['employee_id'] = Auth::id();
        $support['status'] = 2;
        Support::create($support);
        return redirect()->route('support.index')->with('success', __('Support successfully added.'));
    }

    public function edit(Support $support)
    {
        $priority = [
            __('Low'),
            __('Medium'),
            __('High'),
            __('Critical'),
        ];
        //$status = Support::$status;
        $status = Support::status();

        return view('support.edit', compact('priority', 'support','status'));
    }

    public function update(Request $request, $id) {
        $support = $request->only('subject', 'priority', 'expired', 'body');
        $support['type'] = 'support';
        $support['employee_id'] = Auth::id();
        $support['status'] = 2;
        Support::where('id', $id)->update($support);
        return redirect()->route('support.index')->with('success', __('Support successfully update.'));
    }
}
