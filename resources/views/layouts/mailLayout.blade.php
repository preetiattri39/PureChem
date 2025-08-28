<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Swizchem</title>
    @include('mails.partials.styles')
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        @include('partials.mails.header')

        <!-- Main Content -->
        
            @yield('content')
        

        <!-- Footer -->
        @include('partials.mails.footer')
    </div>
</body>
</html>