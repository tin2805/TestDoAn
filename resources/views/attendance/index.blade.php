@extends('layouts.base')
@section('head')
<title>Attendance</title>
@endsection
@section('page-title')
    {{__('Manage Attendance List')}}
@endsection
@push('script-page')
    <script>
        $('input[name="type"]:radio').on('change', function (e) {
            var type = $(this).val();

            if (type == 'monthly') {
                $('.month').addClass('d-block');
                $('.month').removeClass('d-none');
                $('.date').addClass('d-none');
                $('.date').removeClass('d-block');
            } else {
                $('.date').addClass('d-block');
                $('.date').removeClass('d-none');
                $('.month').addClass('d-none');
                $('.month').removeClass('d-block');
            }
        });

        $('input[name="type"]:radio:checked').trigger('change');

    </script>
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Attendance')}}</li>
@endsection

@section('content')


    <div class="row">
        <div class="col-sm-12">
                    @if (session('status'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {!! session('status') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
                    @endif

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
                                    <th>{{__('Employee')}}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Clock In')}}</th>
                                <th>{{__('Clock Out')}}</th>
                                <th>{{__('Late')}}</th>
                                <th>{{__('Early Leaving')}}</th>
                                <th>{{__('Overtime')}}</th>
                                @if(Gate::check('edit attendance') || Gate::check('delete attendance'))
                                    <th>{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($attendanceEmployee as $attendance)
                                <tr>
                                    <td>{{!empty($attendance->employee)?$attendance->employee->fullname:'' }}</td>
                                    <td>{{ \Auth::user()->dateFormat($attendance->start_time) }}</td>
                                    <td>{{ ($attendance->start_time !='00:00:00') ?\Auth::user()->timeFormat( $attendance->start_time):'00:00' }} </td>
                                    <td>{{ ($attendance->end_time !='00:00:00') ?\Auth::user()->timeFormat( $attendance->end_time):'00:00' }}</td>
                                    <td>{{ $attendance->late }}</td>
                                    <td>{{ $attendance->early_leaving }}</td>
                                    <td>{{ $attendance->OT }}</td>
                                    @if(Gate::check('edit attendance') || Gate::check('delete attendance'))
                                        <td>
                                            @can('edit attendance')
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" data-url="{{ URL::to('attendanceemployee/'.$attendance->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Attendance')}}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-original-title="{{__('Edit')}}">
                                                        <i class="ti ti-pencil text-white"></i></a>
                                                </div>
                                            @endcan
                                            @can('delete attendance')
                                                <div class="action-btn bg-danger ms-2">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['attendanceemployee.destroy', $attendance->id],'id'=>'delete-form-'.$attendance->id]) !!}

                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}"
                                                       data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$attendance->id}}').submit();">
                                                        <i class="ti ti-trash text-white"></i></a>
                                                    {!! Form::close() !!}
                                                </div>
                                            @endif
                                        </td>
                                    @endif
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

@push('script-page')
    <script>
        $(document).ready(function () {
            $('.daterangepicker').daterangepicker({
                format: 'yyyy-mm-dd',
                locale: {format: 'YYYY-MM-DD'},
            });
        });
    </script>
@endpush
