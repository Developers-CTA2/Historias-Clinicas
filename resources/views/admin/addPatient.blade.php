@extends('admin.layouts.main')

@section('title', 'Agregar paciente')

@section('viteConfig')
    @vite('resources/sass/add-patients.scss')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
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

                <div class="container-fluid">
                    <div class="row">

                        <div class="col-12 bg-content-custom shadow-custom p-3 mb-4">
                            {{-- Steps progress --}}
                            <x-form-step-container />

                        </div>

                        <div class="col-12 content-custom person-data">

                            {{-- Form Container --}}

                            <x-data-personal-add-patient :hemotipos=$hemotipos :escolaridades=$escolidades :estados=$estados />

                            {{-- AHF Data --}}
                            <x-data-diseases-add-patient :enfermedades=$enfermedades />

                            {{-- ANP Data --}}
                            <x-data-drugs-addiction-add-patient :toxicomanias=$toxicomanias />

                            {{-- APP Data --}}
                            <x-data-app-add-patient :enfermedades=$enfermedades :alergias=$alergias />

                            {{-- Ginecologia y obstetricia --}}
                            <x-data-gyo-add-patient />


                            <div class="row mt-3 text-end justify-content-end">
                                <div class="col-12 col-lg-6 d-flex flex-column-reverse flex-lg-row gap-3 justify-content-end align-items-lg-center">


                                    <x-button-custom type="button" class="btn-red justify-content-center justify-content-lg-start" id="cancel" text="Cancelar" tooltipText="Cancelar el expediente del paciente">
                                        <x-slot name="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="currentColor" d="m8.4 16.308l3.6-3.6l3.6 3.6l.708-.708l-3.6-3.6l3.6-3.6l-.708-.708l-3.6 3.6l-3.6-3.6l-.708.708l3.6 3.6l-3.6 3.6zM12.003 21q-1.866 0-3.51-.708q-1.643-.709-2.859-1.924t-1.925-2.856T3 12.003t.709-3.51Q4.417 6.85 5.63 5.634t2.857-1.925T11.997 3t3.51.709q1.643.708 2.859 1.922t1.925 2.857t.709 3.509t-.708 3.51t-1.924 2.859t-2.856 1.925t-3.509.709M12 20q3.35 0 5.675-2.325T20 12t-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20m0-8"/></svg>
                                        </x-slot>
                                    </x-button-custom>

                                    <x-button-custom type="button" class="btn-sec justify-content-center justify-content-lg-start" id="prevStep" text="Regresar" tooltipText="Regresar al paso anterior">
                                        <x-slot name="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 1024 1024"><path fill="currentColor" d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64"/><path fill="currentColor" d="m237.248 512l265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312z"/></svg>
                                        </x-slot>
                                    </x-button-custom>

                                    <x-button-custom type="button" :disabled="true" class="btn-blue justify-content-center justify-content-lg-start disabled-custom" id="nextStep" text="Siguiente" tooltipText="Avanzar al siguiente paso">
                                        <x-slot name="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="transform: rotate(180deg)" width="25" height="25" viewBox="0 0 1024 1024"><path fill="currentColor" d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64"/><path fill="currentColor" d="m237.248 512l265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312z"/></svg>
                                        </x-slot>
                                    </x-button-custom>

                                    <x-button-custom type="button" class="btn-blue justify-content-center justify-content-lg-start d-none" id="sendForm" text="Guardar expediente" tooltipText="Guardar el expediente del paciente">
                                        <x-slot name="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg"  width="25" height="25" viewBox="0 0 24 24"><path fill="currentColor" d="M17 20.75H7A2.75 2.75 0 0 1 4.25 18V6A2.75 2.75 0 0 1 7 3.25h7.5a.75.75 0 0 1 .53.22L19.53 8a.75.75 0 0 1 .22.53V18A2.75 2.75 0 0 1 17 20.75m-10-16A1.25 1.25 0 0 0 5.75 6v12A1.25 1.25 0 0 0 7 19.25h10A1.25 1.25 0 0 0 18.25 18V8.81l-4.06-4.06Z"/><path fill="currentColor" d="M16.75 20h-1.5v-6.25h-6.5V20h-1.5v-6.5a1.25 1.25 0 0 1 1.25-1.25h7a1.25 1.25 0 0 1 1.25 1.25ZM12.47 8.75H8.53a1.29 1.29 0 0 1-1.28-1.3V4h1.5v3.25h3.5V4h1.5v3.45a1.29 1.29 0 0 1-1.28 1.3"/></svg>
                                        </x-slot>
                                    </x-button-custom>
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
    @vite('resources/js/addPatients.js')

@endsection
