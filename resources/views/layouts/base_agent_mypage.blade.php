<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>JSaaS</title>
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/5179987.js"></script>
  @yield('head')
</head>

<body>
  <header class="header">
    <div class="inHeader inHeader_agent">
      <div class="inHeader__ttl">
        <h1><a href="{{ url('/agent/dashboard') }}" alt="JSaaS"><img src="{{ asset('/img/logo/jsaas_partner_logo_white.svg') }}" alt="ttl"></a></h1>
      </div>
      <div class="inHeader__name">
        <p>@yield('セクション名'){{ @Auth::User()->corp_name }}</p>
      </div>
      {{-- <div class="inHeader__msg">
        <p>※ただいまプレオープン中。随時、新コーナーやコンテンツが拡充されます。<br>※不具合やリクエストなどございましたら、<a href="https://wtup.jp/3GqNbIx" target="_blank">お気軽にご連絡</a>ください。</p>
      </div> --}}
      <div class="inHeader__menu">
        <div class="inHeader__menu--item"><a href="https://tayori.com/q/jsaas-agentfaq"><i class="far fa-question-circle"></i><span>FAQ</span></a></div>
        <div id="user_icon_btn" class="inHeader__menu--item">
          <a href="#"><i class="far fa-user-circle"></i><span>{{ @Auth::User()->manager }}</span>
          </a>
          <div class="user_icon_menu">
            <ul>
              <li>
                <a href="{{ url('/agent/config_management') }}">設定</a>
              </li>
              <li>
                <a href="{{ url('/agent/logout') }}">ログアウト</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div id="menu_btn" class="menu_btn">
        <button>
          <i style="color:#FFFFFF;" class="fas fa-bars open_icon"></i>
          <i style="color:#FFFFFF;" class="fas fa-times close_icon"></i>
        </button>
      </div>
    </div>
  </header>

  <div class="subHeader">
    <ul>
      @yield('subHeader')
    </ul>
  </div>

  <div id="sidebar" class="agent sidebar">
    <div class="inSidebar">
      <nav class="inSidebar__menu">

        @php
          $data = [['url' => 'dashboard', 'icon' => 'fas fa-th-large', 'img' => 'dash.png', 'img_active' => 'dash_active.png', 'text' => 'ダッシュボード', 'target' => false], ['url' => 'customer_management', 'icon' => 'far fa-address-card', 'img' => 'download.png', 'img_active' => 'download_active.png', 'text' => '顧客一覧', 'target' => false],['url' => 'https://jwriteup.notion.site/jwriteup/JSaaS-3ba3d298c1fa4423beb29aeb0cb86dac', 'icon' => 'fa fa-cubes', 'img' => 'dash.png', 'img_active' => 'dash_active.png', 'text' => '販促ツール', 'target' => true] ,['url' => 'sales_management', 'icon' => 'fas fa-money-check', 'img' => 'movie.png', 'img_active' => 'movie_active.png', 'text' => '売上管理', 'target' => false], ['url' => 'config_management', 'icon' => 'fas fa-cog', 'img' => 'setting.png', 'img_active' => 'setting_active.png', 'text' => '設定', 'target' => false]];
        @endphp
        <ul class="inSidebar__menu__list">
           @foreach ($data as $item)
            @if( Auth::User()->special_plan && $item['text'] == "売上管理_" )

            @elseif($item['text'] == "販促ツール")
              <li class="inSidebar__menu__list__item">
                <a class="inSidebar__menu__list__item__header" href="{{$item['url']}}" {{ $item['target'] ? "target='_blank'" : null }}>
                  <i class="{{ $item['icon'] }}"></i>
                  <span>{{ $item['text'] }}</span>
                </a>
              </li>
            @else
            <li class="inSidebar__menu__list__item">
              <a class="inSidebar__menu__list__item__header" href="{{ url('/agent/' . $item['url']) }}" {{ $item['target'] ? "target='_blank'" : null }}>
                <i class="{{ $item['icon'] }} {{ preg_match('/' . $item['url'] . '/', request()->path()) ? 'active' : '' }}"></i>
                <span>{{ $item['text'] }}</span>
              </a>
            </li>
            @endif
          @endforeach 
        </ul>
      </nav>
    </div>
  </div>

  @yield('content')


  <footer class="footer">
    <div class="footer__linkbox linkbox"><a href="{{ url('/agent/dashboard') }}">ダッシュボードへ</a></div>
    <div class="inFooter">
      <p>Copyright &copy; 2021-2022 JSaaS. All Rights Reserved.</p>
    </div>
  </footer>

  <div id="overlay" class="overlay"></div>

  <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
