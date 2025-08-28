<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Authentication - Swizchem')</title>

    <!-- No SEO indexing -->
    <meta name="robots" content="noindex, nofollow">

    <!-- Security -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Basic icons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&loading=async" async defer ></script>
    
    @yield('head')
</head>
