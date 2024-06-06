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
        {{-- Modal para editar los datos del usuario --}}
    @include('user.modals.Modal-Edit')
    </div>

@endsection


@section('scripts')
    @vite('resources/js/users/Users.js')
@endsection
