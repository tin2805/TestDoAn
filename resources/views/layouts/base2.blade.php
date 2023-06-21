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
@php
  $page_data = App\Models\JmAgent::get_page_data_no_auth( $pid );
@endphp
@if(isset($page_data->base_color))
<style>
.header .inHeader {
  background:{{ $page_data->base_color }}!important;
}
.submit_box2 input {
  background:{{ $page_data->base_color }}!important;
}
</style>
@endif
  <header class="header">
    <div class="inHeader">
      <div class="inHeader__ttl">
        <h1>
          @if (isset($page_data->logo) && $page_data->logo)
            @if( $page_data->logo_margin)
            <a href="{{ url('/home/dashboard') }}" alt="JSaaS"><img class="hasMargin" src="{{ Storage::disk('local')->url($page_data->logo) }}" alt="ttl" style="width: {{ $page_data->logo_width }}px"></a>
            @else
            <a href="{{ url('/home/dashboard') }}" alt="JSaaS"><img src="{{ Storage::disk('local')->url($page_data->logo) }}" alt="ttl" style="width: {{ $page_data->logo_width }}px"></a>
            @endif
          @else
          <a href="{{ url('/') }}" alt="JSaaS"><img src="{{ asset('/img/logo/title2.svg') }}" alt="ttl"></a>
          @endif
        </h1>
      </div>
      <div class="inHeader__menu2">
        <div id="" class="inHeader__menu2--item">
          <a href="{{ url('/signin')}}"><img class="person_icon" src="{{ asset('/img/person_icon.png') }}" alt="person">ログイン</a>
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
