@extends('layouts.base_signin')
@section('page-title')
    {{__('Register')}}
@endsection
@php
  //  $logo=asset(Storage::url('uploads/logo/'));
$logo=''
@endphp
@push('custom-scripts')
    @if(env('RECAPTCHA_MODULE') == 'on')
        {!! NoCaptcha::renderJs() !!}
    @endif
@endpush
@section('auth-topbar')
    <li class="nav-item ">
        {{-- <select class="btn btn-primary my-1 me-2 " onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" id="language">
            @foreach(Utility::languages() as $language)
                <option class="" @if($lang == $language) selected @endif value="{{ route('register',$language) }}">{{Str::upper($language)}}</option>
            @endforeach
        </select> --}}
    </li>
@endsection
@section('content')
    <div class="">
        <h2 class="mb-3 f-w-600">{{__('Register')}}</h2>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @if (session('status'))
            <div class="mb-4 font-medium text-lg text-green-600 text-danger">
                {{ __('Email SMTP settings does not configured so please contact to your site admin.') }}
            </div>
        @endif
        @csrf
        <div class="">
            <div class="form-group mb-3">
                <label for="fullname" class="form-label">{{__('Full Name')}}</label>
                <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}" required autocomplete="fullname" autofocus>
                @error('fullname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="user_name" class="form-label">{{__('User Name')}}</label>
                <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}" required autocomplete="user_name" autofocus>
                @error('user_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="phone" class="form-label">{{__('Phone Number')}}</label>
                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="email" class="form-label">{{__('Email')}}</label>
                <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
                <div class="invalid-feedback">
                    {{__('Please fill in your email')}}
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label">{{__('Password')}}</label>
                <input id="password" type="password" data-indicator="pwindicator" class="form-control pwstrength @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
                <div id="pwindicator" class="pwindicator">
                    <div class="bar"></div>
                    <div class="label"></div>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="confirm_password" class="form-label">{{__('Password Confirmation')}}</label>
                <input id="confirm_password" type="password" data-indicator="confirm_password" class="form-control pwstrength @error('confirm_password') is-invalid @enderror" name="confirm_password" required autocomplete="new-password">
                @error('confirm_password')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
                <div id="confirm_password" class="pwindicator">
                    <div class="bar"></div>
                    <div class="label"></div>
                </div>
            </div>
            @if(env('RECAPTCHA_MODULE') == 'on')
                <div class="form-group mb-3">
                    {!! NoCaptcha::display() !!}
                    @error('g-recaptcha-response')
                    <span class="small text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            @endif

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-block mt-2">{{__('Register')}}</button>
            </div>

        </div>
        <p class="my-4 text-center">{{__("Already' have an account?")}} <a href="{{ route('login',!empty(\Auth::user()->lang)?\Auth::user()->lang:'en') }}" class="text-primary">{{__('Login')}}</a></p>

    </form>
@endsection
