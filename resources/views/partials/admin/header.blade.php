@php
    $users=\Auth::user();
    //$profile=asset(Storage::url('uploads/avatar/'));
    $languages=\App\Models\Utility::languages();
    $lang = isset($users->lang)?$users->lang:'en';
    $setting = \App\Models\Utility::colorset();
    $mode_setting = \App\Models\Utility::mode_layout();


    $unseenCounter=App\Models\ChMessage::where('to_id', Auth::user()->id)->where('seen', 0)->count();
@endphp
@if (isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on')
    <header class="dash-header transprent-bg">
@else
    <header class="dash-header">
@endif
    <div class="header-wrapper">
        <div class="dash-mob-drp">
            <ul class="list-unstyled">
                <li class="dash-h-item mob-hamburger">
                    <a href="#!" class="dash-head-link" id="mobile-collapse">
                        <div class="hamburger hamburger--arrowturn">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                </li>

                <li class="dropdown dash-h-item drp-company">
                    <a
                        class="dash-head-link dropdown-toggle arrow-none me-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false"
                    >
                        <span class="theme-avtar">
                             <img src="{{ asset('storage/'.\Auth::user()->avatar)}}" class="img-fluid rounded-circle">
                        </span>
                        <span class="hide-mob ms-2">{{__('Hi, ')}}{{\Auth::user()->fullname }}!</span>
                        <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown">

                        <a href="{{ route('change.mode') }}" class="dropdown-item">
                            <i class="ti ti-circle-plus"></i>
                            <span>{{(Auth::user()->dark_mode == 0) ? __('Dark Mode') : __('Light Mode')}}</span>
                        </a>

                        <a href="{{route('profile')}}" class="dropdown-item">
                            <i class="ti ti-user"></i>
                            <span>{{__('Profile')}}</span>
                        </a>

                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="dropdown-item">
                            <i class="ti ti-power"></i>
                            <span>{{__('Logout')}}</span>
                        </a>
                        <form id="frm-logout" action="{{ route('logout') }}" method="GET" class="d-none">
                            {{ csrf_field() }}
                        </form>

                    </div>
                </li>

            </ul>
        </div>
        <div class="">
            <ul class="list-unstyled">
                @if( \Auth::user()->type !='client' && \Auth::user()->type !='super admin' )
                    <li class="dropdown dash-h-item drp-notification">
                        <a class="dash-head-link arrow-none me-0" href="{{ url('chats') }}" aria-haspopup="false"
                           aria-expanded="false">
                            <i class="ti ti-brand-hipchat"></i>
                            <span class="bg-danger dash-h-badge message-toggle-msg  message-counter custom_messanger_counter beep"> {{ $unseenCounter }}<span
                                    class="sr-only"></span>
                            </span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    </header>
