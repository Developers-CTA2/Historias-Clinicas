<aside class="sideBar-custom active d-flex flex-column" id="container-sideBar-custom">
    <div class="w-full flex-grow-1" id="sidebarContainer">
        <div class="w-full d-flex justify-content-between align-items-center header-custom">
            {{-- <img style="height: 50px;" src="{{asset('images/clinic-track-03.png')}}" /> --}}
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
            <ul class="list-unstyled mt-3">

                {{-- Componentes del sidebar --}}

                {{-- Inicio --}}
                <x-item-sidebar title="Inicio" route="{{ route('home') }}">

                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                            <path fill="#ffffff"
                                d="M4 20v-9.375L2.2 12l-1.175-1.575L12 2l11 8.4l-1.2 1.6L12 4.5L6 9.1V18h4v2zm13.5 2.375q-1.05.725-2.312.613t-2.163-1.013t-1.012-2.162t.612-2.313q-.725-1.05-.612-2.312t1.012-2.163t2.163-1.012t2.312.612q1.05-.725 2.313-.612t2.162 1.012t1.013 2.163t-.613 2.312q.725 1.05.613 2.313t-1.013 2.162t-2.162 1.013t-2.313-.613m0-2.45l1.15.8q.45.325.975.275t.925-.45t.45-.925t-.275-.975l-.8-1.15l.8-1.15q.325-.45.275-.975t-.45-.925t-.925-.45t-.975.275l-1.15.8l-1.15-.8q-.45-.325-.975-.275t-.925.45t-.45.925t.275.975l.8 1.15l-.8 1.15q-.325.45-.275.975t.45.925t.925.45t.975-.275zm0-1.175q.525 0 .888-.363t.362-.887t-.363-.888t-.887-.362t-.888.363t-.362.887t.363.888t.887.362m0-1.25" />
                        </svg>
                    </x-slot>

                </x-item-sidebar>

                {{-- Pacientes --}}
                <x-item-sidebar-with-submenu label="Pacientes">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20">
                            <path fill="#ffffff"
                                d="M10 2a4 4 0 1 0 0 8a4 4 0 0 0 0-8M7 6a3 3 0 1 1 6 0a3 3 0 0 1-6 0m5.879 5h-7.87A2 2 0 0 0 3 13c0 1.691.833 2.966 2.135 3.797c1.094.697 2.512 1.08 4.056 1.178a3.6 3.6 0 0 1-.285-1.026c-1.278-.121-2.394-.46-3.233-.996C4.623 15.283 4 14.31 4 13c0-.553.448-1 1.009-1h6.87zm5.475-.353a2.62 2.62 0 0 0-3.708 0l-4 4a2.621 2.621 0 0 0 3.707 3.707l4-4a2.62 2.62 0 0 0 0-3.707m-3 .707a1.621 1.621 0 1 1 2.292 2.293L16 15.293L13.707 13zm-1.5 4.292a.5.5 0 0 1 0 .708l-1 1a.5.5 0 0 1-.708-.708l1-1a.5.5 0 0 1 .708 0" />
                        </svg>
                    </x-slot>

                    {{-- Submenu --}}
                    <x-item-submenu-sidebar route="{{ route('patients.index') }}" label="Lista de pacientes" />
                    <x-item-submenu-sidebar route="{{ route('patients.add-patient') }}" label="Agregar paciente" />

                </x-item-sidebar-with-submenu>


                {{-- Agenda --}}
                <x-item-sidebar title="Agenda" route="{{ route('showAgenda') }}">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                            <path fill="#ffffff"
                                d="M12 14a1 1 0 1 0-1-1a1 1 0 0 0 1 1m5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1m-5 4a1 1 0 1 0-1-1a1 1 0 0 0 1 1m5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1M7 14a1 1 0 1 0-1-1a1 1 0 0 0 1 1M19 4h-1V3a1 1 0 0 0-2 0v1H8V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-9h16Zm0-11H4V7a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1ZM7 18a1 1 0 1 0-1-1a1 1 0 0 0 1 1" />
                        </svg>
                    </x-slot>
                </x-item-sidebar>

                {{-- Administracion de enfermedades --}}
                <x-item-sidebar-with-submenu label="Administrar">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                            <path fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M17.25 20.679a3.429 3.429 0 1 0 0-6.858a3.429 3.429 0 0 0 0 6.858m-.571-9.429h1.142m-.571 0v2.571m3.839-1.218l.808.808m-.404-.404l-1.819 1.819m3.576 1.853v1.142m0-.571h-2.571m1.218 3.839l-.808.808m.404-.404l-1.819-1.819m-1.853 3.576h-1.142m.571 0v-2.571m-3.839 1.218l-.808-.808m.404.404l1.819-1.819m-3.576-1.853v-1.142m0 .571h2.571m-1.218-3.839l.808-.808m-.404.404l1.819 1.819M6 6.75a3 3 0 1 0 0-6a3 3 0 0 0 0 6m4.555 4.138A5.251 5.251 0 0 0 .75 13.5v2.25H3l.75 7.5h4.5l.323-3.232" />
                        </svg>
                    </x-slot>

                    {{-- Submenu --}}
                    <x-item-submenu-sidebar route="{{ route('admin.diseases') }}" label="Enfermedades" />
                    <x-item-submenu-sidebar route="{{ route('admin.allergies') }}" label="Alergias" />
                    <x-item-submenu-sidebar route="{{ route('admin.addictions') }}" label="Toxicomanías" />
                </x-item-sidebar-with-submenu>

                @role('Administrador')
                    {{-- Usuarios --}}
                    <x-item-sidebar-with-submenu label="Usuarios">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                <g fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87m-3-12a4 4 0 0 1 0 7.75" />
                                </g>
                            </svg>
                        </x-slot>

                        {{-- Submenu --}}
                        <x-item-submenu-sidebar route="{{ route('users.users') }}" label="Lista de usuarios" />
                        <x-item-submenu-sidebar route="{{ route('users.add-user') }}" label="Agregar usuario" />

                    </x-item-sidebar-with-submenu>
                @endrole

            </ul>
        </nav>
    </div>

</aside>
