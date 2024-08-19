@extends('admin.layouts.main')

@section('title', 'Agregar nuevo paciente')

@section('viteConfig')
    @vite(['resources/sass/add-patients.scss', 'resources/sass/form-style.scss', 'resources/sass/steps-bar.scss'])
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}">
@endsection


@section('content')


    {{-- Select type Person --}}
    <div class="container max-w-custom">
        <x-type-person />

        <div class="row- m-0 d-none mb-2 m-" id="containerFatherForm">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold">Dar de alta a un paciente</h4>
                    <h6>Ingresa los datos correspondientes del paciente</h6>
                </div>
                <button type="button" class="btn btn-outline-danger me-3 d-none" id="errorList">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 36 36"
                        class="me-1">
                        <circle cx="18" cy="26.06" r="1.33" fill="currentColor"
                            class="clr-i-outline clr-i-outline-path-1" />
                        <path fill="currentColor" d="M18 22.61a1 1 0 0 1-1-1v-12a1 1 0 1 1 2 0v12a1 1 0 0 1-1 1"
                            class="clr-i-outline clr-i-outline-path-2" />
                        <path fill="currentColor"
                            d="M18 34a16 16 0 1 1 16-16a16 16 0 0 1-16 16m0-30a14 14 0 1 0 14 14A14 14 0 0 0 18 4"
                            class="clr-i-outline clr-i-outline-path-3" />
                        <path fill="none" d="M0 0h36v36H0z" />
                    </svg>
                    Errores</button>
            </div>

            <div class="col-12 px-0 d-flex justify-content-center">

                <div class="container">
                    <div class="row">

                        <div class="col-12 bg-content-custom shadow-custom p-3 mb-4">
                            {{-- Steps progress --}}
                            <x-form-step-container />

                        </div>

                        <div class="col-12 content-custom person-data">

                            {{-- Form Container --}}

                            <x-data-personal-add-patient :hemotipos="$hemotipos" :escolaridades="$escolidades" :estados="$estados" />

                            {{-- AHF Data --}}
                            <x-data-diseases-add-patient :enfermedades="$enfermedades" />

                            {{-- ANP Data --}}
                            <x-data-drugs-addiction-add-patient :toxicomania="$toxicomania" />

                            {{-- APP Data --}}
                            <x-data-app-add-patient :enfermedades="$enfermedades" :alergias="$alergias" />

                            {{-- Ginecologia y obstetricia --}}
                            <x-data-gyo-add-patient />


                            <div class="row mt-3 justify-content-end text-end">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary-custom" id="prevStep">Regresar</button>
                                    <button type="button" class="btn btn-primary" id="nextStep">Siguiente</button>
                                    <button type="button" class="btn btn-primary d-none" id="sendForm">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection


@section('scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    @vite(['resources/js/loading-screen.js', 'resources/js/SideBar.js', 'resources/js/addPatients.js'])

@endsection
