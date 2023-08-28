@extends('layouts.base')
<title>Support</title>
@push('script-page')
@endpush
@section('page-title')
    {{__('Support')}}
@endsection
@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0 ">{{__('Support')}}</h5>
    </div>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Support')}}</li>
@endsection

@section('action-btn')
    <div class="float-end">

       <a href="#" data-size="lg" data-url="{{ route('support.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create')}}" data-title="{{__('Create Support')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>

    </div>
@endsection

@section('content')
<div class="row">


    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mb-3 mb-sm-0">
                        <div class="d-flex align-items-center">
                            <div class="theme-avtar bg-primary">
                                <i class="ti ti-cast"></i>
                            </div>
                            <div class="ms-3">
                                <small class="text-muted">{{__('Total')}}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto text-end">
                        <h3 class="m-0">{{ $countTotal }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mb-3 mb-sm-0">
                        <div class="d-flex align-items-center">
                            <div class="theme-avtar bg-info">
                                <i class="ti ti-cast"></i>
                            </div>
                            <div class="ms-3">
                                <small class="text-muted">{{__('Open')}}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto text-end">
                        <h3 class="m-0">{{ $countOpen }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mb-3 mb-sm-0">
                        <div class="d-flex align-items-center">
                            <div class="theme-avtar bg-warning">
                                <i class="ti ti-cast"></i>
                            </div>
                            <div class="ms-3">
                                <small class="text-muted">{{__('On Hold')}}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto text-end">
                        <h3 class="m-0">{{ $countOnHold }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mb-3 mb-sm-0">
                        <div class="d-flex align-items-center">
                            <div class="theme-avtar bg-danger">
                                <i class="ti ti-cast"></i>
                            </div>
                            <div class="ms-3">
                                <small class="text-muted">{{__('Close')}}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto text-end">
                        <h3 class="m-0">{{ $countClose }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                <table class="table datatable">
                        <thead>
                        <tr>
                            <th scope="col">{{__('Created By')}}</th>
                            <th scope="col">{{__('Priority')}}</th>
                            <th scope="col">{{__('Subject')}}</th>
                            <th scope="col">{{__('Body')}}</th>
                            <th scope="col">{{__('Status')}}</th>
                            <th scope="col">{{__('Created At')}}</th>
                            <th scope="col" >{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @php
                            $supportpath=\App\Models\Utility::get_file('uploads/supports');
                        @endphp
                        @foreach($supports as $support)

                            <tr>
                                <td scope="row">
                                    <div class="media align-items-center">
                                        <div>
                                            <div class="avatar-parent-child">
                                                <img alt="" class="avatar rounded-circle avatar-sm" @if(!empty($support->createdBy) && !empty($support->createdBy->avatar)) src="{{asset(Storage::url('uploads/avatar')).'/'.$support->createdBy->avatar}}" @else  src="{{asset(Storage::url('uploads/avatar')).'/avatar.png'}}" @endif>
                                                {{-- @if($support->replyUnread()>0)
                                                    <span class="avatar-child avatar-badge bg-success"></span>
                                                @endif --}}
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            {{!empty($support->createdBy)?$support->createdBy->fullname:''}}
                                        </div>
                                    </div>
                                </td>
                                <td scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            @if($support->priority == 0)
                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-primary p-2 px-3 rounded">   {{ __(\App\Models\Support::$priority[$support->priority]) }}</span>
                                            @elseif($support->priority == 1)
                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-info p-2 px-3 rounded">   {{ __(\App\Models\Support::$priority[$support->priority]) }}</span>
                                            @elseif($support->priority == 2)
                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-warning p-2 px-3 rounded">   {{ __(\App\Models\Support::$priority[$support->priority]) }}</span>
                                            @elseif($support->priority == 3)
                                                <span data-toggle="tooltip" data-title="{{__('Priority')}}" class="text-capitalize badge bg-danger p-2 px-3 rounded">   {{ __(\App\Models\Support::$priority[$support->priority]) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <td>{{$support->subject}}</td>


                                <td>{{$support->body}}</td>


                                <td>
                                    @if($support->status == '1')
                                        <span class="status_badge text-capitalize badge bg-success p-2 px-3 rounded">{{ __(\App\Models\Support::$status[$support->status]) }}</span>
                                    @elseif($support->status == '0')
                                        <span class="status_badge text-capitalize badge bg-danger p-2 px-3 rounded">{{ __(\App\Models\Support::$status[$support->status]) }}</span>
                                    @elseif($support->status == '2')
                                        <span  class="status_badge text-capitalize badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\Support::$status[$support->status]) }}</span>
                                    @endif
                                </td>



                                <td>{{\Auth::user()->dateFormat($support->created_at)}}</td>

                                <td class="Action">
                                <span>
                                    <div class="action-btn bg-primary ms-2">
                                        <a href="#" data-size="lg" data-url="{{ route('support.edit',$support->id) }}" data-ajax-popup="true" data-title="{{__('Edit Support')}}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-original-title="{{__('Edit')}}">
                                            <i class="ti ti-pencil text-white"></i>
                                        </a>
                                    </div>

                                    <div class="action-btn bg-danger ms-2">
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['support.destroy', $support->id],'id'=>'delete-form-'.$support->id]) !!}

                                        <a href="#!" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" title="{{__('Delete')}}" data-confirm-yes="document.getElementById('delete-form-{{$support->id}}').submit();">
                                            <i class="ti ti-trash text-white"></i>
                                        </a>
                                    </div>
                                    {!! Form::close() !!}
                                </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection

