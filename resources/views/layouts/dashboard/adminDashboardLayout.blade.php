<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Public Head -->
    @include('partials.head.auth')

    <!-- Styles / Scripts -->
    @vite([
        'resources/sass/app.sass',
        'resources/js/app.js',
        ])
</head>
<body class="">

    <div id="page-loader" class="">
        <i class=""></i>
    </div>

    <!-- Header -->
    @include('partials.dashboard.header')

    <!-- Main Content -->
        @yield('content')

    <!-- Footer -->
    @include('partials.dashboard.footer')
</body>
</html>
