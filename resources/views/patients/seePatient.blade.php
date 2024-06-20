@extends('admin.layouts.main')

@section('title', 'Lista de pacientes')

@section('viteConfig')
    @vite(['resources/sass/form-style.scss', 'resources/sass/add-patients.scss'])
@endsection


@section('content')
    <div class="container">
        <!-- Tabla para mostrar los datos  -->
        <div class="col-12 cont-principal"> <!-- Ajusta el tamaño de la tabla para dispositivos grandes -->
            <div class="mt-2 col-12 mb-2 d-flex justify-content-end">
               <a href="{{ route('patients.add-patient') }}" class="btn-blue fst-normal tooltip-container" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 icons-style">
                        <path
                            d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
                    </svg>
                    Paciente
                    <span class="tooltip-text">Agregar un paciente</span>
                </a>
            </div>
            <div id="Tabla-Personal"></div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/patients/seePatient.js')
@endsection