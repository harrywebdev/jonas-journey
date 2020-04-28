<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') &ndash; {{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@400;600;700&display=swap"
          rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<main class="container" id="app">
    <div class="main-content">
        <h1>{{ config('app.name') }}</h1>

        @yield('content')
    </div>
</main>
<footer class="container footer">
    <p>
        {{ config('app.name') }} &copy; {{ date('Y') }}
    </p>

    @auth
        <p><a href="{{ route('logout') }}">{{ __('Odhlasit') }}</a></p>
    @endauth
</footer>
</body>
</html>
