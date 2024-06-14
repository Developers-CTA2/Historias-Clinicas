@extends('admin.layouts.main')

@section('title', 'Enfermedades')

@section('viteConfig')
    @vite(['resources/sass/form-style.scss', 'resources/sass/diseases.scss'])
@endsection

@section('content')
    <div class="container">
        <!--Boton de agregar paciente -->
        <div class="col-12 mb-2 d-flex justify-content-end">
            <a class="btn-sec fst-normal tooltip-container p-1" type="button" data-bs-toggle="modal"
                data-bs-target="#Add-specific">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                </svg>
                Agregar
                <span class="tooltip-text">Agregar una enf. específica.</span>
            </a>
        </div>


        <!-- Tabla para mostrar los datos  -->
        <div class="col-12 cont-principal"> <!-- Ajusta el tamaño de la tabla para dispositivos grandes -->

            {{-- Contenido de la tabla con grid --}}
            <div id="Tabla-Especific-Diseases"></div>
        </div>

        {{-- Modal para editar un tipo de enfermedad --}}
        @include('administrar.modals.Modal-Edit-Especifc')
        {{-- Modal para agregar un nuevo registro  --}}
        @include('administrar.modals.Modal-Add-Specific')

    </div>
@endsection


@section('scripts')
    @vite('resources/js/administrar/seeEspecific.js')

@endsection
