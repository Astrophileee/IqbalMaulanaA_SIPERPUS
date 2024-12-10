<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>
    @if(session('success'))
        <meta name="success-message" content="{{ session('success') }}">
    @endif
    @if(session('error'))
        <meta name="error-message" content="{{ session('error') }}">
    @endif
</head>
<body class="flex min-h-screen bg-gray-100">

    @include('layouts.sidebar')

    <div class="flex flex-col w-full">


        <main class="flex-grow container mx-auto py-4 px-4">
            @yield('content')
        </main>

        @include('layouts.footer')
    </div>
</body>
</html>
