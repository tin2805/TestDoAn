<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>JSaaS @yield('title')</title>
        <meta name="viewport" content="width=device-width" />
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/5179987.js"></script>
        @yield('head')
    </head>

    <body>
        <div class="allWrap">
            <header class="demandPublic__header">
                <div class="demandPublic__header__inner">
                    <div class="demandPublic__header__inner__ttl">
                        <h1 class="demandPublic__header__inner__ttl__logo">
                            <a
                                class="demandPublic__header__inner__ttl__logo__link"
                                href="{{ url('/') }}"
                                ><img
                                    class="demandPublic__header__inner__ttl__logo__link__img"
                                    src="{{ asset('/img/logo/title2.svg') }}"
                                    alt="JSaaS"
                            /></a>
                        </h1>
                        <p class="demandPublic__header__inner__ttl__txt">
                            資料請求コーナー<br />＜2023年度版＞
                        </p>
                    </div>

                    <div class="demandPublic__header__inner__nav">
                        <ul class="demandPublic__header__inner__nav__list">
                            <li
                                class="demandPublic__header__inner__nav__list__item"
                            >
                                <a
                                    class="demandPublic__header__inner__nav__list__item__btn"
                                    href="{{ route('demand.cart') }}"
                                >
                                    <span
                                        class="demandPublic__header__inner__nav__list__item__btn__icon"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="14"
                                            height="14"
                                            viewBox="0 0 14 14"
                                        >
                                            <path
                                                id="icon_materialinbox"
                                                d="M16.944,4.5H6.048a1.537,1.537,0,0,0-1.54,1.556L4.5,16.944A1.549,1.549,0,0,0,6.048,18.5h10.9A1.56,1.56,0,0,0,18.5,16.944V6.056A1.555,1.555,0,0,0,16.944,4.5Zm0,9.333H13.833a2.333,2.333,0,1,1-4.667,0H6.048V6.056h10.9Z"
                                                transform="translate(-4.5 -4.5)"
                                                fill="#fe5f21"
                                            />
                                        </svg>
                                    </span>
                                    資料請求ボックスを見る</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            @yield('content')

            <footer class="demandPublic__footer">
                <div class="demandPublic__footer__inner">
                    <div class="demandPublic__footer__logo">
                        <a
                            class="demandPublic__footer__logo__link"
                            href="{{ url('/') }}"
                            ><img
                                class="demandPublic__footer__logo__link__img"
                                src="{{ asset('/img/logo/title2.svg') }}"
                                alt="JSaaS"
                        /></a>
                    </div>
                    <ul class="demandPublic__footer__list">
                        <li class="demandPublic__footer__list__item">
                            <a
                                class="demandPublic__footer__list__item__link"
                                href="{{
                                    url('https://www.jmatch.jp/jsaas/contact/')
                                }}"
                            >
                                お問い合わせ
                            </a>
                        </li>
                        <li class="demandPublic__footer__list__item">
                            <a
                                class="demandPublic__footer__list__item__link"
                                href="{{ url('/signin') }}"
                            >
                                ログイン
                            </a>
                        </li>
                        <li class="demandPublic__footer__list__item">
                            <a
                                class="demandPublic__footer__list__item__link"
                                href="{{ url('/signup?pl=0') }}"
                            >
                                新規登録
                            </a>
                        </li>
                    </ul>
                    <p class="demandPublic__footer__copyright">
                        &copy; 2021-2022 JSaaS. All Rights Reserved. 運営会社
                        ライトアップ
                    </p>
                </div>
            </footer>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
