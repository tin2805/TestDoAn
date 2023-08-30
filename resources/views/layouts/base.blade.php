@php
    use App\Models\Utility;

        //$logo=asset(Storage::url('uploads/logo/'));
           $logo=\App\Models\Utility::get_file('uploads/logo');

        $company_favicon=Utility::getValByName('company_favicon');
        $setting = \App\Models\Utility::colorset();
        $company_logo = \App\Models\Utility::GetLogo();
        $mode_setting = \App\Models\Utility::mode_layout();
        $color = (!empty($setting['color'])) ? $setting['color'] : 'theme-3';
        $SITE_RTL = Utility::getValByName('SITE_RTL');
        $lang=Utility::getValByName('default_language');


@endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="">


<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
<head>
    @yield('head')
    <script src="{{ asset('js/html5shiv.js') }}"></script>
{{--    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>--}}
{{--    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>--}}

    <!-- Meta -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="url" content="{{ url('').'/'.config('chatify.path') }}" data-user="{{ Auth::user()->id }}">
    <link rel="icon" href="" type="image" sizes="16x16">

    <!-- Favicon icon -->
{{--    <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon"/>--}}
    <!-- Calendar-->
    @stack('css-page')
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/main.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/plugins/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/flatpickr.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.min.css') }}">


    <!-- font css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">

    <!--bootstrap switch-->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/bootstrap-switch-button.min.css') }}">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}">
    {{-- @if ($SITE_RTL == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}">
    @endif --}}
    @if (\Auth::user()->dark_mode == '1')
        <link rel="stylesheet" href="{{ asset('assets/css/style-dark.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
    @endif

    <link rel="stylesheet" href="{{ asset('assets/css/customizer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('css-page')
</head>
<body class="red">


<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>

@include('partials.admin.menu')
<!-- [ navigation menu ] end -->
<!-- [ Header ] start -->
@include('partials.admin.header')

<!-- Modal -->
<div class="modal notification-modal fade"
     id="notification-modal"
     tabindex="-1"
     role="dialog"
     aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button
                    type="button"
                    class="btn-close float-end"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
                <h6 class="mt-2">
                    <i data-feather="monitor" class="me-2"></i>Desktop settings
                </h6>
                <hr/>
                <div class="form-check form-switch">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        id="pcsetting1"
                        checked
                    />
                    <label class="form-check-label f-w-600 pl-1" for="pcsetting1"
                    >Allow desktop notification</label
                    >
                </div>
                <p class="text-muted ms-5">
                    you get lettest content at a time when data will updated
                </p>
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" id="pcsetting2"/>
                    <label class="form-check-label f-w-600 pl-1" for="pcsetting2"
                    >Store Cookie</label
                    >
                </div>
                <h6 class="mb-0 mt-5">
                    <i data-feather="save" class="me-2"></i>Application settings
                </h6>
                <hr/>
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" id="pcsetting3"/>
                    <label class="form-check-label f-w-600 pl-1" for="pcsetting3"
                    >Backup Storage</label
                    >
                </div>
                <p class="text-muted mb-4 ms-5">
                    Automaticaly take backup as par schedule
                </p>
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" id="pcsetting4"/>
                    <label class="form-check-label f-w-600 pl-1" for="pcsetting4"
                    >Allow guest to print file</label
                    >
                </div>
                <h6 class="mb-0 mt-5">
                    <i data-feather="cpu" class="me-2"></i>System settings
                </h6>
                <hr/>
                <div class="form-check form-switch">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        id="pcsetting5"
                        checked
                    />
                    <label class="form-check-label f-w-600 pl-1" for="pcsetting5"
                    >View other user chat</label
                    >
                </div>
                <p class="text-muted ms-5">Allow to show public user message</p>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-light-danger btn-sm"
                    data-bs-dismiss="modal"
                >
                    Close
                </button>
                <button type="button" class="btn btn-light-primary btn-sm">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>
<!-- [ Header ] end -->

<!-- [ Main Content ] start -->
<div class="dash-container">
    <div class="dash-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="page-header-title">
                            <h4 class="m-b-10">@yield('page-title')</h4>
                        </div>
                        <ul class="breadcrumb">
                            @yield('breadcrumb')
                        </ul>
                    </div>
                    <div class="col">
                        @yield('action-btn')
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
        <div class="chat-box">
            <div class="chat-box-header" onclick="showHide()">
                <h3>Chat Bot</h3>
            </div>
            @php
                $chat_logs = \App\Models\ChatGptLog::where('employee_id', \Auth::id())->where('type', 1)->get()
            @endphp
            <div class="chat-box-mess" id="chat-box-mess">
                @if($chat_logs)
                    @foreach ($chat_logs as $chat_log)
                        <div class="chat-box-mess-text-chat">{!! nl2br(e($chat_log->prompt)) !!}</div>
                        <div class="chat-box-mess-text">{!! nl2br(e($chat_log->response)) !!}</div>
                    @endforeach
                @endif
                {{-- <div class="chat-box-mess-loading" \>
                    <div id="loading-bubble" class="chat-box-mess-text">
                        <div class="spinner">
                            <div class="bounce1"></div>
                            <div class="bounce2"></div>
                            <div class="bounce3"></div>
                        </div>
                    </div>
                </div> --}}


            </div>

            <div class="chat-box-btn-div">
                <div class="chat-box-btn-div-bottom">
                    <form role="form" id="ai_chat" action="{{url('/ai-ask')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <select name="role" id="ai_chat">
                            <option value="0">User</option>
                            <option value="1">System</option>
                        </select>
                        <input type="text" name="chatgpt" id="chatgpt" placeholder="Enter chat here">
                        <button type="submit" class="reset-btn">Submit</button>
                    </form>
                </div>

            </div>

        </div>
    <!-- [ Main Content ] end -->
    </div>
</div>
<div class="modal fade" id="commonModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body">
            </div>
        </div>
    </div>
</div>
<div class="position-fixed top-0 end-0 p-3" style="z-index: 99999">
    <div id="liveToast" class="toast text-white fade" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body"> </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
@include('partials.admin.footer')
@include('Chatify::layouts.footerLinks')
    <script>
        var url_chat = "{{url('/ai-ask')}}";
        $("form#ai_chat").submit(function(){
            event.preventDefault();
            var formData = new FormData(this);
            var messChatDiv = $('.chat-box-mess');
            var chat  = $('<div class="chat-box-mess-text-chat">' +formData.get('chatgpt').replace(/\n/g,'<br />') + '</div>');
            messChatDiv.append(chat);
            var loading = $('<div class="chat-box-mess-loading"><div id="loading-bubble"><div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div></div>')
            messChatDiv.delay(800).queue(function (next) {
                $(this).append(loading);
                next();
                messChatDiv.scrollTop(messChatDiv[0].scrollHeight);
            });
            messChatDiv.scrollTop(messChatDiv[0].scrollHeight);

            $.ajax({
                url: url_chat,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    messChatDiv.delay(800).queue(function (next) {
                        $('.chat-box-mess-loading').remove();
                        if(response.type == 'dark_mode'){
                        window.location.reload();
                        }
                        else if(response.type == 'go_page'){
                            window.location.href = response.url;
                        }

                        var content  = $('<div class="chat-box-mess-text">' +response.content.replace(/\n/g,'<br />') + '</div>');
                        var messDiv = $('.chat-box-mess')
                        messDiv.append(content);
                        messDiv.scrollTop(messDiv[0].scrollHeight);
                        $('#btn_copy').css('background-color', '#2662b6');
                        });
                    
                },
                error: function(xhr, status, error) {
                    return false;
                }
            });
            document.getElementById('ai_chat').reset();;
            return false;
        });
    </script>
    <script>
        function showHide(){
            var messChatDiv = $('.chat-box-mess');
            messChatDiv.scrollTop(messChatDiv[0].scrollHeight);
            if($('.chat-box').hasClass('show_chatbox')){
                $('.chat-box').removeClass('show_chatbox');
                $('.chat-box').addClass('hide_chatbox');
            }else{
                $('.chat-box').addClass('show_chatbox');
                $('.chat-box').removeClass('hide_chatbox');
            }
        }
    </script>
    <script src="{{ asset('js/chatify/utils.js') }}"></script>
    <script src="{{ asset('js/chatify/code.js') }}"></script>

</body>
</html>
