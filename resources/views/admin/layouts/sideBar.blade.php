<aside class="sideBar-custom active d-flex flex-column">
    <div class="w-full flex-grow-1" id="sidebarContainer">
        <div class="w-full d-flex justify-content-center header-custom">
            <h4 class="fw-bold text-white m-0 align-self-center hide-text">Consultorio CUAltos</h4>
            <div class="hamburgerMenu">
                <img class="icons-custom" src="{{ asset('images/hamburger.png') }}" />
            </div>
        </div>
        <nav class="w-100 flex-grow-1" id="sidebarContent">
            <span class="ms-3 text-md-custom text-white hide-text">Menú</span>
            <ul class="list-unstyled mt-3">
                <li class="ms-2 d-flex">
                    <a href="{{ route('home') }}" class="link-custom-nav py-1 px-2 animated-icon">
                        <i class="fa-solid fa-chart-simple"></i>
                        <span class="ms-3 text-md-custom hide-text">Estadística</span>
                    </a>
                </li>
                <li class="ms-2 d-flex flex-column">
                    <a class="link-custom-nav py-1 px-2 animated-icon" data-bs-toggle="collapse" href="#Pacientes"
                        role="button" aria-expanded="false" aria-controls="Pacientes">
                        <div>
                            <i class="fa-solid fa-hospital-user"></i>
                            <span class="ms-3 text-md-custom hide-text">Pacientes</span>
                        </div>
                    </a>
                    <div class="collapse Sub_menu bg-primary-custom pt-2" id="Pacientes">
                        <ul class="list-unstyled m-0">
                            <li class="d-flex">
                                <a href="{{ route('showPatients') }}" class="sublink-custom-nav py-1 animated-icon">
                                    <i class="fa-regular fa-address-book"></i>
                                    <span class="ms-1 text-md-custom hide-text">Ver</span>
                                </a>
                            </li>
                            @role('Administrador')
                            <li class="d-flex">
                                <a href="{{ route('showForm') }}" class="sublink-custom-nav py-2 animated-icon">
                                    <i class="fa-solid fa-file-circle-plus"></i>
                                    <span class="ms-1 text-md-custom hide-text">Agregar</span>
                                </a>
                            </li>
                            @endrole
                        </ul>
                    </div>
                </li>
                <li class="ms-2 d-flex">
                    <a href="" class="link-custom-nav px-2 animated-icon">
                        <i class="fa-brands fa-nutritionix"></i>
                        <span class="ms-3 text-md-custom hide-text">Nutrición</span>
                    </a>
                </li>
                <li class="ms-2 d-flex">
                    <a href="{{ route('showAgenda') }}" class="link-custom-nav px-2 animated-icon">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span class="ms-3 text-md-custom hide-text">Agenda</span>
                    </a>
                </li>
                <li class="ms-2 d-flex flex-column">
                    <a class="link-custom-nav py-1 px-2 animated-icon" data-bs-toggle="collapse" href="#Admin"
                        role="button" aria-expanded="false" aria-controls="Admin">
                        <div>
                            <i class="fa-solid fa-gear"></i>
                            <span class="ms-3 text-md-custom hide-text">Administrar</span>
                        </div>
                    </a>
                    <div class="collapse Sub_menu bg-primary-custom pt-2" id="Admin">
                        <ul class="list-unstyled m-0">
                            <li class="d-flex">
                                <a href="{{ route('showPatients') }}" class="sublink-custom-nav py-1 animated-icon">
                                    <i class="fa-regular fa-address-book"></i>
                                    <span class="ms-3">Enfermedades</span>
                                </a>
                            </li>
                            @role('Administrador')
                            <li class="d-flex">
                                <a href="{{ route('showForm') }}" class="sublink-custom-nav py-2 animated-icon">
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
                            <span class="ms-3 text-md-custom hide-text">Usuarios</span>
                        </div>
                    </a>
                    <div class="collapse Sub_menu bg-primary-custom pt-2" id="usuarios">
                        <ul class="list-unstyled m-0">
                            <li class="d-flex">
                                <a href="" class="sublink-custom-nav py-1 animated-icon">
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
    <div class="w-full d-flex justify-content-center py-3">
        <div class="settings-custom d-flex align-items-center justify-content-center">
            <p class="text-white flex-grow-1 m-0 hide-text">Cerrar sesión</p>
            <div class="dropdown">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn p-0 border-none-custom">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-6 h-6 btn-form-logout animated-icon">
                            <path fill-rule="evenodd"
                                d="M7.5 3.75A1.5 1.5 0 0 0 6 5.25v13.5a1.5 1.5 0 0 0 1.5 1.5h6a1.5 1.5 0 0 0 1.5-1.5V15a.75.75 0 0 1 1.5 0v3.75a3 3 0 0 1-3 3h-6a3 3 0 0 1-3-3V5.25a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3V9A.75.75 0 0 1 15 9V5.25a1.5 1.5 0 0 0-1.5-1.5h-6Zm5.03 4.72a.75.75 0 0 1 0 1.06l-1.72 1.72h10.94a.75.75 0 0 1 0 1.5H10.81l1.72 1.72a.75.75 0 1 1-1.06 1.06l-3-3a.75.75 0 0 1 0-1.06l3-3a.75.75 0 0 1 1.06 0Z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>
@section('scripts')
    @vite('resources/js/SideBar.js')
@endsection
