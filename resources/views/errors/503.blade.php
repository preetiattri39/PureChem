<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 Not Found - Swizchem</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       @vite([
        'resources/scss/app.scss',
        'resources/css/style.css',
        'resources/css/pages/error.css',
        ])

    <!-- No SEO indexing -->
    <meta name="robots" content="noindex, nofollow">

    <!-- Security -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Basic icons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">

</head>
<body class="">
    <section class="py-5 sec-err">
        <div class="container">
            <div class="row g-5 text-center">
                <h1 class="text-center m-0 mb-4">503</h1>
                <p class="text-center mt-0"> {!! $exception->getMessage() ?: '<strong>Service Unavailable</strong> : We\'re currently undergoing maintenance. Please check back soon.' !!}</p>
            </div>
        </div>
    </section>
</body>
</html>
