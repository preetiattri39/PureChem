<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Public Head -->
    @include('partials.head.auth')

    <!-- Styles / Scripts -->
    @vite([
        'resources/scss/app.scss',
        'resources/js/app.js',
        ])

</head>
<body class="">
    <!-- Header -->
    @include('partials.auth.header')

    <!-- Main Content -->
    @yield('content')

    <!-- Footer
    @include('partials.auth.footer') -->

</body>
</html>
