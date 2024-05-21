@extends('admin.layouts.main')

@section('title', 'Agregar nuevo paciente')

@section('viteConfig')
@vite( 'resources/sass/StyleForm.scss')
@endsection

@section('content')
<div class="container ">
    {{-- <div>
        <h4 class="fw-bold">Agregar un usuario</h4>
        <h5>Ingresa los datos correspondientes</h5>
    </div> --}}
   
    <div id="paso1" class="mb-5">
        <div class="mt-1 col-12 d-flex align-items-center" id="texto">
            <p style="font-size: 0.9rem;"> Escribe el código del usuario a agregar</p>
        </div>
        <div class="row justify-content-center mx-2 mb-3">
            <div class="col-4">
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
    <div class="row d-flex justify-content-center align-items-center mb-5 paso2 d-none">
        <p class="text-center mb-5 fw-semibold fs-5">Datos del usuario </p>
        <div class="row justify-content-center col-12 mb-3">
            <div class="col-3">
                <div for="code_U" class="fw-normal">Código:</div>
                <span id="code_U">------</span>
            </div>

            <div class="col-3">
                <div for="name" class="fw-normal">Nombre completo:</div>
                <span id="name">-----</span>
            </div>
        </div>
        <div class="form-group">
            <div class="row pt-2 justify-content-center">
                <div class="form-group col-md-4 col-sm-12 mb-2">
                    <label for="codigo" class="text-center">Selecciona un tipo de usuario:</label>
                    <div class="d-flex justify-content-center gap-2">
                        <select class="form-control" name="sex" id="tipo_user">
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="1">Administrador</option>
                            <option value="2">Prestador de medicina</option>
                            <option value="3">Prestador de nutrición</option>
                            <option value="4">Paciente</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-4 col-sm-12 mb-2">
                    <label for="codigo" class="text-center">Cedula:</label>
                    <input class="form-control" type="text" id="codigo" name="codigo" pattern="[0-9]{7}" maxlength="7">
                    <span class="text-danger fw-normal" style=" display: none;">Código no válido.</span>
                </div>
            </div>
        </div>

        <p class="mt-2 text-center mb-0" style="font-size: 0.75rem;"> La contraseña por defecto será <span class="fw-bold">Cu@ltos2024</span>.</p>
        <div class="modal-footer mb-0 pb-0 mt-0">
            <button type="button" class="btn button-eliminar border">Cancelar</button>
            <abbr title="Guardar el nuevo usuario en el sistema.">
                <button class="btn btn-primary border" type="button" id="saveUser"> Guardar </button>
            </abbr>
        </div>
    </div>

</div>


@endsection