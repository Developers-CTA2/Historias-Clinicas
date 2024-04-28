@extends('admin.layouts.main')

@section('title', 'Agregar nuevo paciente')

@section('viteConfig')
@vite(['resources/sass/sideBar.scss','resources/sass/loadingScreen.scss', 'resources/sass/StyleForm.scss','resources/sass/colorButtons.scss', 'resources/sass/bar.scss','resources/js/app.js'])
@endsection

<!-- Esto no se que hace pero lo puse jsjsjsj -->
@section('breadCrumb')
<nav aria-label="breadcrumb" class="d-flex justify-content-between align-items-center">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a class="item-custom-link" href="{{ route('home') }}">Usuarios</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Dar de alta</li>
    </ol>
    <span class="text-end">{{ now()->setTimezone('America/Mexico_City')->format('d F Y') }}</span>
</nav>
@endsection

@section('content')
<div class="container ">
    <div>
        <h4 class="fw-bold">Agregar un usuario</h4>
        <h6>Ingresa los datos correspondientes</h6>
    </div>
    <hr>
    <div id="paso1">
        <div class="mt-1 col-12 d-flex justify-content-center align-items-center" id="texto">
            <p style="font-size: 1rem;"> Ingresa los datos corrrespondientes </p>
        </div>
        <div class="row mx-2 mb-3">
            <div class="col-4 text-center ">
                <label for="user_name" class="fw-normal">Código</label>
                <input type="text" class="form-control" id="user_name" placeholder="Código de trabajador" maxlength="7">
            </div>
            <div class="col-4">
                <a class="btn btn-primary fst-normal ms-2 animated-icon px-2 mt-4" type="button" id="SearchCode" tabindex="0">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Buscar
                </a>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center align-items-center paso2">
        <p class="text-center pt-0" style="font-size: 1rem;">Datos del usuario </p>
        <div class="row col-12 mb-3">
            <div class="col-3">
                <div for="code_U" class="fw-normal">Código:</div>
                <span id="code_U">2726319</span>
            </div>

            <div class="col-9 ">
                <div for="name" class="fw-normal">Nombre completo:</div>
                <span id="name">SOLANO GUZMAN EDUARDO</span>
            </div>
        </div>
        <div class="form-group">
            <div class="row pt-2">
                <div class="form-group col-md-6 col-sm-12 mb-2">
                    <p style="font-size: 1rem;"> Selecciona un tipo de usuario</p>
                    <div class="d-flex justify-content-center gap-2">
                        <select class="form-control" name="sex" id="sex">
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="1">Masculino</option>
                            <option value="2">Femenino</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6 col-sm-12 mb-2">
                    <label for="codigo">Cedula:</label>
                    <input class="form-control" type="text" id="codigo" name="codigo" pattern="[0-9]{7}" maxlength="7">
                    <span class="text-danger fw-normal" style=" display: none;">Código no válido.</span>

                </div>
            </div>
        </div>

        <p class="mt-2 text-center mb-0" style="font-size: 0.75rem;"> La contraseña por defecto será <span class="fw-bold">Cu@ltos2024</span>.</p>
    </div>
    <div class="modal-footer mb-0 pb-0 mt-0">
        <button type="button" class="btn button-eliminar border">Cancelar</button>
        <abbr title="Guardar el nuevo usuario en el sistema.">
            <button class="btn btn-primary border" type="button" id="saveUser"> Guardar </button>
        </abbr>
    </div>

</div>


@endsection