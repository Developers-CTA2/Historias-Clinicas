@extends('admin.layouts.main')

@section('title', 'Lista de pacientes')

@section('viteConfig')
@vite(['resources/sass/sideBar.scss','resources/sass/loadingScreen.scss', 'resources/sass/StyleForm.scss','resources/sass/colorButtons.scss', 'resources/js/app.js'])
@endsection

<!-- Esto no se que hace pero lo puse jsjsjsj -->
@section('breadCrumb')
<nav aria-label="breadcrumb" class="d-flex justify-content-between align-items-center">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a class="item-custom-link" href="{{ route('home') }}">Pacientes</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Lista de pacientes</li>
    </ol>
    <span class="text-end">{{ now()->setTimezone('America/Mexico_City')->format('d F Y') }}</span>
</nav>
@endsection

@section('content')
<div class="container ">
    <div>
        <h4 class="fw-bold">Lista de pacientes</h4>
    </div>
    <!-- Tabla para mostrar los datos  -->
    <div class="col-12 mt-0 pt-0"> <!-- Ajusta el tamaño de la tabla para dispositivos grandes -->
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
@vite(['resources/js/loading-screen.js','resources/js/SideBar.js', 'resources/js/seePatient.js'])
@endsection