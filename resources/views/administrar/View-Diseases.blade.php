@extends('admin.layouts.main')

@section('title', 'Tipos de enfermedades')


@section('content')
    <div class="container">
        <!--Boton de agregar paciente -->
        <div class="col-12 mb-2 d-flex flex-column flex-md-row  justify-content-md-end gap-3">

            <x-button-link-custom class="btn-blue-sec" :route="route('admin.specific-diseases')"  text="Enf. Específicas" tooltipText="Lista de enfermedades específicas">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M8 6h12M4 6.01l.01-.011M4 12.01l.01-.011M4 18.01l.01-.011M8 12h12M8 18h12" />
                    </svg>
                </x-slot>
            </x-button-link-custom>

            <x-button-custom class="btn-sec" text="Agregar" tooltipText="Agregar nueva clasificación de enfermedad"
                data-bs-toggle="modal" data-bs-target="#Add-diseasse">
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
            <div id="Tabla-Diseases"></div>
        </div>
        {{-- Modal para editar un tipo de enfermedad --}}
        @include('administrar.modals.Modal-Edit-Disease')
        {{-- Modal para agregar un nuevo registro  --}}
        @include('administrar.modals.Modal-Add-Disease')
    </div>
@endsection

@section('scripts')
    @vite('resources/js/administrar/seeDiseases.js')

@endsection
