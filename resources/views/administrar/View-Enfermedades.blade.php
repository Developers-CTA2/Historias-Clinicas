@extends('admin.layouts.main')

@section('title', 'Enfermedades')

@section('viteConfig')
    @vite(['resources/sass/Forms-Styles.scss', 'resources/sass/diseases.scss'])
@endsection

@section('content')
    <div class="container">
        <!--Boton de agregar paciente -->
        <div class="col-12 mb-2 d-flex justify-content-end gap-2">
            <div>
                <a href="" class="btn-sec fst-normal tooltip-container p-1" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                    </svg>
                    Agregar
                    <span class="tooltip-text">Agregar un tipo de enfermedad.</span>
                </a>
            </div>
            <div>
                <a href="{{ route('admin/specific-diseases') }}" class="btn-blue-sec fst-normal tooltip-container p-1" type="button">
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                        <path  d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z" />
                    </svg> --}}
                    Específicas
                    <span class="tooltip-text">Ver enf. específicas.</span>
                </a>
            </div>
        </div>


        <!-- Tabla para mostrar los datos  -->
        <div class="col-12 cont-principal"> <!-- Ajusta el tamaño de la tabla para dispositivos grandes -->

            {{-- Contenido de la tabla con grid --}}
            <div id="Tabla-Diseases"></div>
        </div>
  <div class="modal fade" id="Edit-diseasse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-blue">
                        <h5 class="modal-title" id="staticBackdropLabel">Detalles del registro</h5>
                        <button type="button" class="btn-custom-close" data-bs-dismiss="modal" aria-label="Close"><svg
                                xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                <path fill="#ffffff"
                                    d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
                            </svg></button>
                    </div>
                    <div class="modal-body">

                        {{-- Alerta de los datos no han cambiado --}}
                        <div id="Alerta_err" class="p-0 m-0 d-none">
                            <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between p-0 m-0"
                                role="alert">
                                <p class="p-2 mb-1"> <strong>Ooops! </strong> Parece que no se ha realizado ningun cambio.
                                </p>
                                <button class="btn fst-italic animated-icon button-cancel  rigth-0" data-bs-dismiss="alert">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                        {{-- Errores de laravel  --}}
                        <div id="errorAlert" class="alert alert-danger alert-dismissible fade show pb-0" role="alert"
                            style="display: none;">
                            <strong>¡Ups! Algo salió mal.</strong>
                            <ul id="errorList"></ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>

                        </div>

                        <div class="row col-12 pt-1">
                            <p class="text-center mb-0">Es posible editar los datos erróneos.</p>
                        </div>
                        <div class="row mt-0 pt-0">
                            <div class="col-12 px-3 ">
                               
                                <div class="form-group pt-2">
                                    <label for="E_nombre">Nombre del tipo de enfermedad</label>
                                    <input type="text" class="form-control" id="E_nombre" name="E_nombre">
                                    <span class="text-danger fw-normal" style=" display: none;">Nombre no válido.</span>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-red py-1" data-bs-dismiss="modal">Cerrar</button>
                        <button class="btn-blue-sec fst-normal py-1" type="button" id="E_disease">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                <path fill="currentColor" d="m15.3 5.3l-6.8 6.8l-2.8-2.8l-1.4 1.4l4.2 4.2l8.2-8.2z" />
                            </svg>
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    @vite('resources/js/administrar/seeDiseases.js')

@endsection
