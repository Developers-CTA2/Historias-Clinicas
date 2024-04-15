@extends('admin.layouts.main')

@section('title', 'Personal')

@section('viteConfig')
@vite(['resources/sass/sideBar.scss', 'resources/sass/loadingScreen.scss','resources/sass/colorButtons.scss', 'resources/sass/StyleForm.scss', 'resources/js/app.js'])
@endsection
@section('titleView','Lista del personal registrado')
<!-- Esto no se que hace pero lo puse jsjsjsj -->
@section('breadCrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="item-custom-link" href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a class="item-custom-link" href="{{ route('usuarios') }}">Personal</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ver personal</li>
</nav>
@endsection


@section('content')
<div class="container ">
    <div class="row justify-content-center ">


        <div class="col-12 ">
            <div class="row col-12 bg-color-form">
                <div class="col-12 d-flex justify-content-center">
                    <h5 class="text-center mt-3"> Ver los registros del sistema </h5>

                </div>
                <!-- Tabla para mostrar los datos  -->
                <div class="container">
                    <div class="mt-2 col-12 mb-2 d-flex justify-content-end">
                        <abbr title="Agregar una nueva persona al sistena">
                            <a href="{{ route('showForm') }}" class="btn fst-normal px-4 animated-icon button-add" type="button" id="confirm-report" tabindex="0">
                                <i class="fa-solid fa-user-plus "></i>
                                Agregar
                            </a>
                        </abbr>
                    </div>


                    <div class="col-12 mt-0 pt-0"> <!-- Ajusta el tamaño de la tabla para dispositivos grandes -->
                        <div id="Tabla-Personal"></div>
                    </div>

                </div>

                <!-- Cierre de la card  -->
            </div>
        </div>
    </div>

</div>
</div>



@endsection


@section('scripts')

@vite(['resources/js/loading-screen.js', 'resources/js/Personas.js','resources/js/SideBar.js'])
<!-- <script type="module" src="{{ asset('js/Personas.js') }}"></script> -->

@endsection