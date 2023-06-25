<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>JSaaSログインページ</title>
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/5179987.js"></script>
  @yield('head')
   <!-- Google tag (gtag.js) -->
   <script async src="https://www.googletagmanager.com/gtag/js?id=G-LKZ50MLG8V"></script>
   <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-LKZ50MLG8V');
    </script>
</head>

<body>
@if(isset($page_data->base_color) && !request()->is('*agent*'))
<style>
#signin.content .inContent {
  background:linear-gradient(180deg, {{ $page_data->base_color }} 0%, {{ $page_data->base_color }} 50%, #fcfcfc 50%, #fcfcfc 100%)!important;
}
.submit_box input {
  background:{{ $page_data->base_color }}!important;
}
</style>
@endif
@if(isset($page_data->logo) && $page_data->logo && !request()->is('*agent*'))
<style>
#signin.content .inContent .sec1In--ttl h1 a img {
  height:100%!important;
}
</style>
@endif

  @yield('header')
  @yield('content')

  <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
