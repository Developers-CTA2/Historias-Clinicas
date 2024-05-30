@extends('admin.layouts.main')

@section('title', 'Agregar usuario')

@section('viteConfig')
    @vite(['resources/sass/users.scss'])
@endsection


@section('content')
    <div class="container ml-2">
        <!-- Card para mostrar todos los datos  -->
        <div id="detalles-container"></div>

        <div class="card">
            <div class="card-header text-center">
                Agregar un usuario al sistema
            </div>
            <div class="card-body">
                <div class="row col-12">
                    <p class="text-center p-0">Escribe el código del usuario a agregar.</p>
                    <div class="col-12 d-flex justify-content-center p-0 gap-2  mt-0">

                        <div class="form-group">
                            <label for="code">Código </label>
                            <input class="form-control form-disabled" type="text" name="code" id="code" maxlength="9">
                            <span class="text-danger fw-normal" style=" display: none;">Código no
                                válido.</span>
                        </div>
                        <div class="mt-3">
                            <button class="btn-sec fst-normal tooltip-container mt-2 px-2 py-1" type="button" id="Search">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 26 26">
                                    <path
                                        d="M10 .188A9.812 9.812 0 0 0 .187 10A9.812 9.812 0 0 0 10 19.813c2.29 0 4.393-.811 6.063-2.125l.875.875a1.845 1.845 0 0 0 .343 2.156l4.594 4.625c.713.714 1.88.714 2.594 0l.875-.875a1.84 1.84 0 0 0 0-2.594l-4.625-4.594a1.824 1.824 0 0 0-2.157-.312l-.875-.875A9.812 9.812 0 0 0 10 .188M10 2a8 8 0 1 1 0 16a8 8 0 0 1 0-16M4.937 7.469a5.446 5.446 0 0 0-.812 2.875a5.46 5.46 0 0 0 5.469 5.469a5.516 5.516 0 0 0 3.156-1a7.166 7.166 0 0 1-.75.03a7.045 7.045 0 0 1-7.063-7.062c0-.104-.005-.208 0-.312" />
                                </svg>
                                Buscar
                                <span class="tooltip-text">Buscar el código.</span>
                            </button>
                        </div>
                    </div>

                    <div class="cont-user-data mt-3 d-none">
                        {{-- Contenedor de los datos personales del usuario --}}
                        <div class="row col-12 mx-2 p-1">
                            <h5 class="p-0 m-0"> Datos personales </h5>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group col-12 pt-2">
                                    <p class="fw-bold mb-0">Código</p>
                                    <div class="mt-0" id="R-code"> 2921073 </div>
                                </div>
                            </div> <!-- FIN contenedor 1  -->
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group col-12 pt-2">
                                    <p class="fw-bold mb-0">Nombre</p>
                                    <div class="mt-0" id="R-nombre"> SOLANO GUZMÁN EDUARDO</div>
                                </div>
                            </div> <!-- FIN contenedor 1  -->
                        </div>
                        {{-- Contenedor de los datos del usuario --}}
                        <div class="row col-12 mx-2 p-1 mt-1">
                            <h5 class="p-0 m-0"> Datos del usuario </h5>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group col-12 pt-2">
                                    {{-- <p class="fw-bold mb-0">Tipo de usuario</p> --}}
                                    <label for="Usertype">Tipo de usuario <span class="red-color"> *</span></label>
                                    <select class="form-control" id="Usertype" name="Usertype">
                                        <option value="1">Doctor</option>
                                        <option value="2">Prestador de medicina</option>
                                        <option value="3">Prestador de nutrición</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group col-12 pt-2">
                                    <label for="Useremail">Correo <span class="red-color"> *</span></label>
                                    <input class="form-control form-disabled mb-2" type="text" name="Useremail"
                                        id="Useremail">
                                </div>

                                <div class="form-group col-12 pt-2">
                                    <label for="Usercedula">Cedula <span class="red-color"> *</span></label>
                                    <input class="form-control form-disabled mb-2" type="text" name="Usercedula"
                                        id="Usercedula">
                                </div>
                            </div>

                        </div>



                        <div class="col-12 p-0 mt-2">
                            <div class="row">
                                <div class="d-flex justify-content-end">
                                    <div class="mx-2">
                                        <a href="{{ route('users') }}" class="btn-red fst-normal tooltip-container p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 1024 1024">
                                                <path d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64" />
                                                <path
                                                    d="m237.248 512l265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312z" />
                                            </svg>
                                            Cancelar
                                            <span class="tooltip-text">Volver a la ventana anterior.</span>
                                        </a>
                                    </div>
                                    <div class="">
                                        <button href="" class="btn-sec fst-normal tooltip-container p-1"
                                            type="button" data-bs-toggle="modal" data-bs-target="#EditData">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M9.55 13.15L18 4.7q.3-.3.713-.3t.712.3t.3.712t-.3.713L10.25 15.3q-.3.3-.7.3t-.7-.3l-4.275-4.275q-.3-.3-.288-.712T4.6 9.6t.713-.3t.712.3zM6 20q-.425 0-.712-.288T5 19t.288-.712T6 18h12q.425 0 .713.288T19 19t-.288.713T18 20z" />
                                            </svg>
                                            Guardar
                                            <span class="tooltip-text">Editar datos.</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 p-0 mt-2 buttons-cont">
                        <div class="row">
                            <div class="d-flex justify-content-end">
                                <div class="mx-2">
                                    <a href="{{ route('users') }}" class="btn-red fst-normal tooltip-container p-1">
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

                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>


    </div>

@endsection

@section('scripts')
    @vite('resources/js/users/AddUser.js')
@endsection



{{-- 
@section('content')
<div class="container ">
  
   
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


@endsection --}}
