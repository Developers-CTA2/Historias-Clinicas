@extends('admin.layouts.main')

@section('title', 'Perfil')

@section('viteConfig')
    @vite(['resources/sass/form-style.scss'])
@endsection


@section('content')
    <div class="container ml-2">

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
                                <div class="mt-0"> {{ auth()->user()->name }} </div>
                            </div>

                            <div class="form-group col-12 pt-2">
                                <p class="fw-bold mb-0">Correo</p>
                                <div class="mt-0">{{ auth()->user()->email }}</div>
                            </div>

                            <div class="form-group col-12 pt-2">
                                <p class="fw-bold mb-0">Cedula</p>
                                <div class="mt-0"> {{ auth()->user()->cedula ?? '--' }} </div>
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group col-12 pt-2">
                                <p class="fw-bold mb-0">Código</p>
                                <div class="mt-0"> {{ auth()->user()->user_name }} </div>
                            </div>
                            <div class="form-group col-12 pt-2">
                                <p class="fw-bold mb-0">Rol</p>
                                <div class="mt-0"> {{ $role }}</div>
                            </div>

                            <div class="form-group col-12 pt-2">
                                <p class="fw-bold mb-0">Fecha de ingreso</p>
                                <div class="mt-0"> {{ $Date }} </div>
                            </div>
                        </div>
                    </div>


                    {{-- Contenedor para cambiar contraseña  --}}
                    <div id="cont-change"
                        class="row col-12 mx-2 p-1 pb-2 border rounded d-none animate__animated animate__fadeInUp animate__backOutDown">
                        <p class="text-center p-0">Actualizar mi contraseña</p>
                        <div class="col-lg-5 col-md-5 col-sm-12 mt-2">
                            {{-- Alerta de los datos no han cambiado --}}
                            <div id="Alerta_err" class="p-0 m-0 d-none">
                                <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between p-0 m-0"
                                    role="alert">
                                    <p class="p-2 mb-1"> Contraseña incorrecta.</p>
                                    <button class="btn fst-italic animated-icon button-cancel rigth-0"
                                        data-bs-dismiss="alert">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Pass">Contraseña actual </label>
                                <input class="form-control form-disabled" type="password" name="Pass" id="Pass"
                                    maxlength="9">
                                <span class="text-danger fw-normal" style=" display: none;">Contraseña no válida.</span>
                            </div>
                            <div class="d-flex justify-content-center mb-2">
                                <button class="btn-sec fst-normal tooltip-container mt-2 px-2 py-1" type="button"
                                    id="verfify-pass">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M3 17h18q.425 0 .713.288T22 18t-.288.713T21 19H3q-.425 0-.712-.288T2 18t.288-.712T3 17m1-5.55l-.475.85q-.15.275-.45.35t-.575-.075t-.35-.45t.075-.575l.475-.85h-.95q-.325 0-.537-.212T1 9.95t.213-.537t.537-.213h.95l-.475-.8q-.15-.275-.075-.575t.35-.45t.575-.075t.45.35l.475.8l.475-.8q.15-.275.45-.35t.575.075t.35.45t-.075.575l-.475.8h.95q.325 0 .538.213T7 9.95t-.213.538t-.537.212H5.3l.475.85q.15.275.075.575t-.35.45t-.575.075t-.45-.35zm8 0l-.475.85q-.15.275-.45.35t-.575-.075t-.35-.45t.075-.575l.475-.85h-.95q-.325 0-.537-.212T9 9.95t.213-.537t.537-.213h.95l-.475-.8q-.15-.275-.075-.575t.35-.45t.575-.075t.45.35l.475.8l.475-.8q.15-.275.45-.35t.575.075t.35.45t-.075.575l-.475.8h.95q.325 0 .537.213T15 9.95t-.213.538t-.537.212h-.95l.475.85q.15.275.075.575t-.35.45t-.575.075t-.45-.35zm8 0l-.475.85q-.15.275-.45.35t-.575-.075t-.35-.45t.075-.575l.475-.85h-.95q-.325 0-.537-.212T17 9.95t.213-.537t.537-.213h.95l-.475-.8q-.15-.275-.075-.575t.35-.45t.575-.075t.45.35l.475.8l.475-.8q.15-.275.45-.35t.575.075t.35.45t-.075.575l-.475.8h.95q.325 0 .538.213T23 9.95t-.213.538t-.537.212h-.95l.475.85q.15.275.075.575t-.35.45t-.575.075t-.45-.35z" />
                                    </svg>
                                    Verificar
                                    <span class="tooltip-text">Verificar contraseña.</span>
                                </button>
                            </div>

                        </div>
                        {{-- Contenedor del lado derecho --}}
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <div class="form-group">
                                <div class="cont-pass-1 d-flex justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100"
                                        viewBox="0 0 32 32">
                                        <g fill="none">
                                            <path fill="#F9C23C"
                                                d="M3 13a3 3 0 0 1 3-3h2l1.5-1l1 1h7L19 9l1 1h2a3 3 0 0 1 3 3v13a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3z" />
                                            <path fill="#433B6B" d="M15.5 19.5a2.5 2.5 0 1 0-3 0V23a1.5 1.5 0 0 0 3 0z" />
                                            <path fill="#D3D3D3"
                                                d="M14 1a6 6 0 0 0-6 6v3h2.5V7a3.5 3.5 0 1 1 7 0v3H20V7a6 6 0 0 0-6-6m16 8.5a4.502 4.502 0 0 1-3 4.244V22.5a1.5 1.5 0 0 1-3 0v-1.754c0-.2.078-.39.216-.52l.313-.31a.723.723 0 0 0 0-1.04a.712.712 0 0 1 0-1.03a.723.723 0 0 0 0-1.04l-.313-.31a.734.734 0 0 1-.216-.52v-2.232A4.502 4.502 0 0 1 25.5 5A4.5 4.5 0 0 1 30 9.5M25.5 8a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                                        </g>
                                    </svg>

                                </div>
                                <div class="cont-new-pass d-none animate__animated animate__fadeInDown ">
                                    {{-- Alerta de los datos no han cambiado --}}
                                    <div id="Alerta_pass" class="p-0 m-0 d-none">
                                        <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between p-0 m-0"
                                            role="alert">
                                            <p class="p-2 mb-1"> Las contraseñas no coinciden.</p>
                                            <button class="btn fst-italic animated-icon button-cancel rigth-0"
                                                data-bs-dismiss="alert">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <p class="text-center p-0">Ingresa la contraseña nueva</p>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="New_Pass">Contraseña <span class="red-color">*</span>
                                            </label>

                                            <input class="form-control" type="password" name="New_Pass" id="New_Pass"
                                                value="" maxlength="13">

                                            <span class="text-danger fw-normal" style=" display: none;">Contraseña no
                                                válido.</span>

                                        </div>

                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="Confirm">Confirmar contraseña <span
                                                    class="red-color">*</span></label>

                                            <input class="form-control" type="password" name="Confirm" id="Confirm"
                                                value="" maxlength="13">
                                            <span class="text-danger fw-normal" style=" display: none;">Contraseña no
                                                válido.</span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-center mt-2">
                            <div class="mx-2">
                                <button class="btn-red fst-normal tooltip-container p-1" id="cancel-pass">
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 2048 2048">
                                        <path  
                                            d="m1115 1024l690 691l-90 90l-691-690l-691 690l-90-90l690-691l-690-691l90-90l691 690l691-690l90 90z" />
                                    </svg> --}}
                                    Cancelar
                                    <span class="tooltip-text">Volver a la ventana anterior.</span>
                                </button>
                            </div>
                            <div class="mx-2">
                                <button class="btn-blue-sec fst-normal tooltip-container p-1 d-none" id="save">
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 2048 2048">
                                        <path  
                                            d="m1115 1024l690 691l-90 90l-691-690l-691 690l-90-90l690-691l-690-691l90-90l691 690l691-690l90 90z" />
                                    </svg> --}}
                                    Guardar
                                    <span class="tooltip-text">Guardar cambios.</span>
                                </button>
                            </div>
                        </div>
                    </div>

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
                                    <button class="btn-blue-sec fst-normal tooltip-container p-1" id="Change-pass">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 32 32">
                                            <path
                                                d="M21 2a8.998 8.998 0 0 0-8.612 11.612L2 24v6h6l10.388-10.388A9 9 0 1 0 21 2m0 16a7 7 0 0 1-2.032-.302l-1.147-.348l-.847.847l-3.181 3.181L12.414 20L11 21.414l1.379 1.379l-1.586 1.586L9.414 23L8 24.414l1.379 1.379L7.172 28H4v-3.172l9.802-9.802l.848-.847l-.348-1.147A7 7 0 1 1 21 18" />
                                            <circle cx="22" cy="10" r="2" />
                                        </svg>
                                        Contraseña
                                        <span class="tooltip-text">Cambiar contraseña.</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    @endsection

    @section('scripts')
        @vite('resources/js/perfil/perfil.js')
    @endsection
