@extends('admin.layouts.main')

@section('title', 'Detalles de usuarios')

@section('viteConfig')
@vite(['resources/sass/sideBar.scss','resources/sass/loadingScreen.scss', 'resources/sass/StyleForm.scss','resources/sass/colorButtons.scss', 'resources/sass/bar.scss','resources/js/app.js'])
@endsection

<!-- Esto no se que hace pero lo puse jsjsjsj -->
@section('breadCrumb')
<nav aria-label="breadcrumb" class="d-flex justify-content-between align-items-center">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a class="item-custom-link" href="{{ route('usuarios') }}">Usuarios</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Detalles</li>
    </ol>
    <span class="text-end">{{ now()->setTimezone('America/Mexico_City')->format('d F Y') }}</span>
</nav>
@endsection

@section('content')
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
                        <p class="fw-bold mb-0">Tipo de usuario:</p>
                        <div class="mt-0" id="User_Tip">
                            @foreach ($usuario->roles as $rol)
                            {{ $rol->name }}
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group pt-2 col-12">
                        <p class="fw-bold mb-0">Cedula:</p>
                        <div class="mt-0" id="User_Cedula">{{ $usuario->role_name}}</div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group pt-2 col-12">
                        <p class="fw-bold mb-0">Codigo:</p>
                        <div class="mt-0" id="User_Code">{{ $usuario->user_name}}</div>
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
</div>
@endsection