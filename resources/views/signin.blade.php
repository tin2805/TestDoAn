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
          <form action="{{ url('/login')}}" method="POST">

              @csrf
              <div class="input_box">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" id="email" placeholder="メールアドレス">
              </div>
              <div class="input_box">
                <label for="passwor">パスワード</label>
                <input type="password" name="password" id="password" placeholder="パスワード">
              </div>

              @if ( request()->is('*non_auth*'))
              <div class="input_box">
                <p style="color:red; font-size:80%;">ログイン出来ませんでした。<br />メールアドレスとパスワードをご確認下さいませ。</p>
              </div>
              @elseif( request()->is('*block*') )
              <div class="input_box">
                <p style="color:red; font-size:80%;">一定回数以上のログインが失敗しました。時間を空けてから再度お試し下さい。</p>
              </div>
              @endif

              <div class="submit_box">
                <input type="submit" value="ログイン">
              </div>
            </form>

            <div class="linkbox">
              <a href="{{ url('/signup') }}">新規会員登録はこちら</a>
            </div>

            <hr>

            <div class="linkbox">
              <a href="{{ url('/signin/repass') }}">パスワードをお忘れの方はこちら</a>
            </div>

          </div>

        </div>
      </div>
    </div>
  </main>

@endsection
