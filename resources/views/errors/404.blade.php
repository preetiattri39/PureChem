<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-6">
    <div class="text-center">
        <h1 class="text-6xl font-bold text-red-600">{{ $exception->getStatusCode() ?? '403' }}</h1>
        <h2 class="text-3xl font-semibold text-black mt-4">{{__('messages.page_not_found')}}</h2>
        <p class="text-gray-600 mt-2">{{ $exception->getMessage() ?? __('messages.page_not_found_description')}}</p>
        <a href="{{ url('/') }}" class="inline-block mt-6 px-6 py-3 bg-black text-white hover:bg-red-600 transition rounded">
            {{__('messages.go_to_dashboard')}}
        </a>
    </div>
</body>
</html>
