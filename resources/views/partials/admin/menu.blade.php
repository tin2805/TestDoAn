@php
    use App\Models\Utility;
        $logo=asset(Storage::url(setting('site.logo')));
        $company_logo=Utility::getValByName('company_logo_dark');
        $company_logos=Utility::getValByName('company_logo_light');
        $company_small_logo=Utility::getValByName('company_small_logo');
        $setting = \App\Models\Utility::colorset();
        $mode_setting = \App\Models\Utility::mode_layout();
        //$emailTemplate     = \App\Models\EmailTemplate::first();
        $lang= Auth::user()->lang;


@endphp

@if (isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on')
    <nav class="dash-sidebar light-sidebar transprent-bg">
@else
    <nav class="dash-sidebar light-sidebar">
@endif
    <div class="navbar-wrapper">
        <div class="m-header main-logo">
            <a href="#" class="b-brand">
               <img src="{{ $logo }}" alt="{{ env('APP_NAME') }}" class="logo logo-lg" />

            </a>
        </div>
        <div class="navbar-content">
            @if(true)
                <ul class="dash-navbar">
                    <!--------------------- Start Dashboard ----------------------------------->
                        <li class="dash-item dash-hasmenu
                                {{ ( Request::segment(1) == null ||Request::segment(1) == 'account-dashboard' || Request::segment(1) == 'income report'
                                   || Request::segment(1) == 'report' || Request::segment(1) == 'reports-payroll' || Request::segment(1) == 'reports-leave' ||
                                    Request::segment(1) == 'reports-monthly-attendance' || Request::segment(1) == 'reports-lead' || Request::segment(1) == 'reports-deal' ) ?'active dash-trigger':''}}">

                            <a href="{{url('/dashboard')}}" class="dash-link "><span class="dash-micon"><i class="ti ti-home"></i></span><span class="dash-mtext">{{__('Dashboard')}}</span></a>

                        </li>
                    {{-- @endif --}}
                    <!--------------------- End Dashboard ----------------------------------->

                    <!--------------------- Start Project ----------------------------------->

                    {{-- @if(\Auth::user()->show_project() == 1) --}}
                    {{-- @if(true)
                        @if( Gate::check('manage project'))
                            <li class="dash-item dash-hasmenu
                                            {{ ( Request::segment(1) == 'project' || Request::segment(1) == 'bugs-report' || Request::segment(1) == 'bugstatus' ||
                                                 Request::segment(1) == 'project-task-stages' || Request::segment(1) == 'calendar' || Request::segment(1) == 'timesheet-list' ||
                                                 Request::segment(1) == 'taskboard' || Request::segment(1) == 'timesheet-list' || Request::segment(1) == 'taskboard' ||
                                                 Request::segment(1) == 'project' || Request::segment(1) == 'projects' || Request::segment(1) == 'project_report') ? 'active dash-trigger' : ''}}">
                                <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-share"></i></span><span class="dash-mtext">{{__('Project System')}}</span><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                <ul class="dash-submenu">
                                    @can('manage project')
                                        <li class="dash-item  {{Request::segment(1) == 'project' || Request::route()->getName() == 'projects.list' || Request::route()->getName() == 'projects.list' ||Request::route()->getName() == 'projects.index' || Request::route()->getName() == 'projects.show' || request()->is('projects/*') ? 'active' : ''}}">
                                            <a class="dash-link" href="{{route('projects.index')}}">{{__('Projects')}}</a>
                                        </li>
                                    @endcan
                                    @can('manage project task')
                                        <li class="dash-item {{ (request()->is('taskboard*') ? 'active' : '')}}">
                                            <a class="dash-link" href="{{ route('taskBoard.view', 'list') }}">{{__('Tasks')}}</a>
                                        </li>
                                    @endcan
                                    @can('manage timesheet')
                                        <li class="dash-item {{ (request()->is('timesheet-list*') ? 'active' : '')}}">
                                            <a class="dash-link" href="{{route('timesheet.list')}}">{{__('Timesheet')}}</a>
                                        </li>
                                    @endcan
                                    @can('manage bug report')
                                        <li class="dash-item {{ (request()->is('bugs-report*') ? 'active' : '')}}">
                                            <a class="dash-link" href="{{route('bugs.view','list')}}">{{__('Bug')}}</a>
                                        </li>
                                    @endcan
                                    @can('manage project task')
                                        <li class="dash-item {{ (request()->is('calendar*') ? 'active' : '')}}">
                                            <a class="dash-link" href="{{ route('task.calendar',['all']) }}">{{__('Task Calendar')}}</a>
                                        </li>
                                    @endcan
                                    @if(\Auth::user()->type!='super admin')
                                        <li class="dash-item  {{ (Request::segment(1) == 'time-tracker')?'active open':''}}">
                                            <a class="dash-link" href="{{ route('time.tracker') }}">{{__('Tracker')}}</a>
                                        </li>
                                    @endif
                                    @if (\Auth::user()->type == 'company' || \Auth::user()->type == 'Employee')
                                         <li class="dash-item  {{(Request::route()->getName() == 'project_report.index' || Request::route()->getName() == 'project_report.show') ? 'active' : ''}}">
                                             <a class="dash-link" href="{{route('project_report.index') }}">{{__('Project Report')}}</a>
                                         </li>
                                    @endif

                                    @if(Gate::check('manage project task stage') || Gate::check('manage bug status'))
                                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'bugstatus' || Request::segment(1) == 'project-task-stages') ? 'active dash-trigger' : ''}}">
                                            <a class="dash-link" href="#">{{__('Project System Setup')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                            <ul class="dash-submenu">
                                                @can('manage project task stage')
                                                    <li class="dash-item  {{ (Request::route()->getName() == 'project-task-stages.index') ? 'active' : '' }}">
                                                        <a class="dash-link" href="{{route('project-task-stages.index')}}">{{__('Project Task Stages')}}</a>
                                                    </li>
                                                @endcan
                                                @can('manage bug status')
                                                    <li class="dash-item {{ (Request::route()->getName() == 'bugstatus.index') ? 'active' : '' }}">
                                                        <a class="dash-link" href="{{route('bugstatus.index')}}">{{__('Bug Status')}}</a>
                                                    </li>
                                                @endcan
                                            </ul>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                    @endif --}}

                    <!--------------------- End Project ----------------------------------->


                    @if(true)
                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'attendance')?'active':''}}">
                            <a href="{{url('attendance')}}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-headphones"></i></span><span class="dash-mtext">{{__('Attendance')}}</span>
                            </a>
                        </li>
                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'support')?'active':''}}">
                            <a href="{{url('support')}}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-headphones"></i></span><span class="dash-mtext">{{__('Support System')}}</span>
                            </a>
                        </li>
                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'chats')?'active':''}}">
                            <a href="{{ url('chats') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-message-circle"></i></span><span class="dash-mtext">{{__('Messenger')}}</span>
                            </a>
                        </li>
                    @endif
                </ul>
            @endif
        </div>
    </div>
</nav>
