@extends('admin.layouts.main')

@section('title', 'Lista de pacientes')

@section('viteConfig')
    @vite('resources/sass/Forms-Styles.scss')
@endsection

<!-- Esto no se que hace pero lo puse jsjsjsj -->
@section('breadCrumb')
    <nav aria-label="breadcrumb" class="d-flex justify-content-between align-items-center breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="item-custom-link" href="{{ route('showPatients') }}">Pacientes</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" href="{{ route('home') }}">Lista de pacientes</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        {{-- <div>
            <h4 class="fw-bold">Lista de pacientes</h4>
        </div> --}}

        {{-- <div class="col-12">
            <div class="card">
                <div class="card-header text-center header-card">
                    Lista de pacientes
                </div>
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                </div>
            </div>
        </div> --}}


         <!-- Tabla para mostrar los datos  -->
        <div class="col-12 cont-principal"> <!-- Ajusta el tamaño de la tabla para dispositivos grandes -->
        <div class="mt-2 col-12 mb-2 d-flex justify-content-end">
            <abbr title="Agregar una nuevo paciente al sistena">
                <a href="{{ route('showForm') }}" class="btn fst-normal px-4 animated-icon button-add" type="button" id="confirm-report" tabindex="0">
                    <i class="fa-solid fa-user-plus "></i>
                    Paciente
                </a>
            </abbr>
        </div>
        <div id="Tabla-Personal"></div>
    </div> 
    </div>
@endsection


@section('scripts')
    @vite(['resources/js/loading-screen.js', 'resources/js/SideBar.js', 'resources/js/seePatient.js'])
@endsection
