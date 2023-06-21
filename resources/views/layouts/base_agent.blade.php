<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>JSaaS</title>
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/5179987.js"></script>
  @yield('head')
</head>

<body>
  <header class="header">
    <div class="inHeader inHeader_agent">
      <div class="inHeader__ttl">
        <h1><a href="{{ url('/') }}" alt="JSaaS"><img src="{{ asset('/img/logo/title2.svg') }}" alt="ttl"></a></h1>
      </div>
      <div class="inHeader__menu2">
        <div id="" class="inHeader__menu2--item">
          <a href="{{ url('/agent/signin')}}">ログイン</a>
        </div>
      </div>
      </div>
  </header>

  @yield('content')

  <footer class="top-footer">
    <p>Copyright &copy; 2021-2022 JSaaS. All Rights Reserved.</p>
  </footer>

  <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
