@extends('admin.layouts.main')

@section('title', 'Detalles de usuarios')

@section('viteConfig')
    @vite(['resources/sass/form-style.scss', 'resources/sass/users.scss', 'resources/sass/drag-and-drop-file.scss'])
@endsection

@section('content')
    <div class="container ml-2">
        <!-- Card para mostrar todos los datos  -->
        <div id="detalles-container" data-id="{{ $usuario->id }}"></div>

        <div class="card">
            <div class="card-header text-center bg-blue">
                Detalles del usuario
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
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
                                        <div class="mt-0" >{{ $created_at }}</div>
                                    </div>
                                    <div class="form-group col-12 pt-2">
                                        <p class="fw-bold mb-0">Estado:</p>
                                        <div class="mt-0" id="User_Status">{{ $usuario->estado }}</div>
                                    </div>
                                </div><!-- Fin de contenedor 2 -->
                            </div>
                        </div>
    
                        <div class="col-12 p-0 mt-4">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-between">
                                    <div >
                                        <x-button-link-custom :route="route('users.file',['id_user'=> $usuario->id])"  class="btn-blue-sec" text="Descargar" tooltipText="Descarga la carta compromiso del usuario">
                                            <x-slot name="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 15 15"><path fill="currentColor" d="M2.5 6.5V6H2v.5zm4 0V6H6v.5zm0 4H6v.5h.5zm7-7h.5v-.207l-.146-.147zm-3-3l.354-.354L10.707 0H10.5zM2.5 7h1V6h-1zm.5 4V8.5H2V11zm0-2.5v-2H2v2zm.5-.5h-1v1h1zm.5-.5a.5.5 0 0 1-.5.5v1A1.5 1.5 0 0 0 5 7.5zM3.5 7a.5.5 0 0 1 .5.5h1A1.5 1.5 0 0 0 3.5 6zM6 6.5v4h1v-4zm.5 4.5h1v-1h-1zM9 9.5v-2H8v2zM7.5 6h-1v1h1zM9 7.5A1.5 1.5 0 0 0 7.5 6v1a.5.5 0 0 1 .5.5zM7.5 11A1.5 1.5 0 0 0 9 9.5H8a.5.5 0 0 1-.5.5zM10 6v5h1V6zm.5 1H13V6h-2.5zm0 2H12V8h-1.5zM2 5V1.5H1V5zm11-1.5V5h1V3.5zM2.5 1h8V0h-8zm7.646-.146l3 3l.708-.708l-3-3zM2 1.5a.5.5 0 0 1 .5-.5V0A1.5 1.5 0 0 0 1 1.5zM1 12v1.5h1V12zm1.5 3h10v-1h-10zM14 13.5V12h-1v1.5zM12.5 15a1.5 1.5 0 0 0 1.5-1.5h-1a.5.5 0 0 1-.5.5zM1 13.5A1.5 1.5 0 0 0 2.5 15v-1a.5.5 0 0 1-.5-.5z"/></svg>
                                            </x-slot>
                                        </x-button-custom>
                                    
    
                                    </div>
                                    <div class="d-flex gap-1">
                                        <x-button-link-custom :route="route('users.users')" class="btn-red me-3" tooltipText="Volver a la lista de usuarios" text="Atras">
                                            <x-slot name="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 1024 1024">
                                                <path d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64" />
                                                <path
                                                    d="m237.248 512l265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312z" />
                                            </svg>
                                            </x-slot>
    
                                        </x-button-link-custom>
    
                                        <x-button-custom class="btn-sec" data-bs-toggle="modal" data-bs-target="#EditData" text="Editar" tooltipText="Editar datos del usuario."  >
                                            <x-slot name="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
                                            </svg>
                                            </x-slot>
                                        </x-button-custom>
    
                                    </div>
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
