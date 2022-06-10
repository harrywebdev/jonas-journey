<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="none"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') &ndash; {{ __('global.title') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@400;600;700&display=swap"
          rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
</head>
<body>
<main class="container" id="app">
    <h1 class="title">
        <a href="{{ route('home') }}">{{ __('global.title') }}</a>
    </h1>

    <div class="main-content">
        @yield('content')
    </div>
</main>
<footer class="container footer">
    <p>
        {{ __('global.title') }} &copy; {{ date('Y') }}
    </p>

    @auth
    <p>
        @if($isAdmin)
            (Admin)
        @endif
        <a href="{{ route('logout') }}">{{ __('global.actions.logout') }}</a>
    </p>
    @endauth
</footer>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-165287556-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('config', 'UA-165287556-1');
</script>

</body>
</html>
