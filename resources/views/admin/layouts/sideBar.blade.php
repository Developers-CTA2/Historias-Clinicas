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
                        <span class="ms-3 text-md-custom compressed-text">Inicio</span>
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
                                <a href="{{ route('admin.diseases') }}" class="sublink-custom-nav py-1 animated-icon">
                                    <i class="fa-regular fa-address-book"></i>
                                    <span class="ms-3">Enfermedades</span>
                                </a>
                            </li>

                            <li class="d-flex">
                                <a href="{{ route('admin.allergies') }}"
                                    class="sublink-custom-nav py-2 animated-icon">
                                    <div><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32"><g fill="#ffffff"><path d="M3 15.999c0-3.67 1.106-6.91 3.235-9.221C8.35 4.48 11.568 3 15.999 3c4.43 0 7.648 1.48 9.764 3.778c2.129 2.311 3.235 5.55 3.235 9.22c0 3.671-1.106 6.91-3.235 9.222c-2.068 2.246-5.187 3.71-9.462 3.775c-.06.076-.125.15-.193.22l-.015.015l-.016.015c-1.008.954-2.703 1.089-3.746-.089c-.249-.23-.669-.24-.955.048a2.675 2.675 0 0 1-1.508.764c1.79.668 3.838 1.03 6.13 1.03c4.905 0 8.687-1.654 11.236-4.423c2.537-2.755 3.764-6.515 3.764-10.576c0-4.061-1.227-7.821-3.764-10.576C24.684 2.654 20.903 1 16 1C11.095 1 7.313 2.654 4.763 5.423C2.226 8.178 1 11.938 1 15.999c0 2.85.604 5.55 1.84 7.86c.318-.794.705-1.552 1.154-2.268C3.336 19.914 3 18.021 3 16"/><path d="M18.287 21.097A3.239 3.239 0 0 1 17 21.89v-2.327a3.257 3.257 0 0 1 4.477.12c.048.049.09.1.126.154c.416.384 1.114.394 1.632-.135a1 1 0 1 1 1.43 1.398c-1.246 1.274-3.385 1.445-4.664-.048a.924.924 0 0 1-.031-.038a1.258 1.258 0 0 0-1.683.084m-8.84-10.992a1 1 0 0 0-.894 1.788L10.763 13l-2.21 1.105a1 1 0 0 0 .894 1.79l4-2a1 1 0 0 0 0-1.79zm14.448.447a1 1 0 0 0-1.342-.448l-4 2a1 1 0 0 0 0 1.79l4 2a1 1 0 1 0 .894-1.79L21.237 13l2.21-1.106a1 1 0 0 0 .448-1.341M3.033 26.777c1.04-5.67 5.653-10.082 11.406-10.767c.84-.1 1.57.584 1.56 1.43v9.568c0 .584-.23 1.118-.61 1.511c-.67.635-1.72.665-2.33-.05c-.661-.665-1.732-.635-2.392.03a1.683 1.683 0 0 1-2.391 0a1.683 1.683 0 0 0-2.392.005c-.64.644-1.67.655-2.331.05a2.086 2.086 0 0 1-.52-1.777"/></g></svg>
                                        <span class="ms-3">Alergias</span>
                                    </div> 
                                </a>
                            </li>
                            <li class="d-flex">
                                <a href="{{ route('admin.addictions') }}"
                                    class="sublink-custom-nav py-2 animated-icon">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 48 48">
                                            <g fill="none" stroke="#ffffff" stroke-linejoin="round"
                                                stroke-width="4">
                                                <path
                                                    d="M33.958 44s.024-3.47 0-4.24a18.993 18.993 0 0 0 4.477-3.325A18.94 18.94 0 0 0 44 23c0-10.493-8.507-19-19-19S6 12.507 6 23a18.94 18.94 0 0 0 5.565 13.435a19.088 19.088 0 0 0 2.879 2.365c.515.345 1.01.666 1.56.96V44z"
                                                    clip-rule="evenodd" />
                                                <path
                                                    d="M18 27a4 4 0 0 0 4-4l-4-4a4 4 0 0 0 0 8Zm14 0a4 4 0 0 1-4-4l4-4a4 4 0 0 1 0 8Z" />
                                                <path stroke-linecap="round" d="m22 34l2.938-3L28 33.897" />
                                            </g>
                                        </svg>
                                        <span class="ms-3 text-md-custom compressed-text">Toxicomanías</span>
                                    </div>
                                </a>
                            </li>

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
                                    <a href="{{ route('users.users') }}" class="sublink-custom-nav py-1 animated-icon">
                                        <i class="fa-regular fa-address-book"></i>
                                        <span class="ms-3">Ver</span>
                                    </a>
                                </li>
                                @role('Administrador')
                                    <li class="d-flex">
                                        <a href="{{ route('users.add-user') }}" class="sublink-custom-nav py-2 animated-icon">
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
