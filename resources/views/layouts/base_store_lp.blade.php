<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JSaaSストア</title>
    <meta name="viewport" content="width=device-width">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preload" as="style"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
        media="print" onload="this.media='all'" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/5179987.js"></script>
    @yield('head')
</head>

<body class="bl_store">
    <div class="bl_store_allWrap">
        <header class="bl_store_lp_header">
            <div class="bl_store_inner">
                <h1 class="bl_store_lp_headTtl">補助金を活用し、<br class="el_sm">導入することが<br class="el_sm">可能になりました！</h1>
                {{-- <p class="bl_store_lp_headTtl_sub">対象制度：IT導入補助金、ものづくり補助金、<br class="el_sm">事業再構築補助金等</p> --}}
                <?php
                    $tag1 = '';
                    for($i = 0; $i <count($tags_1); $i++){
                        $tag1 = $tag1 . $tags_1[$i] .', ';
                    }
                    $tag1 = rtrim($tag1,', ');

                    $tag2 = '';
                    for($j = 0; $j <count($tags_2); $j++){
                        $tag2 = $tag2 . $tags_2[$j] .', ';
                    }
                    $tag2 = rtrim($tag2,', ');
                ?>
                <p class="bl_store_lp_headTtl_sub">対象制度：{{$tag1}} 
                {{-- @if($tag2)<br class="el_sm">, {{$tag2}}</p>@endif --}}
            </div>
        </header>

        <main class="bl_store_main">
            @yield('content')
        </main>

        <footer class="bl_store_lp_footer">
            <div class="bl_store_inner">
                <ul class="bl_store_lp_footer_list">
                    <li class="bl_store_lp_footer_list_item">
                        <a class="bl_store_lp_footer_list_item_link" href="https://writeup-lab.sakura.ne.jp/writeup-lab/jsaas_store_tos.pdf" target="_blank">
                            利用規約
                        </a>
                    </li>
                    <li class="bl_store_lp_footer_list_item">
                        <a class="bl_store_lp_footer_list_item_link" href="https://www.writeup.jp/privacy/ " target="_blank">
                            プライバシーポリシー
                        </a>
                    </li>
                </ul>
                <small class="bl_store_lp_footer_copyright">&copy; 2023 JSaaSストア All Rights Reserved.</small>
            </div>
        </footer>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>

</html>
