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
                <a class="profile-icon fs-6 sh-custom-text-accent position-relative" href="{{ (Auth::check() && $item['title'] === 'Login') ? '#' : route($item['url']) }}">

                    <i class="{{ $item['icon'] }} {{ (Auth::check() && $item['title'] === 'Login') ? 'user-logged-in' : '' }}" aria-hidden="true" style="color: rgb(40, 67, 93);"></i>
                    <span class="small {{ (Auth::check() && $item['title'] === 'Login') ? 'user-logged-in' : '' }}" >
                        @if($item['title'] === 'Login')
                            @guest 
                                {{ $item['title'] }}
                            @endguest

                            @auth
                                {{ Auth::user()->name }}
                            @endauth
                        @else
                            {{ $item['title'] }}
                        @endif
                    </span>
                    @if($item['url'] === 'cart.index')
                        <div id="cart-count-display" class="nav-cart-items-counter">{{ cart_counter() }}</div>
                    @endif

                   @if($item['title'] === 'Login' && Auth::check())
                        <div id="user-menu-block" class="user-menu d-none">

                            <ul class="list-unstyled m-0 p-0">
                                <li class="d-flex justify-content-center align-items-center gap-3 my-1">
                                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0 m-0 d-flex align-items-center gap-2 text-decoration-none text-dark">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>

                        </div>

                    @endif
                </a>
                @endforeach
            </div>
        </div>
    </nav>
</header>