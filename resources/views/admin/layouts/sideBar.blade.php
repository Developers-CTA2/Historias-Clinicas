<aside class="sideBar-custom active d-flex flex-column" id="container-sideBar-custom">
    <div class="w-full flex-grow-1" id="sidebarContainer">
        <div class="w-full d-flex justify-content-between align-items-center header-custom">
            <h4 class="text-white m-0 align-self-center compressed-text" id="title">Consultorio CUAltos</h4>
            <button class="hamburgerMenu btn d-none d-md-inline" id="btnOpenClose">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="icon-custom-lg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </button>

            <button class="hamburgerMenu btn d-md-none" id="btn-close-sidebar-movil">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="icon-custom-lg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <nav class="w-100 flex-grow-1" id="sidebarContent">
            <span class="ms-3 text-md-custom text-white compressed-text">Menú</span>
            <ul class="list-unstyled mt-3">
                <li class="ms-2 d-flex">
                    <a href="{{ route('home') }}" class="link-custom-nav px-2 animated-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                            <g fill="none">
                                <path
                                    d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                <path fill="#ffffff"
                                    d="M13.228 2.688a2 2 0 0 0-2.456 0l-8.384 6.52C1.636 9.795 2.05 11 3.003 11H4v8a2 2 0 0 0 2 2h4v-6a2 2 0 1 1 4 0v6h4a2 2 0 0 0 2-2v-8h.997c.952 0 1.368-1.205.615-1.791z" />
                            </g>
                        </svg>
                        <span class="ms-3 text-md-custom compressed-text">Agenda</span>
                    </a>
                </li>
                <li class="ms-2 d-flex">
                    <a href="" class="link-custom-nav py-1 px-2 animated-icon">
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 256 256">
                            <path fill="#ffffff"
                                d="M208 32h-24v-8a8 8 0 0 0-16 0v8H88v-8a8 8 0 0 0-16 0v8H48a16 16 0 0 0-16 16v160a16 16 0 0 0 16 16h160a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16M84 184a12 12 0 1 1 12-12a12 12 0 0 1-12 12m44 0a12 12 0 1 1 12-12a12 12 0 0 1-12 12m0-40a12 12 0 1 1 12-12a12 12 0 0 1-12 12m44 40a12 12 0 1 1 12-12a12 12 0 0 1-12 12m0-40a12 12 0 1 1 12-12a12 12 0 0 1-12 12m36-64H48V48h24v8a8 8 0 0 0 16 0v-8h80v8a8 8 0 0 0 16 0v-8h24Z" />
                        </svg>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="21"
                                    viewBox="0 0 640 512">
                                    <path fill="#ffffff"
                                        d="M144 160a80 80 0 1 0 0-160a80 80 0 1 0 0 160m368 0a80 80 0 1 0 0-160a80 80 0 1 0 0 160M0 298.7C0 310.4 9.6 320 21.3 320h214.1c-26.6-23.5-43.3-57.8-43.3-96c0-7.6.7-15 1.9-22.3c-13.6-6.3-28.7-9.7-44.6-9.7h-42.7C47.8 192 0 239.8 0 298.7M320 320c24 0 45.9-8.8 62.7-23.3c2.5-3.7 5.2-7.3 8-10.7c2.7-3.3 5.7-6.1 9-8.3C410 262.3 416 243.9 416 224c0-53-43-96-96-96s-96 43-96 96s43 96 96 96m65.4 60.2c-10.3-5.9-18.1-16.2-20.8-28.2H261.3C187.7 352 128 411.7 128 485.3c0 14.7 11.9 26.7 26.7 26.7h300.5c-2.1-5.2-3.2-10.9-3.2-16.4v-3c-1.3-.7-2.7-1.5-4-2.3l-2.6 1.5c-16.8 9.7-40.5 8-54.7-9.7c-4.5-5.6-8.6-11.5-12.4-17.6l-.1-.2l-.1-.2l-2.4-4.1l-.1-.2l-.1-.2c-3.4-6.2-6.4-12.6-9-19.3c-8.2-21.2 2.2-42.6 19-52.3l2.7-1.5v-4.6l-2.7-1.5zM533.3 192h-42.6c-15.9 0-31 3.5-44.6 9.7c1.3 7.2 1.9 14.7 1.9 22.3c0 17.4-3.5 33.9-9.7 49c2.5.9 4.9 2 7.1 3.3l2.6 1.5c1.3-.8 2.6-1.6 4-2.3v-3c0-19.4 13.3-39.1 35.8-42.6c7.9-1.2 16-1.9 24.2-1.9s16.3.6 24.2 1.9c22.5 3.5 35.8 23.2 35.8 42.6v3c1.3.7 2.7 1.5 4 2.3l2.6-1.5c16.8-9.7 40.5-8 54.7 9.7c2.3 2.8 4.5 5.8 6.6 8.7c-2.1-57.1-49-102.7-106.6-102.7m91.3 163.9c6.3-3.6 9.5-11.1 6.8-18c-2.1-5.5-4.6-10.8-7.4-15.9l-2.3-4c-3.1-5.1-6.5-9.9-10.2-14.5c-4.6-5.7-12.7-6.7-19-3l-2.9 1.7c-9.2 5.3-20.4 4-29.6-1.3s-16.1-14.5-16.1-25.1v-3.4c0-7.3-4.9-13.8-12.1-14.9c-6.5-1-13.1-1.5-19.9-1.5s-13.4.5-19.9 1.5c-7.2 1.1-12.1 7.6-12.1 14.9v3.4c0 10.6-6.9 19.8-16.1 25.1s-20.4 6.6-29.6 1.3l-2.9-1.7c-6.3-3.6-14.4-2.6-19 3c-3.7 4.6-7.1 9.5-10.2 14.6l-2.3 3.9c-2.8 5.1-5.3 10.4-7.4 15.9c-2.6 6.8.5 14.3 6.8 17.9l2.9 1.7c9.2 5.3 13.7 15.8 13.7 26.4s-4.5 21.1-13.7 26.4l-3 1.7c-6.3 3.6-9.5 11.1-6.8 17.9c2.1 5.5 4.6 10.7 7.4 15.8l2.4 4.1c3 5.1 6.4 9.9 10.1 14.5c4.6 5.7 12.7 6.7 19 3l2.9-1.7c9.2-5.3 20.4-4 29.6 1.3s16.1 14.5 16.1 25.1v3.4c0 7.3 4.9 13.8 12.1 14.9c6.5 1 13.1 1.5 19.9 1.5s13.4-.5 19.9-1.5c7.2-1.1 12.1-7.6 12.1-14.9V492c0-10.6 6.9-19.8 16.1-25.1s20.4-6.6 29.6-1.3l2.9 1.7c6.3 3.6 14.4 2.6 19-3c3.7-4.6 7.1-9.4 10.1-14.5l2.4-4.2c2.8-5.1 5.3-10.3 7.4-15.8c2.6-6.8-.5-14.3-6.8-17.9l-3-1.7c-9.2-5.3-13.7-15.8-13.7-26.4s4.5-21.1 13.7-26.4l3-1.7zM472 384a40 40 0 1 1 80 0a40 40 0 1 1-80 0" />
                                </svg>
                                <span class="ms-3 text-md-custom compressed-text">Usuarios</span>
                            </div>
                        </a>
                        <div class="collapse Sub_menu bg-primary-custom pt-2" id="usuarios">
                            <ul class="list-unstyled m-0">
                                <li class="d-flex">
                                    <a href="{{ route('users') }}" class="sublink-custom-nav py-1 animated-icon">
                                        <i class="fa-regular fa-address-book"></i>
                                        <span class="ms-3">Ver</span>
                                    </a>
                                </li>
                                @role('Administrador')
                                    <li class="d-flex">
                                        <a href="{{ route('add-user') }}" class="sublink-custom-nav py-2 animated-icon">
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
