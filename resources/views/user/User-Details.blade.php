@extends('admin.layouts.main')

@section('title', 'Detalles de usuarios')

@section('viteConfig')
    @vite(['resources/sass/users.scss'])
@endsection

@section('content')
    <div class="container ml-2">
        <!-- Card para mostrar todos los datos  -->
        <div id="detalles-container" data-id="{{ $usuario->id }}"></div>

        <div class="card">
            <div class="card-header text-center">
                Detalles del usuario
            </div>
            <div class="card-body">
                <div class="row col-12">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col-12 pt-2">
                                    <p class="fw-bold mb-0">Nombre:</p>
                                    <div class="mt-0" id="User_Name">{{ $usuario->name }}</div>
                                </div>
                                <div class="form-group col-12 pt-2">
                                    <p class="fw-bold mb-0">Correo:</p>
                                    <div class="mt-0" id="email">{{ $usuario->email }}</div>
                                </div>

                                <div class="form-group col-12 pt-2">
                                    <p class="fw-bold mb-0">Cedula:</p>
                                    <div class="mt-0" id="Cedula">{{ $usuario->cedula ?? '--' }}</div>

                                </div>
                                <div class="form-group col-12 pt-2">
                                    <p class="fw-bold mb-0">Número de consultas:</p>
                                    <div class="mt-0" id="Cedula">{{ $count }} consultas</div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- FIN contenedor 1  -->

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col-12 pt-2">
                                    <p class="fw-bold mb-0">Código:</p>
                                    <div class="mt-0" id="User_Name">{{ $usuario->user_name }}</div>
                                </div>
                                <div class="form-group col-12 pt-2">
                                    <p class="fw-bold mb-0">Rol/Tipo de usuarios:</p>
                                    <div class="mt-0" id="User_Role">{{ $roleName }}</div>
                                </div>
                                <div class="form-group col-12 pt-2">
                                    <p class="fw-bold mb-0">Fecha de ingreso al sistema:</p>
                                    <div class="mt-0" >{{ $usuario->created_at }}</div>
                                </div>
                                <div class="form-group col-12 pt-2">
                                    <p class="fw-bold mb-0">Estado:</p>
                                    <div class="mt-0" id="User_Status">{{ $usuario->estado }}</div>
                                </div>
                            </div><!-- Fin de contenedor 2 -->
                        </div>
                    </div>

                    <div class="col-12 p-0 mt-2">
                        <div class="row">
                            <div class="d-flex justify-content-end">
                                <div class="mx-2">
                                    <a href="{{ route('users.users') }}" class="btn-red fst-normal tooltip-container">
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
                                <div class="">
                                    <button href="" class="btn-sec fst-normal tooltip-container" type="button"
                                        data-bs-toggle="modal" data-bs-target="#EditData">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
                                        </svg>
                                        Editar
                                        <span class="tooltip-text">Editar datos.</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- Modal para la edicion de los datos del usuario --}}
        <div class="modal fade " id="EditData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog  modal-md">
                <div class="modal-content">
                    {{-- Header de color azul --}}
                    <div class="modal-header bg-blue">
                        <h5 class="modal-title" id="staticBackdropLabel">Editar datos del usuario</h5>
                        <button type="button" class="btn-custom-close" data-bs-dismiss="modal" aria-label="Close"><svg
                                xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                <path fill="#ffffff"
                                    d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
                            </svg></button>
                    </div>
                    <div class="modal-body">
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
                        <div class="row d-flex mx-2">
                            <p class="text-center"> Corrige los datos érroneos o que hayan cambiado.</p>


                            <div id="errorAlert" class="alert alert-danger alert-dismissible fade show pb-0"
                                role="alert" style="display: none;">
                                <strong>¡Ups! Algo salió mal.</strong>
                                <ul id="errorList"></ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Cerrar"></button>

                            </div>


                            <div class="col-lg-6 col-md-6 col-sm-12 mt-0">
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-12">
                                            <label for="m-email">Correo </label>
                                            <input class="form-control form-disabled" type="text" name="m-email"
                                                id="m-email" value="{{ $usuario->email }}">
                                            <span class="text-danger fw-normal" style=" display: none;">Correo no
                                                válido.</span>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="m-cedula">Cedula </label>
                                            <input class="form-control form-disabled" type="text" name="m-cedula"
                                                id="m-cedula" value="{{ $usuario->cedula ?? '' }}" maxlength="8">
                                            <span class="text-danger fw-normal" style=" display: none;">Cedula no
                                                válido.</span>
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- FIN contenedor 1  -->
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-12">
                                            <label for="user-type">Tipo de usuario </label>
                                            @php
                                                $Admin = $roleName == 'Administrador' ? 'selected' : '';
                                                $prestMed = $roleName === 'Prestador de medicina' ? 'selected' : '';
                                                $prestNut = $roleName === 'Prestador de nutrición' ? 'selected' : '';
                                            @endphp

                                            <select class="form-control" id="user-type" name="user-type">
                                                <option value="1" {{ $Admin }}>Doctor</option>
                                                <option value="2" {{ $prestMed }}>Prestador de medicina</option>
                                                <option value="3" {{ $prestNut }}>Prestador de nutrición</option>
                                            </select>

                                            <span class="text-danger fw-normal" style=" display: none;">Rol no
                                                válido.</span>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="m-estado">Estado </label>
                                            @php
                                                $StatusActivo = $usuario->estado == 'Activo' ? 'selected' : '';
                                                $StatusInactivo = $usuario->estado == 'Inactivo' ? 'selected' : '';
                                            @endphp


                                            <label for="m-estado">Estado</label>
                                            <select class="form-control" id="m-estado" name="m-estado">
                                                <option value="1" {{ $StatusActivo }}>Activo</option>
                                                <option value="2" {{ $StatusInactivo }}>Inactivo</option>
                                            </select>

                                            <span class="text-danger fw-normal" style=" display: none;">Estado no
                                                válido.</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-red py-1" data-bs-dismiss="modal">Cerrar</button>
                        {{-- Agregar fill="currentColor"para aplicar la animacion --}}
                        <button class="btn-blue-sec fst-normal py-1" type="button" id="EditUser">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                <path fill="currentColor" d="m15.3 5.3l-6.8 6.8l-2.8-2.8l-1.4 1.4l4.2 4.2l8.2-8.2z" />
                            </svg>
                            Editar
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


@section('scripts')
    @vite('resources/js/users/Users.js')
@endsection
