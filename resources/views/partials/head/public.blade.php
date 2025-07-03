<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Public Swizchem')</title>

    <meta name="description" content="@yield('meta_description', 'Default SEO description')">
    <meta name="keywords" content="@yield('meta_keywords', 'keyword1, keyword2')">
    <meta name="author" content="Swizchem">
    <meta name="robots" content="@yield('meta_description', 'index, follow')">

    <!-- Open Graph (Facebook/LinkedIn) -->
    <meta property="og:title" content="@yield('og_title', 'My Website')">
    <meta property="og:description" content="@yield('og_description', 'Description for social media')">
    <meta property="og:image" content="@yield('og_image', asset('images/social-images/social-image-1.png'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'My Website')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Twitter description')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/social-images/social-image-1.png'))">

    <!-- Icons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon.jpg') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.jpg') }}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">

    @yield('head')
</head>
