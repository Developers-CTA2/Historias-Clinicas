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
    {{-- <link rel="stylesheet" href="{{ asset('css/login.css') }}"> --}}

    <!-- Scripts -->
    @vite(['resources/js/app.js','resources/sass/login.scss'])
    <script src="{{asset('js/jquery.min.js')}}"></script>
</head>

<body>
    <div id="app">
        <main class="container-custom-login d-flex justify-content-center align-items-center">
            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>

</html>