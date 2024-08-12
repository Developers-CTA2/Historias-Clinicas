@extends('admin.layouts.main')

@section('title', 'Agregar nuevo paciente')

@section('viteConfig')
    @vite(['resources/sass/add-patients.scss', 'resources/sass/form-style.scss', 'resources/sass/main.scss', 'resources/sass/steps-bar.scss'])
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}">
@endsection


@section('content')


    {{-- Select type Person --}}
    <div class="container max-w-custom" id="containerPersonSelect">
        <div class="row d-flex justify-content-center gap-3">
            <div class="col-2 d-flex flex-column align-items-center bg-content-custom shadow-custom text-center py-3 card-hover"
                id="udgPerson">
                <div class="bg-avatar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                        <g fill="#000000">
                            <path
                                d="M12.486 5.414a1 1 0 0 0-.972 0L5.06 9l6.455 3.586a1 1 0 0 0 .972 0L18.94 9l-6.455-3.586zm-1.943-1.749a3 3 0 0 1 2.914 0l8.029 4.46a1 1 0 0 1 0 1.75l-8.03 4.46a3 3 0 0 1-2.913 0l-8.029-4.46a1 1 0 0 1 0-1.75l8.03-4.46z" />
                            <path
                                d="M21 8a1 1 0 0 1 1 1v7a1 1 0 1 1-2 0V9a1 1 0 0 1 1-1zM6 10a1 1 0 0 1 1 1v5.382l4.553 2.276a1 1 0 0 0 .894 0L17 16.382V11a1 1 0 1 1 2 0v6a1 1 0 0 1-.553.894l-5.105 2.553a3 3 0 0 1-2.684 0l-5.105-2.553A1 1 0 0 1 5 17v-6a1 1 0 0 1 1-1z" />
                        </g>
                    </svg>
                </div>
                <h4 class="fw-bold title-size-sm mt-2">Perteneciente UDG</h4>
            </div>
            <div class="col-2 d-flex flex-column align-items-center bg-content-custom shadow-custom text-center py-3 card-hover"
                id="externalPerson">
                <div class="bg-avatar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                        <path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M3 21h18M5 21V7l8-4v18m6 0V11l-6-4M9 9v.01M9 12v.01M9 15v.01M9 18v.01" />
                    </svg>
                </div>
                <h4 class="fw-bold title-size-sm mt-2">Externos</h4>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-3 animate__animated animate__fadeInUp d-none"
            id="containerUdgPerson">
            <div class="col-4 bg-content-custom shadow-custom p-3">
                {{-- Alert for errors o no found code --}}
                <div class="alert text-center d-none" id="alertCodePerson" role="alert"></div>
                <div class="mb-3 d-flex gap-3 align-items-end">
                    <div class="flex-grow-1">
                        <label for="code" class="form-label">Código</label>
                        <input type="text" class="form-control" id="code" placeholder="216610402" autocomplete="false">
                    </div>
                    <button class="btn-sec fst-normal tooltip-container p-2" type="button" id="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 26 26">
                            <path
                                d="M10 .188A9.812 9.812 0 0 0 .187 10A9.812 9.812 0 0 0 10 19.813c2.29 0 4.393-.811 6.063-2.125l.875.875a1.845 1.845 0 0 0 .343 2.156l4.594 4.625c.713.714 1.88.714 2.594 0l.875-.875a1.84 1.84 0 0 0 0-2.594l-4.625-4.594a1.824 1.824 0 0 0-2.157-.312l-.875-.875A9.812 9.812 0 0 0 10 .188M10 2a8 8 0 1 1 0 16a8 8 0 0 1 0-16M4.937 7.469a5.446 5.446 0 0 0-.812 2.875a5.46 5.46 0 0 0 5.469 5.469a5.516 5.516 0 0 0 3.156-1a7.166 7.166 0 0 1-.75.03a7.045 7.045 0 0 1-7.063-7.062c0-.104-.005-.208 0-.312" />
                        </svg>
                        Buscar
                        <span class="tooltip-text">Buscar el código.</span>
                    </button>
                </div>
                <div id="containerDataPerson" class="d-none animate__animated animate__fadeInUp">
                    <ul class="list-group mb-2">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Nombre</div>
                                <span id="namePerson"> - </span>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Carrera / Puesto</div>
                                <span id="careerPerson"> - </span>
                            </div>
                        </li>
                    </ul>

                    <div class="d-flex justify-content-center mt-3">
                        <button class="w-full btn btn-primary" id="nextPersonUdg">Continuar</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row m-0 d-none max-w-custom" id="containerFatherForm">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold">Dar de alta a un paciente</h4>
                <h6>Ingresa los datos correspondientes del paciente</h6>
            </div>
            <button type="button" class="btn btn-outline-danger me-3 d-none" id="errorList">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 36 36" class="me-1">
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

        <div class="row justify-content-center px-0 d-flex justify-content-center">

            {{-- Steps progress --}}
            <div class="row">
                <div class="col-12 content-custom person-data bg-content-custom shadow-custom px-4 py-3">
                    <div class="row mb-3 px-3 line-progress-step d-flex justify-content-center mt-3">
                        <div class="col-2 p-0">
                            <div class="step-group d-flex flex-column align-items-center">
                                <div class="step-progress">
                                    <span class="step-circle active">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24">
                                            <path fill="#ffffff"
                                                d="m10.6 13.8l-2.15-2.15q-.275-.275-.7-.275t-.7.275t-.275.7t.275.7L9.9 15.9q.3.3.7.3t.7-.3l5.65-5.65q.275-.275.275-.7t-.275-.7t-.7-.275t-.7.275zM12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="text-center">
                                    <p>Datos <br />Personales</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-2 p-0">
                            <div class="step-group d-flex flex-column align-items-center">
                                <div class="step-progress">
                                    <span class="step-circle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24">
                                            <path fill="#ffffff"
                                                d="m10.6 13.8l-2.15-2.15q-.275-.275-.7-.275t-.7.275t-.275.7t.275.7L9.9 15.9q.3.3.7.3t.7-.3l5.65-5.65q.275-.275.275-.7t-.275-.7t-.7-.275t-.7.275zM12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="text-center">
                                    <p>Antecedentes <br /> heredofamiliares</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-2 p-0">
                            <div class="step-group d-flex flex-column align-items-center">
                                <div class="step-progress">
                                    <span class="step-circle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24">
                                            <path fill="#ffffff"
                                                d="m10.6 13.8l-2.15-2.15q-.275-.275-.7-.275t-.7.275t-.275.7t.275.7L9.9 15.9q.3.3.7.3t.7-.3l5.65-5.65q.275-.275.275-.7t-.275-.7t-.7-.275t-.7.275zM12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="text-center">
                                    <p>Antecendentes <br />no patológicos</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-2 p-0">
                            <div class="step-group d-flex flex-column align-items-center">
                                <div class="step-progress">
                                    <span class="step-circle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24">
                                            <path fill="#ffffff"
                                                d="m10.6 13.8l-2.15-2.15q-.275-.275-.7-.275t-.7.275t-.275.7t.275.7L9.9 15.9q.3.3.7.3t.7-.3l5.65-5.65q.275-.275.275-.7t-.275-.7t-.7-.275t-.7.275zM12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="text-center">
                                    <p>Antecedentes <br />patológicos</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-2 p-0">
                            <div class="step-group d-flex flex-column align-items-center">
                                <div class="step-progress">
                                    <span class="step-circle"></span>
                                </div>
                                <div class="text-center">
                                    <p>Ginecología <br />Obstetricia</p>
                                </div>
                            </div>
                        </div>


                    </div>

                    {{-- Form Container --}}

                    <x-data-personal-add-patient />

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

@endsection


@section('scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    @vite(['resources/js/loading-screen.js', 'resources/js/SideBar.js', 'resources/js/addPatients.js'])

@endsection
