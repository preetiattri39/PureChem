<header>
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <img
                    src="{{ asset($globalHeaderData['siteLogo']['1x']) }}"
                    srcset="
                        {{ asset($globalHeaderData['siteLogo']['1x']) }} 1x,
                        {{ asset($globalHeaderData['siteLogo']['2x']) }} 2x,
                        {{ asset($globalHeaderData['siteLogo']['3x']) }} 3x
                    "
                    alt="Swizchem Logo"
                    class="logo"
                    style="height: 40px;"
                />

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    @foreach($globalHeaderData['navLinks'] as $link)
                    <li class="nav-item">
                        <a class="nav-link fs-6 sh-custom-text-accent" href="{{ route($link['url']) }}">{!! $link['label'] !!}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="d-flex justify-content-between gap-4">
                @foreach($globalHeaderData['other'] as $item)
                <a class="profile-icon fs-6 sh-custom-text-accent position-relative" href="{{ route($item['url']) }}">
                    <i class="{{ $item['icon'] }}" aria-hidden="true" style="color: rgb(40, 67, 93);"></i>
                    <span class="small" >{{ $item['title'] }}</span>
                    @if($item['url'] === 'cart')
                    <div class="nav-cart-items-counter">3</div>
                    @endif
                </a>
                @endforeach
            </div>
        </div>
    </nav>
</header>

