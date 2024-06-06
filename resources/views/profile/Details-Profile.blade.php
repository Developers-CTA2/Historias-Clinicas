@extends('admin.layouts.main')

@section('title', 'Perfil')

@section('viteConfig')
    @vite(['resources/sass/users.scss'])
@endsection


@section('content')
    <div class="container ml-2">
        <!-- Card para mostrar todos los datos  -->
        <div id="detalles-container"></div>

        <div class="card">
            <div class="card-header text-center">
                Mi perfil
            </div>
            <div class="card-body">
                <div class="row col-12">
                    {{-- <div class="col-12 d-flex justify-content-center p-0 gap-2  mt-0">

                        <div class="form-group">
                            <label for="code">Código </label>
                            <input class="form-control form-disabled" type="text" name="code" id="code"
                                maxlength="9">
                            <span class="text-danger fw-normal" style=" display: none;">Código no
                                válido.</span>
                        </div>
                        <div class="mt-3">
                            <button class="btn-sec fst-normal tooltip-container mt-2 px-2 py-1" type="button"
                                id="Search">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 26 26">
                                    <path
                                        d="M10 .188A9.812 9.812 0 0 0 .187 10A9.812 9.812 0 0 0 10 19.813c2.29 0 4.393-.811 6.063-2.125l.875.875a1.845 1.845 0 0 0 .343 2.156l4.594 4.625c.713.714 1.88.714 2.594 0l.875-.875a1.84 1.84 0 0 0 0-2.594l-4.625-4.594a1.824 1.824 0 0 0-2.157-.312l-.875-.875A9.812 9.812 0 0 0 10 .188M10 2a8 8 0 1 1 0 16a8 8 0 0 1 0-16M4.937 7.469a5.446 5.446 0 0 0-.812 2.875a5.46 5.46 0 0 0 5.469 5.469a5.516 5.516 0 0 0 3.156-1a7.166 7.166 0 0 1-.75.03a7.045 7.045 0 0 1-7.063-7.062c0-.104-.005-.208 0-.312" />
                                </svg>
                                Buscar
                                <span class="tooltip-text">Buscar el código.</span>
                            </button>
                        </div>
                    </div> --}}

                    <div class="row col-12 mx-2 p-1">
                        <p class="text-center p-0">Detalles de mi cuenta</p>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group col-12 pt-2">
                                <p class="fw-bold mb-0">Nombre</p>
                                <div class="mt-0" id="U_name"> SOLANO GUZMÁN EDUARDO</div>
                            </div>

                            <div class="form-group col-12 pt-2">
                                <p class="fw-bold mb-0">Correo</p>
                                <div class="mt-0" id="U_email"> example@gmail.com</div>
                            </div>

                            <div class="form-group col-12 pt-2">
                                <p class="fw-bold mb-0">Cedula</p>
                                <div class="mt-0" id="U_cedula"> 12457893 </div>
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group col-12 pt-2">
                                <p class="fw-bold mb-0">Código</p>
                                <div class="mt-0" id="U-code"> 2921073 </div>
                            </div>
                            <div class="form-group col-12 pt-2">
                                <p class="fw-bold mb-0">Rol</p>
                                <div class="mt-0" id="U-role"> Adminsitrador </div>
                            </div>

                            <div class="form-group col-12 pt-2">
                                <p class="fw-bold mb-0">Fecha de ingreso</p>
                                <div class="mt-0" id="U-role"> 20 mayo 2024 </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row col-12 mx-2 p-1 mt-1">
                        <h5 class="p-0 m-0"> Selecciona el rol del usuario </h5>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group col-12 pt-2">
                                <label for="Usertype">Tipo de usuario <span class="red-color"> *</span></label>
                                <select class="form-control" id="Usertype" name="Usertype">
                                    <option value="" disabled selected>Selecciona</option>
                                    <option value="1">Doctor</option>
                                    <option value="2">Prestador de medicina</option>
                                    <option value="3">Prestador de nutrición</option>
                                </select>
                                <span class="text-danger fw-normal" style=" display: none;">Tip de usuario no
                                    válido.</span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group col-12 pt-2">
                                <label for="Useremail">Correo <span class="red-color"> *</span></label>
                                <input class="form-control form-disabled mb-2" type="text" name="Useremail"
                                    id="Useremail">
                                <span class="text-danger fw-normal" style=" display: none;">Correo no válido.</span>
                            </div>

                            <div class="form-group col-12 pt-2 d-none div-cedula">
                                <label for="Usercedula">Cedula <span class="red-color"> *</span></label>
                                <input class="form-control form-disabled mb-2" type="text" name="Usercedula"
                                    id="Usercedula">
                                <span class="text-danger fw-normal" style=" display: none;">Cedula no válido.</span>

                            </div>
                        </div>
                    </div> --}}


                    {{-- <div class="col-12 p-0 mt-2">
                        <div class="row">
                            <div class="d-flex justify-content-end">
                                <div class="mx-2">
                                    <a href="{{ route('users.users') }}" class="btn-red fst-normal tooltip-container p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 1024 1024">
                                            <path d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64" />
                                            <path
                                                d="m237.248 512l265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312z" />
                                        </svg>
                                        Cancelar
                                        <span class="tooltip-text">Volver a la ventana anterior.</span>
                                    </a>
                                </div>
                                <div class="">
                                    <button class="btn-sec fst-normal tooltip-container p-1 d-none" id="save-user"
                                        type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M9.55 13.15L18 4.7q.3-.3.713-.3t.712.3t.3.712t-.3.713L10.25 15.3q-.3.3-.7.3t-.7-.3l-4.275-4.275q-.3-.3-.288-.712T4.6 9.6t.713-.3t.712.3zM6 20q-.425 0-.712-.288T5 19t.288-.712T6 18h12q.425 0 .713.288T19 19t-.288.713T18 20z" />
                                        </svg>
                                        Guardar
                                        <span class="tooltip-text">Editar datos.</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-12 p-0 mt-2">
                        <div class="row mt-1">
                            <div class="d-flex justify-content-end">
                                <div class="mx-2">
                                    <a href="{{ route('users.users') }}" class="btn-red fst-normal tooltip-container p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 1024 1024">
                                            <path d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64" />
                                            <path
                                                d="m237.248 512l265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312z" />
                                        </svg>
                                        Atras
                                        <span class="tooltip-text">Volver a la ventana anterior.</span>
                                    </a>
                                </div>
                                <div class="mx-2">
                                    <a href="{{ route('users.users') }}" class="btn-blue-sec fst-normal tooltip-container p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 32 32">
                                            <path
                                                d="M21 2a8.998 8.998 0 0 0-8.612 11.612L2 24v6h6l10.388-10.388A9 9 0 1 0 21 2m0 16a7 7 0 0 1-2.032-.302l-1.147-.348l-.847.847l-3.181 3.181L12.414 20L11 21.414l1.379 1.379l-1.586 1.586L9.414 23L8 24.414l1.379 1.379L7.172 28H4v-3.172l9.802-9.802l.848-.847l-.348-1.147A7 7 0 1 1 21 18" />
                                            <circle cx="22" cy="10" r="2" />
                                        </svg>
                                        Contraseña
                                        <span class="tooltip-text">Cambiar contraseña.</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection

@section('scripts')
    @vite('resources/js/users/AddUser.js')
@endsection
