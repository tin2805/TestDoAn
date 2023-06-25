@extends('layouts.base_signin')

@section('head')

@endsection

@section('content')
  <main id="signin" class="content">
    <div class="inContent">
      @if (session('flash_message'))
        <div class="flash_message">
            {{ session("flash_message") }}
        </div>
      @endif
    <div class="sec1">
      <div class="sec1In">
        <div class="sec1In--form">
          <form action="{{ url('/signup')}}" method="POST">

              @csrf
              <div class="input_box">
                <label for="fullname">Full Name</label>
                <input type="text" name="fullname" id="fullname" placeholder="Full Name" value="{{old('fullname')}}">
                @error('fullname')
                <span>{{$message}}</span>
                @enderror
              </div>
              <div class="input_box">
                <label for="user_name">User Name</label>
                <input type="text" name="user_name" id="user_name" placeholder="User Name" value="{{old('user_name')}}">
                @error('user_name')
                <span>{{$message}}</span>
                @enderror
              </div>
              <div class="input_box">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" value="{{old('email')}}">
                @error('email')
                <span>{{$message}}</span>
                @enderror
              </div>
              <div class="input_box">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" placeholder="Phone Number" value="{{old('phone')}}">
                @error('phone')
                <span>{{$message}}</span>
                @enderror
              </div>
              <div class="input_box">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password"value="{{old('password')}}">
                @error('password')
                <span>{{$message}}</span>
                @enderror
              </div>
              <div class="input_box">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                @error('confirm_password')
                <span>{{$message}}</span>
                @enderror
              </div>

              <div class="submit_box">
                <input type="submit" value="Signup">
              </div>
            </form>

            <div class="linkbox">
              <a href="{{ url('/signup') }}">Signup</a>
            </div>

            <hr>

            <div class="linkbox">
              <a href="{{ url('/signin/repass') }}">Forgot Password</a>
            </div>

          </div>

        </div>
      </div>
    </div>
  </main>

@endsection
