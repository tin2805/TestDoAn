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
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Name">
              </div>
              <div class="input_box">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email">
              </div>
              <div class="input_box">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password">
              </div>
              <div class="input_box">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
              </div>

              <div class="submit_box">
                <input type="submit" value="ログイン">
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
