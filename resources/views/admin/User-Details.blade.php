@extends('admin.layouts.main')

@section('title', 'Detalles de usuarios')

@section('viteConfig')
    @vite(['resources/sass/User-Details.scss'])
@endsection

<!-- Esto no se que hace pero lo puse jsjsjsj -->
@section('breadCrumb')
    <nav aria-label="breadcrumb" class="d-flex justify-content-between align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="item-custom-link" href="{{ route('users') }}">Usuarios</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Detalles</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        <!-- Card para mostrar todos los datos  -->
        <div class="card">
            <div class="card-header text-center">
                Detalles del usuario
            </div>
            <div class="card-body row mx-2">
                <div class="content-custom">
                    <div class="row col-12">
                        <div class="col-lg-6 col-md-6 col-sm-12 border">
                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-12 pt-2">
                                        <p class="fw-bold mb-0">Nombre:</p>
                                        <div class="mt-0" id="User_Name">{{ $usuario->name }}</div>
                                    </div>
                                    <div class="form-group col-12 pt-2">
                                         <p class="fw-bold mb-0">Correo:</p>
                                        <div class="mt-0" id="email">{{ $usuario->name }}</div>
                                    </div>

                                    <div class="form-group col-12 pt-2">
                                         <p class="fw-bold mb-0">Cedula:</p>
                                        <div class="mt-0" id="Cedula">{{ $usuario->name }}</div>

                                    </div>
                                    <div class="form-group col-12 pt-2">
                                         <p class="fw-bold mb-0">Número de consultas:</p>
                                        <div class="mt-0" id="Cedula">{{ $usuario->name }}</div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- FIN contenedor 1  -->

                        <div class="col-lg-6 col-md-6 col-sm-12 border">
                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-12 pt-2">
                                        <p class="fw-bold mb-0">Código:</p>
                                        <div class="mt-0" id="User_Name">{{ $usuario->user_name }}</div>
                                    </div>
                                    <div class="form-group col-12 pt-2">
                                        <p class="fw-bold mb-0">Rol/Tipo de usuarios:</p>
                                        <div class="mt-0" id="User_Name">{{ $roleName}}</div>
                                    </div>
                                    <div class="form-group col-12 pt-2">
                                        <p class="fw-bold mb-0">Fecha de ingreso al sistema:</p>
                                        <div class="mt-0" id="User_Name">{{ $usuario->created_at }}</div>
                                    </div>
                                    <div class="form-group col-12 pt-2">
                                        <p class="fw-bold mb-0">Estado:</p>
                                        <div class="mt-0" id="User_Name">{{ $usuario->estado }}</div>
                                    </div>
                        </div><!-- Fin de contenedor 2 -->

                    </div>
                    
                </div>
            </div> <!-- FIN contenedor 1  -->
            {{-- <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a> --}}
        </div>
    </div>


    <!--Boton de agregar paciente -->
    {{-- <div class="col-12 mb-2 d-flex justify-content-end">
            <a href="{{ route('showForm') }}" class="btn-blue fst-normal tooltip-container" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 icons-style">
                    <path
                        d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
                </svg>
                Usuario
                <span class="tooltip-text">Agregar un usuario</span>
            </a>
        </div> --}}
    <!-- Tabla para mostrar los datos  -->
    <div class="col-12 cont-principal"> <!-- Ajusta el tamaño de la tabla para dispositivos grandes -->


    </div>
    </div>


{{-- 
    <div class="container">
        <div>
            <h4 class="fw-bold">Detalles de un usuario</h4>
            <h6>Lista de los detalles de un usuario</h6>
        </div>
        <hr>
        <div class="row justify-content-center ">
            <div class="row bg-color-form pb-1">
                <h5 class="text-center pt-3">Datos del usuario</h5>
                <div class="row col-12 pb-2">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group pt-2 col-12">
                            <p class="fw-bold mb-0">Nombre:</p>
                            <div class="mt-0" id="User_Name">{{ $usuario->name }}</div>
                        </div>
                        <div class="form-group pt-2 col-12">
                             <p class="fw-bold mb-0">Correo:</p>
                            <div class="mt-0" id="email">{{ $usuario->name }}</div>
                        </div>
                        <div class="form-group pt-2 col-12">
                            <p class="fw-bold mb-0">Cedula:</p>
                            <div class="mt-0" id="User_Cedula">{{ $usuario->role_name }}</div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group pt-2 col-12">
                            <p class="fw-bold mb-0">Codigo:</p>
                            <div class="mt-0" id="User_Code">{{ $usuario->user_name }}</div>
                        </div>

                        <div class="form-group">
                            <div class="row pt-2">
                                <div class="form-group col-md-6 col-sm-12">
                                    <p class="fw-bold mb-0">Estado:</p>
                                    <div class="mt-0" id="User_Estado">Activo</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group pt-2 col-12">
                            <p class="fw-bold mb-0">Numero de consultas:</p>
                            <div class="mt-0" id="User_Consulta"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}



@endsection

{{-- 
@section('content')

@endsection --}}
