<aside class="sideBar-custom active d-flex flex-column" id="container-sideBar-custom">
    <div class="w-full flex-grow-1" id="sidebarContainer">
        <div class="w-full d-flex justify-content-between align-items-center header-custom">
            <h4 class="text-white m-0 align-self-center compressed-text" id="title">Consultorio CUAltos</h4>
            <button class="hamburgerMenu btn d-none d-md-inline" id="btnOpenClose">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-custom-lg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                  </svg>                  
            </button>

            <button class="hamburgerMenu btn d-md-none" id="btn-close-sidebar-movil">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-custom-lg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                  </svg>
            </button>
        </div>
        <nav class="w-100 flex-grow-1" id="sidebarContent">
            <span class="ms-3 text-md-custom text-white compressed-text">Menú</span>
            <ul class="list-unstyled mt-3">
                <li class="ms-2 d-flex">
                    <a href="{{ route('home') }}" class="link-custom-nav py-1 px-2 animated-icon">
                        <i class="fa-solid fa-chart-simple"></i>
                        <span class="ms-3 text-md-custom compressed-text">Estadística</span>
                    </a>
                </li>
                <li class="ms-2 d-flex flex-column">
                    <a class="link-custom-nav py-1 px-2 animated-icon" data-bs-toggle="collapse" href="#Pacientes"
                        role="button" aria-expanded="false" aria-controls="Pacientes">
                        <div>
                            <i class="fa-solid fa-hospital-user"></i>
                            <span class="ms-3 text-md-custom compressed-text">Pacientes</span>
                        </div>
                    </a>
                    <div class="collapse Sub_menu bg-primary-custom pt-2" id="Pacientes">
                        <ul class="list-unstyled m-0">
                            <li class="d-flex">
                                <a href="{{ route('showPatients') }}" class="sublink-custom-nav py-1 animated-icon">
                                    <i class="fa-regular fa-address-book"></i>
                                    <span class="ms-1 text-md-custom compressed-text">Ver</span>
                                </a>
                            </li>
                            @role('Administrador')
                            <li class="d-flex">
                                <a href="{{ route('showForm') }}" class="sublink-custom-nav py-2 animated-icon">
                                    <i class="fa-solid fa-file-circle-plus"></i>
                                    <span class="ms-1 text-md-custom compressed-text">Agregar</span>
                                </a>
                            </li>
                            @endrole
                        </ul>
                    </div>
                </li>
                <li class="ms-2 d-flex">
                    <a href="" class="link-custom-nav px-2 animated-icon">
                        <i class="fa-brands fa-nutritionix"></i>
                        <span class="ms-3 text-md-custom compressed-text">Nutrición</span>
                    </a>
                </li>
                <li class="ms-2 d-flex">
                    <a href="{{ route('showAgenda') }}" class="link-custom-nav px-2 animated-icon">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span class="ms-3 text-md-custom compressed-text">Agenda</span>
                    </a>
                </li>
                <li class="ms-2 d-flex flex-column">
                    <a class="link-custom-nav py-1 px-2 animated-icon" data-bs-toggle="collapse" href="#Admin"
                        role="button" aria-expanded="false" aria-controls="Admin">
                        <div>
                            <i class="fa-solid fa-gear"></i>
                            <span class="ms-3 text-md-custom compressed-text">Administrar</span>
                        </div>
                    </a>
                    <div class="collapse Sub_menu bg-primary-custom pt-2" id="Admin">
                        <ul class="list-unstyled m-0">
                            <li class="d-flex">
                                <a href="" class="sublink-custom-nav py-1 animated-icon">
                                    <i class="fa-regular fa-address-book"></i>
                                    <span class="ms-3">Enfermedades</span>
                                </a>
                            </li>
                            @role('Administrador')
                            <li class="d-flex">
                                <a href="" class="sublink-custom-nav py-2 animated-icon">
                                    <i class="fa-solid fa-file-circle-plus"></i>
                                    <span class="ms-3">Alergias</span>
                                </a>
                            </li>
                            @endrole
                        </ul>
                    </div>
                </li>
                @role('Administrador')
                <li class="ms-2 d-flex flex-column">
                    <a class="link-custom-nav px-2 animated-icon" data-bs-toggle="collapse" href="#usuarios"
                        role="button" aria-expanded="false" aria-controls="usuarios">
                        <div>
                            <i class="fa-solid fa-users"></i>
                            <span class="ms-3 text-md-custom compressed-text">Usuarios</span>
                        </div>
                    </a>
                    <div class="collapse Sub_menu bg-primary-custom pt-2" id="usuarios">
                        <ul class="list-unstyled m-0">
                            <li class="d-flex">
                                <a href="{{route('users')}}" class="sublink-custom-nav py-1 animated-icon">
                                    <i class="fa-regular fa-address-book"></i>
                                    <span class="ms-3">Ver</span>
                                </a>
                            </li>
                            @role('Administrador')
                            <li class="d-flex">
                                <a href="" class="sublink-custom-nav py-2 animated-icon">
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

</aside>
@section('scripts')
    @vite('resources/js/SideBar.js')
@endsection
