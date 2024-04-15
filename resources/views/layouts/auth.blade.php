<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- login style -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss','resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <main class="width-custom py-4 px-4 ">
            @yield('content')
        </main>
    </div>
</body>

</html>