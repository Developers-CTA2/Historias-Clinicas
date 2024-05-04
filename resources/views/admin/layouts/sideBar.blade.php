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
                                <a href="{{ route('showPatients') }}" class="sublink-custom-nav w-100 py-2 px-3 animated-icon">
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
                    <a href="{{ route('showAgenda')}}" class="link-custom-nav w-100 py-2 px-3 animated-icon">
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
                            <li class="d-flex ps-1 mb-2 pe-2">
                                <a href="{{route('usuarios')}}" class="sublink-custom-nav w-100 py-2 px-3 animated-icon">
                                    <i class="fa-regular fa-address-book"></i>
                                    <span class="ms-3">Ver</span>
                                </a>
                            </li>
                            @role('Administrador')
                            <li class="d-flex ps-1 mb-2 pe-2">
                                <a href="{{ route('showUsers') }}" class="sublink-custom-nav w-100 py-2 px-3  animated-icon">
                                    <i class="fa-solid fa-file-circle-plus"></i>
                                    <span class="ms-3">Agregar</span>
                                </a>
                            </li>
                            @endrole
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
                <button type="button" class="btn button-cancel close_modal border" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>

                <button class="btn button-next d-none border" id="confirm"> Guardar</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
@vite('resources/js/SideBar.js')
@endsection