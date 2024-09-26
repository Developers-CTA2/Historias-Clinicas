<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    
    <!-- Scripts -->
    @vite(['resources/js/app.js', 'resources/sass/login.scss'])
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">

    
</head>

<body>
    <div id="app">
        <main class="container-custom-login d-flex justify-content-center align-items-center">
            @yield('content')
        </main>
    </div>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    @yield('scripts')
</body>

</html>