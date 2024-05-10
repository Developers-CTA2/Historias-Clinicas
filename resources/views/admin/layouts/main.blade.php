<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Cargar archivos que se usarán en todas las vistas -->
    <script src="{{ asset('js/helpers/generalFuntions.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}" defer></script> <!-- jQuery -->

    <!-- Cargar archivos específicos de cada vista -->
    @yield('viteConfig')

    <!-- Cargar scripts que utilizan jQuery y Bootstrap -->
    @vite(['resources/sass/sideBar.scss',  'resources/sass/loadingScreen.scss', 'resources/js/app.js', 'resources/js/modal.js'])

</head>


<body>
    <div id="app" class="bg-custom">
        <!-- Loading Screen -->
        @include('admin.layouts.loadingScreen')

        {{-- @include('admin.layouts.sideBar')
        <div class="header-content border">
            @include('admin.layouts.header')
        </div> --}}

        @include('admin.layouts.header')

        {{-- <main class="container-custom border">
           
        </main> --}}
        <main class="container-custom" id="main-container">

            <h2 class="titleView-custom">@yield('titleView')</h2>
            @yield('breadCrumb')
            @yield('content')
        </main>
    </div>


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    @yield('scripts')
</body>

</html>