<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @php
            $arrSort = [
                'popular' => '人気順',
                'recommend' => 'おすすめ順',
                'new' => '新着順',
                'price_up' => '価格の高い順',
                'price_down' => '価格の低い順'
            ]
        @endphp
        @if (request()->route()->getName() == 'store.show')
            JSaaSストア｜{{request()->keyword }}{{request()->m_s_cate ? '・' : ''}} {{implode(',', request()->m_s_cate ?? [])}} ({{ request()->sort ? $arrSort[request()->sort] : 'おすすめ順'}})   補助金対応サービス一覧
        @else
            @yield('meta_title')｜JSaaSストア
        @endif
    </title>

    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keywords')">
    <meta name="viewport" content="width=device-width">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preload" as="style"
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&family=Poppins:wght@400;600;700&display=swap" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&family=Poppins:wght@400;600;700&display=swap"
        media="print" onload="this.media='all'" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/5179987.js"></script>
    @yield('head')
</head>
@php
    $isLp3Cart = request()->lp == '3' && \Route::currentRouteName() == 'store.cart' ? true : false;
    $url = URL::previous();
    $urlContainsLp3 = \Cookie::get('has_lp') == '3' ? true : false;
@endphp
<body class="bl_store">
    <div class="bl_store_allWrap">
    @if(@!request()->query()['lp'] && @request()->query()['lp'] != 3 && !$urlContainsLp3)
        <header class="bl_store_header">
            <article class="bl_store_header_top">
                <div class="bl_store_inner">
                    <div class="bl_store_header_top_inner">
                        <h1 class="bl_store_header_top_logo">
                            <a class="bl_store_header_top_logo_link" href="{{ route('store.index') }}">
                                <img class="bl_store_header_top_logo_link_img"
                                    src="{{ asset('/img/page/store/logo.svg') }}" alt="JSaaSストア">
                            </a>
                            <span class="bl_store_header_top_logo_ttl">{{setting('site.store_top_tll') ?? ''}}</span>
                        </h1>
                        <div class="bl_store_header_top_sub">
                            <ul class="bl_store_header_top_sub_nav">
                                <li class="bl_store_header_top_sub_nav_item">
                                    <a class="bl_store_header_top_sub_nav_item_link" href="/storelp/post/">
                                        <img class="bl_store_header_top_sub_nav_item_link_img"
                                            src="{{ asset('/img/page/store/icon_bookmarks.svg') }}" alt="">
                                        <span class="bl_store_header_top_sub_nav_item_link_txt">掲載希望</span>
                                    </a>
                                </li>
                                <li class="bl_store_header_top_sub_nav_item">
                                    <a class="bl_store_header_top_sub_nav_item_link" href="/store/signup">
                                        <img class="bl_store_header_top_sub_nav_item_link_img"
                                            src="{{ asset('/img/page/store/icon_review.svg') }}" width="15" alt="">
                                        <span class="bl_store_header_top_sub_nav_item_link_txt">審査フォーム</span>
                                    </a>
                                </li>
                                <li class="bl_store_header_top_sub_nav_item">
                                    <a class="bl_store_header_top_sub_nav_item_link"
                                        href="https://jsaas.jp/store/information/detail/110">
                                        <img class="bl_store_header_top_sub_nav_item_link_img"
                                            src="{{ asset('/img/page/store/icon_building.svg') }}" alt="">
                                        <span class="bl_store_header_top_sub_nav_item_link_txt">運営会社</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="bl_store_header_top_sub_act">
                                <a class="bl_store_header_top_sub_act_link" href="{{ route('login') }}">
                                    <img class="bl_store_header_top_sub_nav_item_link_img"
                                        src="{{ asset('/img/page/store/icon_user.svg') }}" alt="">
                                </a>
                                <a class="bl_store_header_top_sub_act_link" href="{{ route('store.cart') }}">
                                    <img class="bl_store_header_top_sub_nav_item_link_img"
                                        src="{{ asset('/img/page/store/icon_cart.svg') }}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <nav class="bl_store_header_nav">
                <div class="bl_store_inner">
                    <ul class="bl_store_header_nav_list">
                        <li class="bl_store_header_nav_list_item">
                            <a class="bl_store_header_nav_list_item_link"
                                href="https://note.com/w_story/n/n7637861413b9" target="_blank">
                                本サイトとは？
                            </a>
                        </li>
                        <li class="bl_store_header_nav_list_item">
                            <span class="bl_store_header_nav_list_item_link el_hidden">
                                対象経費別
                            </span>
                        </li>
                        <li class="bl_store_header_nav_list_item">
                            <a class="bl_store_header_nav_list_item_link" href="{{ route('store.specialEdition') }}">
                                特集記事
                            </a>
                        </li>
                        <li class="bl_store_header_nav_list_item">
                            <a class="bl_store_header_nav_list_item_link" href="{{ route('store.seminarList') }}">
                                セミナー視聴
                            </a>
                            {{-- <ul class="bl_store_header_nav_list_item_child js_navAccordion_target">
                                <li class="bl_store_header_nav_list_item_child_item">
                                    <a class="bl_store_header_nav_list_item_child_item_link" href="#">
                                        買いたい
                                    </a>
                                </li>
                                <li class="bl_store_header_nav_list_item_child_item">
                                    <a class="bl_store_header_nav_list_item_child_item_link" href="#">
                                        広めたい
                                    </a>
                                </li>
                                <li class="bl_store_header_nav_list_item_child_item">
                                    <a class="bl_store_header_nav_list_item_child_item_link" href="#">
                                        掲載したい
                                    </a>
                                </li>
                            </ul> --}}
                        </li>
                        <li class="bl_store_header_nav_list_item">
                            <a class="bl_store_header_nav_list_item_link" target="_blank"
                                href="https://jwriteup.notion.site/JSaaS-98a9d5f831644f41824708461db74964">
                                FAQ・お問い合わせ
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
    @endif
        <main class="bl_store_main {{ $isLp3Cart ? 'bl_store_main_lp3' : ''}}">
            @yield('breadcrumb_lp3')
            @yield('content')
        </main>

        @if (!$isLp3Cart && !$urlContainsLp3)
            <div class="bl_store_footer_onLink">
                <div class="bl_store_inner">
                    <a class="bl_store_footer_onLink_item"
                        href="https://writeup-5179987.hs-sites.com/jsaasstore_mailsubscribe" target="_blank"><i
                            class="fas fa-envelope" style="margin-right: 3px"></i>最新情報送付希望の方はこちら</a>
                </div>
            </div>
            <footer class="bl_store_footer">
                <div class="bl_store_inner">
                    <div class="bl_store_footer_col">
                        <div class="bl_store_footer_col_top">
                            <h1 class="bl_store_footer_col_top_logo">
                                <a class="bl_store_footer_col_top_logo_link" href="{{ url('/store') }}">
                                    <img class="bl_store_footer_col_top_logo_link_img"
                                        src="{{ asset('/img/page/store/logo_white.svg') }}" alt="JSaaSストア">
                                </a>
                            </h1>
                            <ul class="bl_store_footer_col_top_nav">
                                <li class="bl_store_footer_col_top_nav_item">
                                    <a class="bl_store_footer_col_top_nav_item_link" href="/storelp/post/">
                                        <img class="bl_store_footer_col_top_nav_item_link_img"
                                            src="{{ asset('/img/page/store/icon_bookmarks_white.svg') }}" alt="">
                                        <span class="bl_store_footer_col_top_nav_item_link_txt">掲載希望</span>
                                    </a>
                                </li>
                                <li class="bl_store_footer_col_top_nav_item">
                                    <a class="bl_store_footer_col_top_nav_item_link" href="{{ route('store.signup') }}">
                                        <img class="bl_store_footer_col_top_nav_item_link_img"
                                            src="{{ asset('/img/page/store/icon_review_white.svg') }}" width="15" alt="">
                                        <span class="bl_store_footer_col_top_nav_item_link_txt">審査フォーム</span>
                                    </a>
                                </li>
                                <li class="bl_store_footer_col_top_nav_item">
                                    <a class="bl_store_footer_col_top_nav_item_link"
                                        href="https://jsaas.jp/store/information/detail/110">
                                        <img class="bl_store_footer_col_top_nav_item_link_img"
                                            src="{{ asset('/img/page/store/icon_building_white.svg') }}" alt="">
                                        <span class="bl_store_footer_col_top_nav_item_link_txt">運営会社</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <nav class="bl_store_footer_col_nav">
                            <ul class="bl_store_footer_col_nav_list">
                                <li class="bl_store_footer_col_nav_list_item">
                                    <a class="bl_store_footer_col_nav_list_item_link"
                                        href="https://note.com/w_story/n/n7637861413b9" target="_blank">
                                        本サイトとは？
                                    </a>
                                </li>
                                <li class="bl_store_footer_col_nav_list_item">
                                    <span class="bl_store_footer_col_nav_list_item_link el_hidden">
                                        対象経費別
                                    </span>
                                </li>
                                <li class="bl_store_footer_col_nav_list_item">
                                    <a class="bl_store_footer_col_nav_list_item_link"
                                        href="{{ route('store.specialEdition') }}">
                                        特集記事
                                    </a>
                                </li>
                            </ul>
                            <ul class="bl_store_footer_col_nav_list">
                                <li class="bl_store_footer_col_nav_list_item">
                                    カテゴリ別
                                    <ul class="bl_store_footer_col_nav_list_item_child">
                                        <li class="bl_store_footer_col_nav_list_item_child_item">
                                            <a class="bl_store_footer_col_nav_list_item_child_item_link"
                                                href="{{ route('store.show') }}?s=m_cate&keyword={{ urlencode('設備投資') }}">
                                                設備投資
                                            </a>
                                        </li>
                                        <li class="bl_store_footer_col_nav_list_item_child_item">
                                            <a class="bl_store_footer_col_nav_list_item_child_item_link"
                                                href="{{ route('store.show') }}?s=m_cate&keyword={{ urlencode('システム開発') }}">
                                                システム開発
                                            </a>
                                        </li>
                                        <li class="bl_store_footer_col_nav_list_item_child_item">
                                            <a class="bl_store_footer_col_nav_list_item_child_item_link"
                                                href="{{ route('store.show') }}?s=m_cate&keyword={{ urlencode('ITツール') }}">
                                                ITツール
                                            </a>
                                        </li>
                                        <li class="bl_store_footer_col_nav_list_item_child_item">
                                            <a class="bl_store_footer_col_nav_list_item_child_item_link"
                                                href="{{ route('store.show') }}?s=m_cate&keyword={{ urlencode('人材・研修') }}">
                                                人材・研修
                                            </a>
                                        </li>
                                        <li class="bl_store_footer_col_nav_list_item_child_item">
                                            <a class="bl_store_footer_col_nav_list_item_child_item_link"
                                                href="{{ route('store.show') }}?s=m_cate&keyword={{ urlencode('広告・販促') }}">
                                                広告・販促
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="bl_store_footer_col_nav_list">
                                <li class="bl_store_footer_col_nav_list_item">
                                    <a class="bl_store_footer_col_nav_list_item_link" href="{{ url('/signup') }}">
                                        会員登録
                                    </a>
                                </li>
                                <li class="bl_store_footer_col_nav_list_item">
                                    <a class="bl_store_footer_col_nav_list_item_link" href="{{ route('login') }}">
                                        ログイン
                                    </a>
                                </li>
                            </ul>
                            <ul class="bl_store_footer_col_nav_list">
                                <li class="bl_store_footer_col_nav_list_item">
                                    <a class="bl_store_footer_col_nav_list_item_link"
                                        href="https://jwriteup.notion.site/JSaaS-98a9d5f831644f41824708461db74964"
                                        target="_blank">
                                        FAQ・お問い合わせ
                                    </a>
                                </li>
                                <li class="bl_store_footer_col_nav_list_item">
                                    <a class="bl_store_footer_col_nav_list_item_link"
                                        href="https://www.writeup.jp/privacy/ " target="_blank">
                                        プライバシーポリシー
                                    </a>
                                </li>
                                <li class="bl_store_footer_col_nav_list_item">
                                    <a class="bl_store_footer_col_nav_list_item_link"
                                        href="https://writeup-lab.sakura.ne.jp/writeup-lab/jsaas_store_tos.pdf"
                                        target="_blank">
                                        利用規約
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <small class="bl_store_footer_copyright">&copy; 2023 JSaaSストア All Rights Reserved.</small>
                </div>
            </footer>
        @endif

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(function(){
        //クリックで動く
        $('.js_navAccordion').click(function(){
            $(this).toggleClass('el_active');
            $(this).next('.js_navAccordion_target').slideToggle();
        });
        });
    </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-3Y8636JRZ0"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-3Y8636JRZ0');
    </script>
    <!-- Start of HubSpot Embed Code -->
    <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/5179987.js"></script>
    <!-- End of HubSpot Embed Code -->
    @yield('script')
</body>

</html>
