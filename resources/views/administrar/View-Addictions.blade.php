@extends('admin.layouts.main')

@section('title', 'Toxicomanías')

@section('viteConfig')
    @vite(['resources/sass/diseases.scss'])
@endsection

@section('content')
    <div class="container">
        <!--Boton de agregar paciente -->
        <div class="col-12 mb-2 d-flex flex-column flex-md-row justify-content-end">

            <x-button-custom class="btn-sec" text="Agregar" tooltipText="Agregar nueva toxicomanía"  data-bs-toggle="modal" data-bs-target="#Add-addiction">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                    </svg>
                </x-slot>
            </x-button-custom>

        </div>


        <!-- Tabla para mostrar los datos  -->
        <div class="col-12 cont-principal"> <!-- Ajusta el tamaño de la tabla para dispositivos grandes -->

            {{-- Contenido de la tabla con grid --}}
            <div id="Tabla-Addictions"></div>
        </div>

        {{-- Modal para editar una toxicomania --}}
        @include('administrar.modals.Modal-Edit-Addictions')
        {{-- Modal para agregar un nuevo registro  --}}
        @include('administrar.modals.Modal-Add-Addictions')

    </div>
@endsection


@section('scripts')
    @vite('resources/js/administrar/seeAdictions.js')

@endsection
