<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>JSaaS @yield('title')</title>
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/5179987.js"></script>
  @yield('head')
</head>

<body id="top">
  <header class="top-header">
    <div class="top-inHeader">
      <div id="top-menu_btn" class="top-menu_btn">
        <span></span><span></span><span></span>
      </div>
      <div class="top-inHeader__ttl">
        <h1><a href="{{ url('/') }}" alt="JSaaS"><img src="{{ asset('/img/logo/title.svg') }}" alt="ttl"></a></h1>
      </div>
      <nav class="top-inHeader__menu">
        <ul>
          <li>
            <a href="{{ url('/') }}">サービス紹介</a>
          </li>
          <li>
            <a href="{{ url('/') }}">ご利用の流れ</a>
          </li>
          <li>
            <a href="{{ url('/') }}">よくある質問</a>
          </li>
          <li>
            <a href="{{ url('/') }}">お問い合わせ</a>
          </li>
        </ul>
      </nav>
      <div class="top-inHeader__menu2">
        <ul>
          <li>
            <a href="{{ url('/') }}">ログイン</a>
          </li>
          <li>
            <a href="{{ url('/') }}" class="mark04">お申し込み</a>
          </li>
        </ul>
      </div>
    </div>
  </header>

  <div id="top-drawer" class="top-drawer">
    <nav class="top-drawer__menu">
      <h3>MENU</h3>
      <ul>
        <li>
          <a href="{{ url('/') }}">サービス紹介</a>
        </li>
        <li>
          <a href="{{ url('/') }}">ご利用の流れ</a>
        </li>
        <li>
          <a href="{{ url('/') }}">よくある質問</a>
        </li>
        <li>
          <a href="{{ url('/') }}">お問い合わせ</a>
        </li>
      </ul>
    </nav>
  </div>

  @yield('content')

  <footer class="top-footer">
    <p>Copyright &copy; 2021-2022 JSaaS. All Rights Reserved.</p>
  </footer>

  <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
