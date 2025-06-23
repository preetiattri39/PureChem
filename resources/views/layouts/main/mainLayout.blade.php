<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Public Head -->
    @include('partials.head.public')

    <!-- Styles / Scripts -->
    @vite([
        'resources/scss/app.scss',
        'resources/css/style.css',
        'resources/js/app.js',
        'resources/js/global/footer.js',
        ])

    <!-- Page-specific assets -->
    @yield('vite')

</head>
<body class="">

    <div id="page-loader" class="">
        <i class=""></i>
    </div>

    <!-- Header -->
    @include('partials.header')

    <!-- Main Content -->
        @yield('content')

    <!-- Footer -->
    @include('partials.footer')
</body>
</html>
