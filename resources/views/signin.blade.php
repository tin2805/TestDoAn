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
          <form action="{{ url('/signin')}}" method="POST">

              @csrf
              <div class="input_box">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email">
              </div>
              <div class="input_box">
                <label for="passwor">Password</label>
                <input type="password" name="password" id="password" placeholder="Password">
              </div>

              <div class="submit_box">
                <input type="submit" value="Login">
              </div>
            </form>

            <div class="linkbox">
              <a href="{{ url('/signup') }}">Signup</a>
            </div>

            <hr>

            <div class="linkbox">
              <a href="{{ url('/signin/repass') }}">Forget Password</a>
            </div>

          </div>

        </div>
      </div>
    </div>
  </main>

@endsection
