<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>JSaaS</title>
  <meta name="viewport" content="width=device-width">
  @if ((Request::is('*/document/*') || Request::is('*/movie/*')) && !empty($thumb))
  <meta name="twitter:card" content="summary_large_image">
  <meta property="og:title" content="{{ $title }}" />
  <meta name="twitter:title" content="{{ $title }}">
  <meta property="og:image" content="{{ asset('/storage/' . $thumb) }}" />
  <meta name="twitter:image" content="{{ asset('/storage/' . $thumb) }}">
  @endif
  @if (!Auth::check() && Route::currentRouteName() == 'newBusiness.detail')
  <meta name="googlebot" content="noindex">
  @endif
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="http://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/5179987.js"></script>

    <!-- font -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preload" as="style"
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600&display=swap" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600&display=swap"
        media="print" onload="this.media='all'" />
    @yield('head')
  <style>
    .sidebar .inSidebar__menu__list__item__header:hover {
      color: #000;
      background-color: #e8ebee;
    }

    .sidebar .inSidebar__menu__list__item__header.el_open {
      color: #000;
      background-color: rgb(93 140 210 / 50%);
       !important: ;
    }


    .sidebar .inSidebar__menu__list__item__header.el_open i {
      color: #7b7e82;
    }

    .sidebar .inSidebar__menu__list__item__header.el_open.el_hasInner::after {
      transform: translateY(-50%) rotate(0deg);
      background-color: #7b7e82;
    }

    .sidebar .inSidebar__menu__list__item__header:hover {
      background-color: rgb(93 140 210 / 70%);
       !important;
    }
    .hidden {
      display: none !important;
    }
  </style>

   <!-- Google tag (gtag.js) -->
   <script async src="https://www.googletagmanager.com/gtag/js?id=G-LKZ50MLG8V"></script>
   <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-LKZ50MLG8V');
    </script>

</head>
@php
if (Auth::check()) {
    $page_data = App\Models\JmAgent::get_page_data_auth();
    $agent_intro = App\Models\JmAgentIntro::where('customer_id', Auth::User()->id)->first();
    $agent = [];
    if ($agent_intro) {
        $agent = App\Models\JmAgent::where('id', $agent_intro->agent_id)->first();
    }
}

@endphp

<body>
  @if(\Auth::check())
  <header class="header">

    <div class="inHeader" style="background:{{ $page_data->base_color ?? '' }}">
      <div class="inHeader__ttl">
        <h1>
          @if (isset($page_data->logo) && $page_data->logo)
            @if ($page_data->logo_margin)
              <a href="{{ route('home.dashboard') }}" alt="JSaaS"><img class="hasMargin"
                  src="{{ Storage::disk('local')->url($page_data->logo) }}" alt="ttl"
                  style="width: {{ $page_data->logo_width }}px"></a>
            @else
              <a href="{{ route('home.dashboard') }}" alt="JSaaS"><img
                  src="{{ Storage::disk('local')->url($page_data->logo) }}" alt="ttl"
                  style="width: {{ $page_data->logo_width }}px"></a>
            @endif
          @else
            <a href="{{ route('home.dashboard') }}" alt="JSaaS"><img src="{{ asset('/img/logo/title2.svg') }}"
                alt="JSaaS"></a>
          @endif
        </h1>
      </div>
      <div class="inHeader__name">
        <p>@yield('セクション名'){{ @Auth::User()->corp_name }}</p>
      </div>
      <div class="inHeader__menu">
        @if (Auth::check())
          <div class="inHeader__menu--item">
            <a target="_blank" href="https://tayori.com/faq/d86853b9838ac24ac5f627442e21c7fbe863820f/detail/4414b1d710c0018e7bd632448e39041ffd31b53f/">
              <img class="bl_headerIcon" src="{{ asset('img/page/common/icon_beginner.svg') }}" alt="">
              <span>使い方</span>
            </a>
          </div>
          <div class="inHeader__menu--item">
            <a target="_blank" href="https://tayori.com/faq/d86853b9838ac24ac5f627442e21c7fbe863820f/">
              <i class="far fa-question-circle"></i>
              <span>FAQ</span>
            </a>
          </div>
          <div id="user_icon_btn" class="inHeader__menu--item">
            <a href="#">
              <i class="far fa-user-circle"></i>
              <span>{{ @Auth::User()->manager }}</span>
            </a>
            <div class="user_icon_menu">
              <ul>
                <li>
                  <a href="{{ route('home.setting') }}">設定</a>
                </li>
                <li>
                  <a href="{{ route('home.logout') }}">ログアウト</a>
                </li>
              </ul>
            </div>
          </div>
        @endif
      </div>
      <div id="menu_btn" class="menu_btn">
        <button>
          <i style="color:#FFFFFF;" class="fas fa-bars open_icon"></i>
          <i style="color:#FFFFFF;" class="fas fa-times close_icon"></i>
        </button>
      </div>
    </div>
  </header>
  @endif
  <div class="subHeader">
    <ul>
      @yield('subHeader')
    </ul>
  </div>
  <div id="sidebar" class="sidebar">
    <div class="inSidebar">
      {{-- <nav class="inSidebar__menu">
        <ul class="inSidebar__menu__list">

          @php
            $data = [];
            if(menu('会員メニュー', '_json')){
                $data = menu('会員メニュー', '_json')->toArray();
            }

            $queryString = request()->getQueryString();
            $path = request()->path();
            if($queryString){
                $path .= '?'.$queryString;
            }

          @endphp

          @foreach ($data as $item)

            @if ( !isset($agent['roll_customer']) || (isset($agent['roll_customer']) && !str_contains($agent['roll_customer'], $item['param_roll_customer'])) || $item['param_roll_customer'] == null)
                <li
                class="inSidebar__menu__list__item {{ count($item['children']) > 0 ? 'js_accordion' : '' }} @if (count($item['children']) == 0 ) {{ $item['url']  == '/'.$path ? 'el_active' : '' }} @endif">
                @if (count($item['children']) == 0 )
                <a class="inSidebar__menu__list__item__header"
                    @if (Auth::check()) href="{{$item['url'] }}"
                                @else
                                    href="javascript:;" v-on:click="showModal" @endif>
                    <i class="{{ $item['icon_class'] }}"></i>
                    <span>{{ $item['title'] }}</span>
                </a>
                @else
                <div
                    class="js_accordion_header inSidebar__menu__list__item__header el_hasInner {{ str_contains('/'.$path , $item['url'] ) ? 'el_open' : '' }}">
                    <i class="{{ $item['icon_class'] }}"></i>
                    <span>{{ $item['title'] }}</span>
                    @if(Auth::user())
                    @php
                        $unread = Auth::user()->unreadMessConsul();
                    @endphp
                    @if ($item['url'] == 'consul' && isset($unread[1]) && $unread[1] )
                        <span class="unread_message">{{ @array_sum($unread[0]) }}</span>
                    @endif
                    @endif
                </div>

                <ul class="js_accordion_inner"

                    style="display:{{ str_contains('/'.$path , $item['url'] ) ? 'block' : '' }};">
                    @foreach ($item['children'] as $child)
                    @if ( !isset($agent['roll_customer']) || (isset($agent['roll_customer']) && !str_contains($agent['roll_customer'], $child['param_roll_customer'])) || $child['param_roll_customer'] == null)
                        <li>
                            <a @if (isset($child['anchor_tag'])) @if ($child['url']  == '/'.$path)
                                                        style="background-color:#7d8185;color:#FFFFFF;" @endif
                            @elseif($child['url']  == '/'.$path) style="background-color:#7d8185;color:#FFFFFF;"
                            @endif
                            @if (Auth::check() || (!Auth::check() && $child['url'] == 'consultation')) href="{{ $child['url'] }}"
                                                @else

                                                    href="javascript:;" v-on:click="showModal" @endif
                            >
                            <dd class="ac-child">{{ $child['title'] }}</dd>
                            </a>
                        </li>
                    @endif

                    @endforeach
                </ul>
                @endif
            </li>
            @if ($item['title'] == "資料請求")
                <li class="inSidebar__menu__list__item @if('/'.$path == '/home/store/list') el_active @endif">
                  <a href="{{url('home/store/list')}}" class="inSidebar__menu__list__item__header"><i class="fas fa-store-alt"></i>JSaaSストア設定</a>
                </li>
            @endif
            @endif

          @endforeach


        </ul>
      </nav> --}}
      @php
            $path = request()->path();

      @endphp
      @if(\Auth::check())
      <nav class="inSidebar__menu">
        <ul class="inSidebar__menu__list">
          <li
          class="inSidebar__menu__list__item @if('/'.$path == '/home/dashboard') el_active @endif">
          <a class="inSidebar__menu__list__item__header" href="{{url('home/dashboard')}}">
              <i class="fas fa-th-large"></i>
              <span>ダッシュボード</span>
          </a>
          </li>
          <li class="inSidebar__menu__list__item js_accordion">
            <div
                class="js_accordion_header inSidebar__menu__list__item__header el_hasInner @if($path == 'home/document' || $path == 'home/movie' || $path == 'home/consultation') el_open @endif">
                <i class="fas fa-file-alt"></i>
                <span>補助金申請をする</span>
            </div>
            <ul class="js_accordion_inner" @if($path == 'home/document' || $path == 'home/movie' || $path == 'home/consultation' || $path == 'new-business/create') style="display: block;background-color: #dae5f9" @endif>
              <li class="child">
                <a href="{{url('home/document')}}" class="inSidebar__menu__list__item__header">資料ダウンロード</a>
              </li>
              <li class="child">
                <a href="{{url('home/movie')}}" class="inSidebar__menu__list__item__header">ノウハウ動画</a>
              </li>

              @if (@Auth::user()->batonz_id)
                <li class="child">
                    <a  href="javascript:;"   v-on:click="showModalBatonz" class="inSidebar__menu__list__item__header ">専門家相談</a>
                </li>
              @else
                <li class="child">
                    <a  href="{{ url('home/consultation')}}" class="inSidebar__menu__list__item__header ">専門家相談</a>
                </li>


              @endif

              <li class="child ">
                <a href="{{url('new-business/create')}}" class="inSidebar__menu__list__item__header">事業計画書作成</a>
              </li>
            </ul>
          </li>

          <li class="inSidebar__menu__list__item js_accordion">
            <div
                class="js_accordion_header inSidebar__menu__list__item__header el_hasInner @if($path == 'home/setting/info/edit' || $path == 'home/diagnose') el_open @endif">
                <i class="fas fa-search"></i>
                <span>制度を調べる</span>
            </div>
            <ul class="js_accordion_inner" @if($path == 'home/setting/info/edit' || $path == 'home/diagnose') style="display: block;background-color: #dae5f9" @endif>
              <li class="child hidden">
                <a href="child" class="inSidebar__menu__list__item__header">おすすめ補助金</a>
              </li>
              <li class="child">
                <a href="{{url('home/setting/info/edit?page=info')}}" class="inSidebar__menu__list__item__header">自動マッチング</a>
              </li>
              @if (@!Auth::user()->batonz_id )
                <li class="child">
                    <a href="{{url('home/diagnose')}}" class="inSidebar__menu__list__item__header">検索</a>
                </li>
              @endif

            </ul>
          </li>

          <li class="inSidebar__menu__list__item js_accordion">
            <div
                class="js_accordion_header inSidebar__menu__list__item__header el_hasInner">
                <i class="fas fa-th-list"></i>
                <span>対象サービス一覧</span>
            </div>
            <ul class="js_accordion_inner" @if($path == 'store' ||$path == 'demand?') style="display: block;background-color: #dae5f9" @endif>
              <li class="child">
                {{-- <a href="{{url('store')}}" class="inSidebar__menu__list__item__header">JSaaSストアー</a> --}}
                <a href="{{url('store')}}" class="inSidebar__menu__list__item__header">JSaaSストア</a>
              </li>
              <li class="child">
                <a href="{{url('demand?')}}" class="inSidebar__menu__list__item__header">資料ライブラリ</a>
              </li>
            </ul>
          </li>

          <li class="inSidebar__menu__list__item js_accordion">
            <div
                class="js_accordion_header inSidebar__menu__list__item__header el_hasInner @if($path == 'store/signup' || $path == 'home/demand/create') el_open @endif">
                <i class="fas fa-hands-helping"></i>
                <span>ビジネスマッチング</span>
            </div>
            <ul class="js_accordion_inner" @if($path == 'home/store' || $path == 'home/demand/create') style="display: block;background-color: #dae5f9" @endif>
              <li class="child">
                <a href="{{url('home/store')}}" class="inSidebar__menu__list__item__header">ストア掲載</a>
              </li>
              <li class="child">
                <a href="{{url('home/demand/create?pid=')}}" class="inSidebar__menu__list__item__header">ライブラリ掲載</a>
              </li>
            </ul>
          </li>

          <li class="inSidebar__menu__list__item js_accordion">
            <div
                class="js_accordion_header inSidebar__menu__list__item__header el_hasInner @if($path == 'home/setting') el_open @endif">
                <i class="fas fa-cog"></i>
                <span>企業情報設定</span>
            </div>
            <ul class="js_accordion_inner" @if($path == 'home/setting') style="display: block;background-color: #dae5f9" @endif>
              <li class="child hidden">
                <a href="" class="inSidebar__menu__list__item__header">ポイント管理</a>
              </li>
              <li class="child hidden">
                <a href="" class="inSidebar__menu__list__item__header">報酬金額確認</a>
              </li>
              <li class="child">
                <a href="{{url('home/setting?page=default')}}" class="inSidebar__menu__list__item__header">登録情報</a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      @endif
    </div>
    <modal
    name="modal-batonz-area"
    :width="'525px'"
    :height="'310px'"
    class="batonz__modal"
    >
        <div class="modal-area-inner">
            <span class="hide"  v-on:click="hideModalBatonz" >
            <span class="demandPublic__modal__inner__hide__cross"></span>閉じる</span>
            <div class="modal-area-inner-content">

                <h2>補助金や助成金の申請について、 B CASS <br>のチャットから顧問への相談が可能です。</h2>
                <span>
                    ※チャット画面に遷移します
                </span>
                <div class="batonz__btnCol">
                    <a href="https://batonz.jp/user/portal/consultation_request" class="mark04">専門家に相談する</a>
                </div>

            </div>
        </div>
    </modal>
  </div>

  @yield('content')

  <footer class="footer" id="footer">
    @if (url()->current() != url('/home/demand/create') && url()->current() != url('/home/demand')&& url()->current() != url('/home/demand/list') && url()->current() != url('/home/store') && url()->current() != url('/home/store/list'))
    <div class="footer__linkbox linkbox">
        @if (url()->current() != url('/home/dashboard'))
            <a
            @if (Auth::check())
              @if (url()->current() == url('/home/setting/financial_report'))
                  href="{{ url('/home/setting') }}"
              @else
                  href="{{ url('/home/dashboard') }}"
              @endif
            @else
                href="javascript:;" v-on:click="showModal" @endif>{{url()->current() == url('/home/setting/financial_report') ? '続けて決算書をアップロードする' : 'ダッシュボードへ'}}</a>
        @endif
    </div>
    @endif
    <div class="inFooter">
      <p>Copyright &copy; 2021-2022 JSaaS. All Rights Reserved.</p>
    </div>
  </footer>

  <div id="overlay" class="overlay"></div>

  <script src="{{ asset('js/app.js') }}"></script>

  <script>
    /**
     *  初回アクセスのみアコーディオンを実行するようにセッションで制御
     */
    let $sidebar = $('.sidebar');
    if ($sidebar) {
      let el_once_done = window.sessionStorage.getItem('el_once_done');

      if (el_once_done) {
        $sidebar.removeClass('el_once');
      } else {
        $sidebar.addClass('el_once');
      }
    }


    setTimeout(function() {
      if ($(".sidebar").hasClass("el_once")) {
        $(".js_accordion .js_accordion_inner").slideUp();
        $(".js_accordion .js_accordion_header").removeClass("el_open");
      }
      // 1秒（1000ms）後に処理
      window.sessionStorage.setItem('el_once_done', true);
    }, 1000);
    $(function() {


      //.js_accordionの中の.js_accordion_headerがクリックされたら
      $(".js_accordion .js_accordion_header").click(function() {
        //クリックされた.js_accordionの中の.js_accordion_headerに隣接する.js_accordion_innerが開いたり閉じたりする。
        $(this).next(".js_accordion_inner").slideToggle();
        $(this).toggleClass("el_open");
        //クリックされた.js_accordionの中の.js_accordion_header以外の.js_accordionの中の.js_accordion_headerに隣接する.js_accordionの中の.js_accordion_innerを閉じる
        $(".js_accordion .js_accordion_header").not($(this)).next(
          ".js_accordion .js_accordion_inner").slideUp();
        $(".js_accordion .js_accordion_header").not($(this)).removeClass("el_open");
        $(".js_accordion .js_accordion_header.stay").not($(this)).toggleClass("el_open");
      });
    });
  </script>
 <script src="https://cdn.jsdelivr.net/npm/vue-js-modal@1.3.28/dist/index.min.js"></script>

  <script>
    Vue.use(window["vue-js-modal"].default);
    new Vue({
      el: '#sidebar',
      data: {
        obj: [],

      },
      mounted: function() {

      },
      methods: {
        showModal: function() {
          var self = this;

          this.$modal.show('modal-area');
        },
        hide: function() {
          this.$modal.hide('modal-area');
        },

        showModalBatonz: function() {
          var self = this;
          this.$modal.show('modal-batonz-area');
        },
        hideModalBatonz: function() {
          this.$modal.hide('modal-batonz-area');
        },

      }
    })
    var footer = new Vue({
      el: '#footer',
      data: {
        obj: [],

      },
      mounted: function() {

      },
      methods: {
        showModal: function() {
          var self = this;

          this.$modal.show('modal-area');
        },
        hide: function() {
          this.$modal.hide('modal-area');
        },

      }
    });
  </script>
  <script>
    var a = document.getElementsByClassName('child');
    console.log(a[10].firstElementChild.href);
    for(var i = 0; i < a.length; i++){
      if(a[i].firstElementChild.href == window.location.href){
          a[i].firstElementChild.style.backgroundColor = '#7d8185';
          a[i].firstElementChild.style.color = '#fff';
      }
    }
  </script>



  @if (isset($page_data->base_color))
    <style>
      .header .inHeader {
        background: {{ $page_data->base_color }} !important;
      }

      .submit_box2 input {
        background: {{ $page_data->base_color }} !important;
      }

      .sidebar .inSidebar__menu ul li a i.active {
        color: {{ $page_data->base_color }} !important;
      }

      .subHeader ul li a.active {
        border-bottom: 3px solid {{ $page_data->base_color }} !important;
        color: {{ $page_data->base_color }} !important;
        pointer-events: none;
      }

      a:hover {
        /* background: {{ $page_data->base_color }}!important; */
      }

      .sec1__blocks--block_head p a {
        color: {{ $page_data->base_color }} !important;
        border: 1px solid {{ $page_data->base_color }} !important;
      }
    </style>
  @endif


  @yield('script')

</body>

</html>
