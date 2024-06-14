@extends('admin.layouts.main')

@section('title', 'Usuarios')

@section('viteConfig')
    @vite( 'resources/sass/users.scss')
@endsection

@section('content')
<style>
    
</style>
    <div class="container">
        <div class="col-12 mb-2 d-flex justify-content-end">
            <a href="{{ route('users.add-user') }}" class="btn-sec fst-normal tooltip-container p-1" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14">
                    <path  fill-rule="evenodd"
                        d="M8 3a3 3 0 1 1-6 0a3 3 0 0 1 6 0m2.75 4.5a.75.75 0 0 1 .75.75V10h1.75a.75.75 0 0 1 0 1.5H11.5v1.75a.75.75 0 0 1-1.5 0V11.5H8.25a.75.75 0 0 1 0-1.5H10V8.25a.75.75 0 0 1 .75-.75M5 7c1.493 0 2.834.655 3.75 1.693v.057h-.5a2 2 0 0 0-.97 3.75H.5A.5.5 0 0 1 0 12a5 5 0 0 1 5-5"
                        clip-rule="evenodd" />
                </svg>
                Usuario
                <span class="tooltip-text">Agregar un usuario</span>
            </a>
        </div>
        <!-- Tabla para mostrar los datos  -->
        <div class="col-12 cont-principal"> <!-- Ajusta el tamaño de la tabla para dispositivos grandes -->

            {{-- Contenido de la tabla con grid --}}
            <div id="Tabla-Usuarios"></div>
        </div>
    </div>

@endsection



@section('scripts')
    @vite('resources/js/users/seeUsers.js')
@endsection
