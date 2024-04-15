@extends('admin.layouts.main')

@section('title', 'Usuarios')

@section('viteConfig')
@vite(['resources/sass/sideBar.scss', 'resources/sass/users.scss', 'resources/js/app.js'])

@endsection
@section('titleView','Usuarios del sistema')
<!-- Esto no se que hace pero lo puse jsjsjsj -->
@section('breadCrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="item-custom-link" href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a class="item-custom-link" href="{{ route('usuarios') }}">Usuarios</a></li>
        <li class="breadcrumb-item active" aria-current="page">Lista de usuarios</li>
</nav>
@endsection


@section('content')
<div class="container ">
    <div class="row justify-content-center ">
        <!-- <div class="col-md-12 mt-3 pt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb fw-bold">
                    <li class="breadcrumb-item "><a href="{{ route( 'home')}}">PaySoft</a></li>
                    <li class="breadcrumb-item " aria-current="page">Usuarios </li>
                </ol>
            </nav>
        </div> -->


        <div class="col-12 ">
            <div class="container ">
                <div class="row justify-content-center ">


                    <div class="col-12 ">

                        <div class="col-12 d-flex justify-content-center">
                            <h5 class="text-center"> Usuarios registrados en el sistema</h5>
                        </div>
                        <div class="col-12 d-flex justify-content-end align-items-center px-0 pt-3">
                            <input type="text" class="form-control" id="search" name="search" placeholder="Buscar por nombre o código." required style="width: 30%;">
                            <!-- Boton para agregar un nuevo usuario  -->
                            <abbr title="Clic para agregar un usuario al sistema.">
                                <a class="btn fst-normal ms-2 animated-icon button-add" type="button" id="confirm-report" tabindex="0" data-bs-toggle="modal" data-bs-target="#Add-User">
                                    <i class="fa-solid fa-user-plus pe-1"></i>
                                    Nuevo
                                </a>
                            </abbr>
                        </div>

                        <div class="position-relative mt-2 mx-3 pb-1">
                            <div class="position-absolute top-0 end-0">
                                <p>Totales: {{ $Contador-1 }}</p>
                            </div>
                        </div>


                        <div class="container pt-4">
                            <!-- cards para ver los diferentes usuarios registrados en el sistema -->
                            <div class="row">
                                @foreach ($users as $user)
                                <div class="col-xl-  col-md-3 mb-4 user-card">
                                    <div class="card text-center shadow" style="height: 100%;">
                                        <div class="card-header">
                                            <h5 class="mb-0 fw-normal">{{ $user->user_name }}</h5>
                                        </div>

                                        <div class="card-body pb-0 ">
                                            <h6 class="card-title">{{ $user->name }}</h6>
                                        </div>
                                        <p class="m-0 p-0 fst-italic"> {{ $user->role_name }}</p>

                                        <div class="card-footer">

                                            <div class="row justify-content-center">
                                                <div class="col-12 col-md-4">
                                                    <abbr title="Clic para resetear la contraseña del usuario.">
                                                        <button type="button" class="btn fst-normal btn-md confirmReset animated-icon button-next " data-id="{{ $user->user_name }}">
                                                            <i class="fa-solid fa-key"></i>
                                                        </button>
                                                    </abbr>
                                                </div>

                                                <div class="col-12 col-md-4">
                                                    <abbr title="Clic para editar los datos del usuario.">
                                                        <button type="button" class="btn fst-normal btn-md confirmEdit animated-icon button-add" data-id="{{ $user->id }}" data-username="{{ $user->user_name }}" data-name="{{ $user->name }}" data-role="{{ $user->role_id }}">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </abbr>
                                                </div>

                                                <div class="col-12 col-md-4 ">
                                                    <abbr title="Clic eliminar al usuario del sistema.">
                                                        <button type="button" class="btn fst-normal btn-md confirmDelet animated-icon button-cancel" data-id="{{ $user->user_name }}">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </abbr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div id="no-results-message" class="text-center pt-3" style="display: none;">
                                <p>No se encontraron resultados.</p>
                            </div>
                        </div>
                        <!-- Cierre de la card  -->

                    </div>
                </div>
            </div>

        </div>
    </div>



    <!-- Cierre de la card  -->

</div>
</div>
</div>

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








<!-- Modal de Confirmación para las diferentes acciones -->
<!-- <div class="modal fade" id="InfoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="title"> </h5>
             </div>
            <div class="modal-body text-center">
                <h5 id="texto-info"> </h5>

            </div>
            <div class="modal-footer">
             </div>
        </div>
    </div>
</div> -->


@vite(['resources/js/usuarios.js','resources/js/SideBar.js'])
<!-- Cargar archivo de js -->
<!-- <script src="{{ asset('js/usuarios.js') }}"></script> -->

@endsection