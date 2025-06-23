<header>
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <img src="{{ asset('images/logo/swizchem-logo.png') }}" alt="Logo" style="height: 40px;" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('company') }}">Company</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('products.main') }}">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('custom-synthesis') }}">Custom Synthesis</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>
            <div class="d-flex justify-content-between gap">
                <a class="profile-icon" href="my-account.html">
                    <i class="fa fa-user" aria-hidden="true" style="color: rgb(40, 67, 93);"></i>
                    Login
                </a>
                <a class="cart-icon" href="cart.html">
                    <i class="fa fa-shopping-cart" aria-hidden="true" style="color: rgb(40, 67, 93);"></i> 
                    Cart
                </a>
            </div>
        </div>
    </nav>
</header>