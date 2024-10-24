@extends('admin.layouts.main')

@section('title', 'Usuarios')

@section('viteConfig')
    @vite( 'resources/sass/users.scss')
@endsection

@section('content')
<style>
    
</style>
    <div class="container">
         <div class="col-12 mb-2 d-flex justify-content-center justify-content-md-end gap-3">
             <x-button-link-custom :route="route('users.download-template')" class="btn-red" text="Formato" tooltipText="Descargar la carta compromiso">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16.004V17a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-1M12 4.5v11m3.5-3.5L12 15.5L8.5 12"/></svg>
                </x-slot>
            </x-button-link-custom>

            <x-button-link-custom :route="route('users.add-user')" class="btn-blue-sec" text="Agregar" tooltipText="Agregar un nuevo usuario">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="25" height="25" ><path d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" /></svg>
                </x-slot>
            </x-button-link-custom>

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
