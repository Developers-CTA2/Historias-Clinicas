<header id="header-custom" class="d-flex justify-content-between">
    <div class="bg-dark-backdrop"></div>
    <nav class="navbar-custom " id="navBar">
        <div class="max-w-custom d-flex justify-content-between">
            <section class="d-flex justify-content-center align-items-center gap-3">
                <div class="d-md-none" id="bt-hamburger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="hamburger-custom-btn">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </div>
                <p class="m-0 fw-bold d-none d-lg-block">
                    {{ Carbon\Carbon::now()->locale('es')->isoFormat('LL') }}
                </p>
            </section>

            <section class="d-flex align-items-center gap-3">
                <p class="m-0 d-none d-md-block usernameText">{{ auth()->user()->name }} </p>
                <div data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar-container" >
                        @php 
                        
                            $role = auth()->user()->roles[0]->id;
                            $sex = auth()->user()->sex === 'Masculino' ? 1 : 2;
                            $classSex = $sex == 1 ? 'man' : 'woman';
                    
                            $avatarRole = '';
                            if ($role == 1) {
                                $avatarRole = 'doctor';
                            } else if ($role == 2) {
                                $avatarRole = 'pasante';
                            } else {
                                $avatarRole = 'nutrition';
                            }
    
                            $urlImage = 'icon-'.$avatarRole.'-'.'man'.'.png';
    
                        @endphp
                        <img src="{{asset('/images/'.$urlImage)}}" alt="Ícono doctor">
                    </div>
                </div>
                <ul class="dropdown-menu">
                    <li>
                        <p class="m-0 d-block d-md-none dropdown-item usernameText" >{{ auth()->user()->name }} </p>
                    </li>
                    <li class="d-block d-md-none">
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a href="{{ route('profile.details') }}" class="dropdown-item">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="icon-custom">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                Configuración de perfil
                            </div>
                        </a>

                    </li>
                    <li >
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action=" {{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item" href="#">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="icon-custom">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                    </svg>
                                    Cerrar sesión
                                </div>
                            </button>
                        </form>
                    </li>
                </ul>
            </section>
        </div>
    </nav>
    @include('admin.layouts.sideBar')


</header>
