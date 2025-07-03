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
                <a class="profile-icon fs-6 sh-custom-text-accent position-relative {{ Auth::check() ? 'user-logged-in' : '' }}" href="{{ Auth::check() ? '#' : route($item['url']) }}">
                    
                    <i class="{{ $item['icon'] }}" aria-hidden="true" style="color: rgb(40, 67, 93);"></i>
                    <span class="small" >
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
                    
                    @if($item['url'] === 'cart')
                    <div class="nav-cart-items-counter">3</div>
                    @endif
                </a>
                @endforeach
            </div>
        </div>
    </nav>
</header>

