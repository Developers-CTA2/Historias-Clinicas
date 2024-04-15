<header class="sideBar-custom active position-fixed z-10 d-flex flex-column">
    <div class="w-full flex-grow-1" id="sidebarContainer" class="sidebar-container">
        <div class="w-full d-flex justify-content-between header-custom py-3 px-2">
            <h4 class="fw-bold text-white m-0 align-self-center">Consultorio CUAltos</h4>
            <div class=" px-1" id="hamburgerMenu">
                <img class="icons-custom" src="{{asset('images/hamburger.png')}}" />
            </div>
        </div>
        <nav class="w-100 mt-4 flex-grow-1 px-3" id="sidebarContent">
            <ul class="list-unstyled m-0">
                <li class="ms-2 d-flex">
                    <a href="{{ route('home')}}" class="link-custom-nav w-100 py-2 px-3 animated-icon">
                        <i class="fa-solid fa-chart-simple"></i>
                        <span class="ms-3 text-md-custom">Estadistica</span>
                    </a>  
                </li>
     
                <li class="ms-2 d-flex flex-column">
                    <a class="link-custom-nav w-100 py-2 px-3 d-flex justify-content-between align-items-center animated-icon" data-bs-toggle="collapse" href="#reportes" role="button" aria-expanded="false" aria-controls="reportes">
                        <div>
                            <i class="fa-solid fa-hospital-user"></i>
                            <span class="ms-3 text-md-custom">Pacientes</span>
                        </div>
                    </a>
                    <div class="collapse bg-primary-custom ps-3 pt-2" id="reportes">
                        <ul class="list-unstyled m-0">
                            <li class="d-flex ps-1 mb-2 pe-2">
                                <a href="" class="sublink-custom-nav w-100 py-2 px-3 animated-icon">
                                    <i class="fa-regular fa-address-book"></i>
                                    <span class="ms-3">Ver</span>
                                </a>
                            </li>
                            @role('Administrador')
                            <li class="d-flex ps-1 mb-2 pe-2">
                                <a href="{{ route('showForm') }}" class="sublink-custom-nav w-100 py-2 px-3  animated-icon">
                                    <i class="fa-solid fa-file-circle-plus"></i>
                                    <span class="ms-3">Dar de alta</span>
                                </a>
                            </li>
                            @endrole
                        </ul>
                    </div>
                </li>

                <li class="ms-2 d-flex">
                    <a href="{{ route('home')}}" class="link-custom-nav w-100 py-2 px-3 animated-icon">
                        <i class="fa-solid fa-list-ul"></i>
                        <span class="ms-3 text-md-custom">Enfermedades</span>
                    </a>  
                </li>

                <li class="ms-2 d-flex">
                    <a href="{{ route('home')}}" class="link-custom-nav w-100 py-2 px-3 animated-icon">
                        <i class="fa-brands fa-nutritionix"></i>
                        <span class="ms-3 text-md-custom">Nutrición</span>
                    </a>  
                </li>
                <li class="ms-2 d-flex">
                    <a href="{{ route('home')}}" class="link-custom-nav w-100 py-2 px-3 animated-icon">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span class="ms-3 text-md-custom">Agenda</span>
                    </a>  
                </li>

                @role('Administrador')
                <li class="ms-2 d-flex flex-column">
                    <a class="link-custom-nav w-100 py-2 px-3 d-flex justify-content-between align-items-center animated-icon" data-bs-toggle="collapse" href="#usuarios" role="button" aria-expanded="false" aria-controls="usuarios">
                        <div>
                            <i class="fa-solid fa-users"></i>
                            <span class="ms-3 text-md-custom">Usuarios</span>
                        </div>
                    </a>
                    <div class="collapse bg-primary-custom ps-3 pt-2" id="usuarios">
                        <ul class="list-unstyled m-0">
                            <li class="d-flex border-custom-sublinks ps-1 mb-2 pe-2">
                                <a href="{{route('usuarios')}}" class="sublink-custom-nav w-100 py-2 px-3 animated-icon">
                                    <i class="fa-regular fa-address-book"></i>
                                    <span class="ms-3">Ver</span>
                                </a>
                            </li>

                            <li class="d-flex border-custom-sublinks ps-1 mb-2 pe-2">
                                <a href="#" class="sublink-custom-nav w-100 py-2 px-3 animated-icon" data-bs-toggle="modal" data-bs-target="#Add-User">
                                    <i class="fa-solid fa-file-circle-plus"></i>
                                    <span class="ms-3 ">Agregar</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </li>
                @endrole


            </ul>
        </nav>

    </div>
    <div class="w-full d-flex justify-content-center py-3">
        <div class="settings-custom d-flex align-items-center justify-content-between">
            <p class="px-1 text-white flex-grow-1 m-0 hide-username">{{ $userName }}</p>
            <div class="dropdown">
                <button class="btn p-0 border-none-custom" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="icons-custom-sm" src="{{asset('images/settings.png')}}" />
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item modal-hover py-2" href="#" data-bs-toggle="modal" data-bs-target="#changePass">Cambiar contraseña</a></li>
                    <li>
                        <form action=" {{route('logout')}}" method="POST">
                            @csrf
                            <button class="modal-hover w-100 btn-form-logout py-2" type="submit">Cerrar sesión</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<!-- Modal para cambiar la contraseña-->
<div class="modal fade" id="changePass" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #17749F;">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Cambiar contraseña </h5>
                <button type="button" class="btn-close text-white btn-cerrar" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group pt-1 pb-2 cont pt-0" id="step-1">
                            <p class="text-center "> Ingresa tu contraseña actual </p>

                            <div class="alert d-none text-center pb-0 m-0 mb-1" id="alertMessage">
                                <p class="texto"></p>
                            </div>
                           

                                <div class="row ">
                                    <div class="col-8 text-center">
                                        <label for="contrasena" class="fw-normal ">Contraseña</label>
                                        <input type="password" name="contrasena" id="contrasena" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-primary mt-4" id="confirmPass"> Confirmar</button>
                                    </div>
                                </div>
                            
                        </div>
                        <!-- Paso 2  -->
                        <div class="form-group d-none" id="step-2">
                        
                            <p class="text-center"> Ingresa la nueva contraseña </p>
                            <div class="alert d-none text-center pb-0 m-0 mb-1" id="alertMessage2">
                                <p class="texto"></p>
                            </div>
                            
                                <div class="row ">
                                    <div class="col-6 text-center">
                                        <label for="newpass" class="fw-normal">Contraseña</label>
                                        <input type="password" name="newpass" id="newpass" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="col-6">
                                        <label for="confirmpass" class="fw-normal">confirma la contraseña</label>
                                        <input type="password" name="confirmpass" id="confirmpass" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            
                            <div>
                                <p class="text-center pt-3 mb-" style="font-size: 0.8rem;"> La contraseña debe contener </p>
                                <p class="text-center mt-0" style="font-size: 0.7rem;"> Al menos 4 caracteres, al menos una mayúscula, al menos una minúscula y un caracter especial como: @, #, $, %, ^, &, +, o =.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn button-cancel close_modal" data-bs-dismiss="modal" aria-label="Close">Cerrar</button> -->
                <button type="button" class="btn button-cancel close_modal border" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>

                <button class="btn button-next d-none border" id="confirm"> Guardar</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal para agregar a un nuevo usuario al sistema-->
<div class="modal fade" id="Add-User" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="confirmModalLabel">Agregar un nuevo usuario </h5>
                <button type="button" class="btn-close close_modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">

                <!-- Alerta de confirmacion o error  -->
                <div id="alerta" class="alert d-none pb-0 m-0 text-center" role="alert">
                    <p class="texto"></p>
                </div>
                <!-- Inicio del formulario -->
                <!-- <form id="add-user" method="post">
                    @csrf -->

                <div id="paso1">
                    <div class="mt-1 col-12 d-flex justify-content-center align-items-center" id="texto">
                        <p style="font-size: 1rem;"> Ingresa los datos corrrespondientes </p>
                    </div>
                    <div class="row mx-2 mb-3">
                        <div class="col-8 text-center ">
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

                <div class="row d-flex justify-content-center align-items-center paso2 d-none">
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

                        <!-- <input type=" text" class="form-control" id="name" placeholder="Ejemplo: SOLANO GUZMÁN EDUADARDO" oninput="this.value = this.value.toUpperCase()">
                            <p style="font-size: 0.75rem;">Escribe el nombre completo comenzando por Apellidos <br>La contraseña por defecto será <span class="fw-bold">Cu@ltos2024</span>. </p> -->

                    </div>

                    <hr>
                    <div class="col-12 mb-3">
                        <p style="font-size: 1rem;"> Selecciona un tipo de usuario</p>
                        <div class="d-flex justify-content-center gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Tipo_Usuario" id="op1" value="2" checked>
                                <label class="form-check-label" for="op1">
                                    Lectura
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Tipo_Usuario" id="op2" value="1">
                                <label class="form-check-label" for="op2">
                                    Administrador
                                </label>
                            </div>
                        </div>
                        <p class="mt-2 text-center mb-0" style="font-size: 0.75rem;"> La contraseña por defecto será <span class="fw-bold">Cu@ltos2024</span>.</p>
                    </div>

                </div>
                <div class="modal-footer mb-0 pb-0 mt-0">
                    <!-- <a class="btn btn-primary mt-2 animated-icon" id="SearchCode"> <i class="fa-solid fa-magnifying-glass px-2 "> Buscar </i></a> -->


                    <button type="button" class="btn button-cancel close_modal border" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>

                    <abbr title="Guardar el nuevo usuario en el sistema.">
                        <button class="btn button-next border" type="button" id="saveUser"> Guardar </button>
                    </abbr>
                </div>
                <!-- </form> -->
                <!-- Fin del formulario -->
            </div>
        </div>
    </div>
</div>

@section('scripts')
@vite('resources/js/SideBar.js')
@endsection