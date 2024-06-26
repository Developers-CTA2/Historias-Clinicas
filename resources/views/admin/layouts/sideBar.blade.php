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
                <x-item-sidebar />

                <x-item-sidebar-with-submenu />

                
               
            </ul>
        </nav>
    </div>

</aside>
@section('scripts')
    @vite('resources/js/SideBar.js')
@endsection
