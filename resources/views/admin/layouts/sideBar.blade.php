
<header class="sideBar-custom active flex-column">
    <div class="w-full flex-grow-1" id="sidebarContainer" class="sidebar-container">
        <div class="d-flex justify-content-center header-custom pt-2">
            {{-- <h4 class="fw-bold text-white m-0 align-self-center">Consultorio CUAltos</h4> --}}
            <div class=" px-1" id="hamburgerMenu">
                <img class="icons-custom" src="{{asset('images/hamburger.png')}}" />
            </div>
        </div>

        <div class="d-flex justify-content-center mt-3">
            <ul class="list-unstyled pt-3">
                <li> <i class="fa-solid fa-chart-simple"></i></li>
                <li> <i class="fa-solid fa-hospital-user"></i></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        
        {{-- <nav class="w-100 mt-4 flex-grow-1 d-flex justify-content-center " id="sidebarContent">
            <ul class="list-unstyled m-0">
                <li class="ms-2 d-flex Icons-custom">
                    <a href="{{ route('home')}}" class="link-custom-nav w-100 py-2 px-3 animated-icon">
                       
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
        </nav> --}}

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

 
@section('scripts')
@vite('resources/js/SideBar.js')
@endsection