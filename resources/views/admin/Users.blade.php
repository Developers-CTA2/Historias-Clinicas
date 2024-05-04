@extends('admin.layouts.main')

@section('title', 'Usuarios')

@section('viteConfig')
@vite(['resources/sass/sideBar.scss', 'resources/sass/users.scss', 'resources/js/app.js'])

@endsection
<!-- Esto no se que hace pero lo puse jsjsjsj -->
@section('breadCrumb')
<nav aria-label="breadcrumb" class="d-flex justify-content-between align-items-center">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="item-custom-link" href="{{ route('usuarios') }}">Usuarios</a></li>
        <li class="breadcrumb-item active" aria-current="page">Lista de usuarios</li>
    </ol>
    <span class="text-end">{{ now()->setTimezone('America/Mexico_City')->format('d F Y') }}</span>
</nav>
@endsection

@section('content')

<div class="container">
    <div>
        <h4 class="fw-bold">Lista de usuarios</h4>
        <h6>Lista de usuarios registrados en el sistema</h6>
    </div>
    <hr>
</div>
<!-- Tabla de usuarios -->

<div class="container">
    <div class="col-12 mt-0 pt-0"> <!-- Ajusta el tamaño de la tabla para dispositivos grandes -->
        <div id="Tabla-Usuarios"></div>
    </div>
</div>

  

<!-- Modal de Confirmación para resetear-->
<div class="modal fade" id="confirmationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="confirmModalLabel">Confirmación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h5 class="pb-2"> ¿Está seguro de restablecer la contraseña?</h5>
                <p>La contraseña cambiará a <span class="fw-bold">Cu@ltos2024</span></p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="boton-confirm"> Cambiar </button>
            </div>
        </div>
    </div>
</div>



<!-- Modal de Confirmación para Borrar a un uausrio del sistema -->
<div class="modal fade" id="confirmDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="confirmModalLabel">Eliminar usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h5 class="pb-2"> ¿Está seguro de eliminar al usuario del sistema?</h5>
                <p>El usuario ya no podra acceder a sistema.</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="boton-delete"> Borrar </button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Para editar los datos del usuario  -->
<div class="modal fade" id="EditData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="confirmModalLabel">Editar datos </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <!-- <h5 class="pb-2"> ¿Está seguro de eliminar al usuario del sistema?</h5>
                <p>El usuario ya no podra acceder a sistema.</p> -->

                <div class="mt-1 pt-0 col-12 d-flex justify-content-center align-items-center" id="texto">
                    <p style="font-size: 1rem;"> Edita los campos erróneos </p>
                </div>

                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-5 col-sm-10  col-md-5 text-center mt-1">
                        <label for="user_nameE" class="fw-normal">Código</label>
                        <input type="text" class="form-control" id="user_nameE" placeholder="Código de trabajador" maxlength="10">
                    </div>
                    <div class="mt-1 col-7 col-sm-12 col-md-7 ">
                        <p style="font-size: 0.8rem;"> Tipo de usuario</p>
                        <div class="d-flex justify-content-center gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Tipo_UsuarioE" id="op1E" value="2" checked>
                                <label class="form-check-label" for="op1E">
                                    Lectura
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Tipo_UsuarioE" id="op2E" value="1">
                                <label class="form-check-label" for="op2E">
                                    Administrador
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-10 text-center mt-3">
                        <label for="nameE" class="fw-normal">Nombre completo</label>
                        <input type="text" class="form-control" id="nameE" placeholder="Ejemplo: SOLANO GUZMÁN EDUADARDO" oninput="this.value = this.value.toUpperCase()">
                        <p style="font-size: 0.75rem;">Escribe el nombre completo comenzando por Apellidos</p>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="guardar-edit"> Guardar </button>
            </div>
        </div>
    </div>
</div>

@vite(['resources/js/usuarios.js','resources/js/SideBar.js','resources/js/seeUsers.js'])
@endsection