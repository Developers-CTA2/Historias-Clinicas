@extends('admin.layouts.main')

@section('title', 'Agregar usuario')

@section('viteConfig')
    @vite(['resources/sass/users.scss', 'resources/sass/form-style.scss', 'resources/sass/drag-and-drop-file.scss'])
@endsection


@section('content')
    <div class="container ml-2">
        <!-- Card para mostrar todos los datos  -->
        <div id="detalles-container"></div>


        <x-card-custom>
            <x-slot name="title">
                Agregar un usuario al sistema
            </x-slot>

            <div class="pe-2">
                <div class="col-12 d-none">
                    <div class="alert alert-danger">
                        <ul class="m-0" id="listErrorsPerson"></ul>
                    </div>
                </div>

                <p class="text-center p-0">Escribe el código del usuario a agregar.</p>
                <div class="col-12 d-flex justify-content-center p-0 gap-3  mt-0">

                    <div class="form-group">
                        <label for="code">Código </label>
                        <input class="form-control form-disabled py-2" type="text" name="code" id="code"
                            maxlength="9">
                        <span class="text-danger fw-normal d-none">Código no
                            válido.</span>
                    </div>
                    <div class="mt-3">
                        <x-button-custom class="btn-sec mt-2" id="Search" text="Buscar" tooltipText="Buscar código">
                            <x-slot name="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 26 26">
                                    <path
                                        d="M10 .188A9.812 9.812 0 0 0 .187 10A9.812 9.812 0 0 0 10 19.813c2.29 0 4.393-.811 6.063-2.125l.875.875a1.845 1.845 0 0 0 .343 2.156l4.594 4.625c.713.714 1.88.714 2.594 0l.875-.875a1.84 1.84 0 0 0 0-2.594l-4.625-4.594a1.824 1.824 0 0 0-2.157-.312l-.875-.875A9.812 9.812 0 0 0 10 .188M10 2a8 8 0 1 1 0 16a8 8 0 0 1 0-16M4.937 7.469a5.446 5.446 0 0 0-.812 2.875a5.46 5.46 0 0 0 5.469 5.469a5.516 5.516 0 0 0 3.156-1a7.166 7.166 0 0 1-.75.03a7.045 7.045 0 0 1-7.063-7.062c0-.104-.005-.208 0-.312" />
                                </svg>
                            </x-slot>
                        </x-button-custom>
                    </div>
                </div>

                <div class="col-12 cont-user-data container mt-3 d-none animate__backInUp">
                    {{-- Contenedor de los datos personales del usuario --}}
                    <div class="row mx-2 p-1">
                        <h5 class="p-0 m-0 fw-bold text-muted"> Datos personales </h5>
                        <div class="col-lg-6  col-sm-12">
                            <div class="form-group mt-3">
                                <p class="fw-bold mb-0">Código</p>
                                <div class="mt-0" id="R-code"> - </div>
                            </div>
                        </div> <!-- FIN contenedor 1  -->
                        <div class="col-lg-6  col-sm-12">
                            <div class="form-group  mt-3">
                                <p class="fw-bold mb-0">Nombre</p>
                                <div class="mt-0" id="R-nombre"> - </div>
                            </div>
                        </div> <!-- FIN contenedor 1  -->
                    </div>

                    <hr />

                    <div class="row d-none">
                        <div class="col-12">
                            <div class="alert alert-danger">
                                <ul class="m-0" id="listErrors"></ul>
                            </div>
                        </div>
                    </div>

                    {{-- Contenedor de los datos del usuario --}}
                    <div class="row col-12 mx-2 p-1 mt-1">
                        <h5 class="p-0 m-0 fw-bold text-muted">Configuración</h5>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group mt-3">
                                {{-- <p class="fw-bold mb-0">Tipo de usuario</p> --}}
                                <label for="Usertype">Tipo de usuario <span class="red-color"> *</span></label>
                                <select class="form-control" id="Usertype" name="Usertype">
                                    <option value="" disabled selected>Selecciona</option>
                                    <option value="1">Doctor</option>
                                    <option value="2">Prestador de medicina</option>
                                    <option value="3">Prestador de nutrición</option>
                                </select>
                                <span class="text-danger fw-normal d-none"></span>
                            </div>
                            <div class="form-group mt-3">
                                <label for="Useremail">Correo <span class="red-color"> *</span></label>
                                <input class="form-control form-disabled mb-2" type="text" name="Useremail"
                                    id="Useremail">
                                <span class="text-danger fw-normal d-none"></span>
                            </div>

                            <div class="form-group mt-3 d-none div-cedula">
                                <label for="Usercedula" >Cedula <span class="red-color"> *</span></label>
                                <input class="form-control form-disabled mb-2" type="text" name="Usercedula"
                                    id="Usercedula"  maxlength="8">
                                <span class="text-danger fw-normal d-none"></span>

                            </div>
                        </div>
                        <div class="col-lg-6  col-sm-12">
                            <x-drag-and-drop-file />
                            <span class="text-danger fw-normal d-none"></span>
                        </div>
                    </div>
                    {{-- Botones  --}}
                    <div class="col-12 mt-2 row">
                            <div class="d-flex justify-content-end gap-2">
                
                                    <x-button-custom class="btn-red" text="Cancelar" id="cancelForm"
                                        tooltipText="Volver a la ventana anterior">
                                        <x-slot name="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 24 24">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1.5"
                                                    d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" />
                                            </svg>
                                        </x-slot>
                                    </x-button-custom>

                                    <x-button-custom class="btn-sec" text="Guardar" tooltipText="Guardar el usuario"
                                        id="save-user">
                                        <x-slot name="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M17 20.75H7A2.75 2.75 0 0 1 4.25 18V6A2.75 2.75 0 0 1 7 3.25h7.5a.75.75 0 0 1 .53.22L19.53 8a.75.75 0 0 1 .22.53V18A2.75 2.75 0 0 1 17 20.75m-10-16A1.25 1.25 0 0 0 5.75 6v12A1.25 1.25 0 0 0 7 19.25h10A1.25 1.25 0 0 0 18.25 18V8.81l-4.06-4.06Z" />
                                                <path fill="currentColor"
                                                    d="M16.75 20h-1.5v-6.25h-6.5V20h-1.5v-6.5a1.25 1.25 0 0 1 1.25-1.25h7a1.25 1.25 0 0 1 1.25 1.25ZM12.47 8.75H8.53a1.29 1.29 0 0 1-1.28-1.3V4h1.5v3.25h3.5V4h1.5v3.45a1.29 1.29 0 0 1-1.28 1.3" />
                                            </svg>
                                        </x-slot>
                                    </x-button-custom>                               
                            </div>               
                    </div>
                </div>

                {{-- <div class="col-12 p-0 mt-2 buttons-cont animate__fadeOut">
                    <div class="row">
                        <div class="d-flex justify-content-end">

                            <x-button-link-custom class="btn-red" text="Cancelar"
                                tooltipText="Volver a la ventana de usuarios">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                        viewBox="0 0 24 24">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="1.5"
                                            d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" />
                                    </svg>
                                </x-slot>
                                </x-button-custom>

                        </div>
                    </div>
                </div> --}}
            </div>
        </x-card-custom>
    </div>

@endsection

@section('scripts')
    @vite('resources/js/users/AddUser.js')
@endsection
