<header>
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="navbar-container container">
            <div class="d-flex justify-content-center align-items-center gap-3 order-1 order-lg-1">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="fw-bold" href="{{ route('home') }}">
                    <img
                        src="{{ asset($globalHeaderData['siteLogo']['3x']) }}"
                        srcset="
                            {{ asset($globalHeaderData['siteLogo']['1x']) }} 500w,
                            {{ asset($globalHeaderData['siteLogo']['2x']) }} 800w,
                            {{ asset($globalHeaderData['siteLogo']['3x']) }} 1200w
                        "
                        sizes="(max-width: 500px) 500px, (min-width: 446px) 800px, (min-width: 960px) 1200px"
                        alt="Swizchem Logo"
                        class="logo"
                        style="height: 40px;"
                    />
                </a>
            </div>
            <div class="collapse navbar-collapse order-3 order-lg-2" id="navMenu">
                <ul class="navbar-nav my-3 my-lg-0">
                    @foreach($globalHeaderData['navLinks'] as $link)
                    <li class="nav-item">
                        <a class="nav-link fs-6 sh-custom-text-accent" href="{{ route($link['url']) }}">{!! $link['label'] !!}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="d-flex justify-content-between gap-4 order-2 order-lg-3">
                @foreach($globalHeaderData['other'] as $item)
                    @php
                        $isLogin = $item['title'] === 'Login';
                        $isLoggedIn = Auth::check();
                        $userName = $isLoggedIn ? Auth::user()->name : null;
                        $routeUrl = $isLogin && $isLoggedIn ? '#' : route($item['url']);
                    @endphp

                    <div class="position-relative">
                        <a class="profile-icon fs-6 sh-custom-text-accent d-flex align-items-center gap-1"
                        href="{{ $routeUrl }}">
                            <i class="{{ $item['icon'] }} {{ $isLogin && $isLoggedIn ? 'user-logged-in' : '' }}"
                            style="color: rgb(40, 67, 93);" aria-hidden="true"></i>

                            <span class="small {{ $isLogin && $isLoggedIn ? 'user-logged-in' : '' }}">
                                @if($isLogin)
                                    @guest
                                        {{ $item['title'] }}
                                    @endguest

                                    @auth
                                        {{ $userName }}
                                    @endauth
                                @else
                                    {{ $item['title'] }}
                                @endif
                            </span>

                            @if($item['url'] === 'cart.index')
                                <div id="cart-count-display" class="nav-cart-items-counter">{{ cart_counter() }}</div>
                            @endif
                        </a>

                        {{-- Dropdown menu for logged-in user --}}
                        @if($isLogin && $isLoggedIn)
                            <div id="user-menu-block" class="user-menu d-none">
                                <ul class="list-unstyled m-0 p-0">
                                    <li class="d-flex justify-content-between align-items-center gap-3 px-2 my-2">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                            @csrf
                                            <button type="submit" class="btn btn-link p-0 m-0 d-flex align-items-center gap-2 text-decoration-none text-dark">
                                                Logout
                                            </button>
                                        </form>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center gap-3 px-2 my-2">
                                        <i class="fa fa-columns" aria-hidden="true"></i>
                                        <a class="sh-inherit-color" href="{{ route('filament.user.pages.dashboard') }}">Dashboard</a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </nav>
</header>