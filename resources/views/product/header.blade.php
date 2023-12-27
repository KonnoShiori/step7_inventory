<div class="header__contents">
    <div class="header__nav--title header__left">
        <a href="{{ route('productsIndex') }}">在庫管理</a>
    </div>
    <div class="header__nav--list header__center">
        <ul>
            <li>
                <a href="{{ route('productsIndex') }}">商品一覧</a>
            </li>
            <li class="header__nav--item">
                <a href="{{ route('productCreate') }}">商品登録</a>
            </li>
        </ul>
    </div>
    <div class="header__nav--login header__right">
        <ul>
            @guest
                <li class="header__nav--login-button">
                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class="header__nav--login-button">
                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endguest

            @auth
                <li class="header__nav--login-button">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </li>
            @endauth

            @auth
                <li class="header__nav--login-name">
                    <a href="">{{ Auth::user()->name }}</a>
                </li>
            @endauth
        </ul>
    </div>

</div>
