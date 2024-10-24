@extends('admin.layouts.main')

@section('title', 'Alergias')


@section('content')
    <div class="container">
        <!--Boton de agregar paciente -->
        <div class="col-12 mb-2 d-flex flex-column flex-md-row justify-content-end">

            <x-button-custom class="btn-sec" data-bs-toggle="modal" data-bs-target="#Add-allergy" text="Agregar" tooltipText="Agregar nueva alérgia" >
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
            <div id="Tabla-Especific-Allergies"></div>
        </div>

        {{-- Modal para editar una alergia --}}
        @include('administrar.modals.Modal-Edit-Allergies')
        {{-- Modal para agregar una nueva alergia  --}}
        @include('administrar.modals.Modal-Add-Allergies')

     
    </div>
@endsection


@section('scripts')
    @vite('resources/js/administrar/seeAllergies.js')

@endsection
