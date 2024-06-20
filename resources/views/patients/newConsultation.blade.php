@extends('admin.layouts.main')

@section('title', 'Agregar nuevo paciente')

@section('viteConfig')
    {{-- <link rel="stylesheet" href="{{asset('css/quill.snow.css')}}" > --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" /> --}}
    @vite(['resources/sass/form-style.scss', 'resources/sass/main.scss','resources/sass/new-consultation.scss'])
@endsection


@section('content')



    {{-- Select type Person --}}
    <div class="container max-w-custom" id="containerPersonSelect">
        <h4 class="fw-bold">Consulta médica</h4>

        <div class="row">
            <div class="col-12">

                {{-- Datos del paciente y médico --}}
                <div class="row d-flex flex-column-reverse align-items-center gap-3 gap-md-0 flex-lg-row align-items-lg-end mt-4">

                    <div class="col-12 col-lg-4">
                        <h5 class="fw-bold mb-2">Fecha de identificación</h5>
                        <p class="m-0"><span class="fw-bold">Código : </span>216882763</p>
                        <p class="m-0"><span class="fw-bold">Nombre : </span>Juan Pedro Domínguez Padilla</p>
                        <p class="m-0"><span class="fw-bold">Edad : </span>45 años</p>
                    </div>
                    <div class="col-12 col-lg-4">
                        <h5 class="fw-bold mb-2">Atendido por</h5>
                        <p class="m-0"><span class="fw-bold">Nombre : </span>Yolanda Gutierrez</p>
                        <p class="m-0"><span class="fw-bold">Cédula : </span>216882763</p>
                        <p class="m-0"><span class="fw-bold">Fecha : </span>10 de junio de 2024</p>
                    </div>

                    <div class="col-12 col-lg-4 d-flex gap-4 align-items-end justify-content-start justify-content-lg-end">
                        <a href="{{ route('patients.patients') }}">Cancelar</a>
                        <button class="fst-normal tooltip-container py-2 px-3 btn-blue-sec" id="saveConsultation">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" class="pe-2"
                                viewBox="0 0 2048 2048">
                                <path
                                    d="M1728 640q66 0 124 25t101 69t69 102t26 124q0 57-19 109t-53 93t-81 71t-103 41v102q0 89-22 173t-62 160t-98 137t-129 107t-155 70t-174 25q-91 0-174-25t-154-70t-129-107t-98-137t-63-159t-22-174v-229q-123-11-218-59T133 962T34 781T0 558V0h320q26 0 45 19t19 45t-19 45t-45 19H128v430q0 106 29 192t87 147t140 94t192 33q101 0 184-31t141-89t91-140t32-185V128H832q-26 0-45-19t-19-45t19-45t45-19h320v558q0 120-34 223t-99 181t-160 126t-219 59v229q0 107 38 205t107 174t162 120t205 45q111 0 204-45t162-120t107-173t39-206v-102q-56-12-103-41t-81-70t-53-94t-19-109q0-66 25-124t68-101t102-69t125-26m0 512q40 0 75-15t61-41t41-61t15-75t-15-75t-41-61t-61-41t-75-15t-75 15t-61 41t-41 61t-15 75t15 75t41 61t61 41t75 15" />
                            </svg>
                            Finalizar consulta
                            <span class="tooltip-text">Guardar la consulta.</span></button>
                    </div>

                </div>

                <div class="row mt-3 mb-5">
                    <div class="col-12 col-lg-8">
                        <div class="card shadow-custom">
                            <div class="card-header text-center bg-blue">
                                Interrogatorio
                            </div>
                            <div class="card-body px-4">
                                <div class="mb-4">
                                    <label class="pb-2">Motivo de la consulta</label>
                                    <div  id="reasonEditor"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="pb-2">Aparatos y sistemas</label>
                                    <div id="devicesEditor"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="pb-2">Auxiliares DX y TX previos</label>
                                    <div id="auxEditor"></div>
                                </div>

                            </div>

                        </div>


                        <div class="card mt-4 shadow-custom">
                            <div class="card-header text-center bg-blue">
                                Detalles
                            </div>
                            <div class="card-body px-4">
                                <div class="mb-4">
                                    <label class="pb-2">Exploracion física</label>
                                    <div id="physicalExamEditor"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="pb-2">Diagnóstico</label>
                                    <div id="diagnosisEditor"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="pb-2">Tratamiento</label>
                                    <div id="treatmentEditor"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="pb-2">Observaciones</label>
                                    <div id="observationsEditor"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-lg-4">
                        <div class="card">
                            <div class="card-header text-center bg-blue">
                                Signos vitales
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3 vitalSigns">
                                    <label for="fcIpm" class="pb-1">Frecuencia cardiaca (Ipm) <span class="required-point">*</span></label>
                                    <input class="form-control" type="number" id="fcIpm" placeholder="60" />
                                    <span class="text-danger fw-normal"></span>
                                </div>

                                <div class="form-group mb-3 vitalSigns">
                                    <label for="taMMHg" class="pb-1">Presión arterial (mm/Hg) <span class="required-point">*</span></label>
                                    <input class="form-control" type="text" id="taMMHg" placeholder="90" />
                                    <span class="text-danger fw-normal d-none"></span>
                                </div>
                                <div class="form-group mb-3 vitalSigns">
                                    <label for="tcCentrigrados" class="pb-1">Temperatura (°C) <span class="required-point">*</span></label>
                                    <input class="form-control" type="number" id="tcCentrigrados" placeholder="37.5" />
                                    <span class="text-danger fw-normal d-none"></span>
                                </div>
                                <div class="form-group mb-3 vitalSigns">
                                    <label for="pesoKilogramos" class="pb-1">Peso (kg) <span class="required-point">*</span></label>
                                    <input class="form-control" type="text" id="pesoKilogramos" placeholder="70.5" />
                                    <span class="text-danger fw-normal d-none"></span>
                                </div>
                                <div class="form-group mb-3 vitalSigns">
                                    <label for="frRpm" class="pb-1">Frecuencia respiratoria (rpm) <span class="required-point">*</span></label>
                                    <input class="form-control" type="number" id="frRpm" placeholder="45" />
                                    <span class="text-danger fw-normal d-none"></span>
                                </div>
                                <div class="form-group mb-3 vitalSigns">
                                    <label for="satPorcentaje" class="pb-1">Síndrome autoinmune tirogástrico (%) <span class="required-point">*</span></label>
                                    <input class="form-control" type="text" id="satPorcentaje" placeholder="40" />
                                    <span class="text-danger fw-normal d-none"></span>
                                </div>
                                <div class="form-group mb-3 vitalSigns">
                                    <label for="glucosa" class="pb-1">Glucosa (mg/dL) <span class="required-point">*</span></label>
                                    <input class="form-control" type="text" id="glucosa" placeholder="300" />
                                    <span class="text-danger fw-normal d-none"></span>
                                </div>
                                <div class="form-group mb-3 vitalSigns">
                                    <label for="talla" class="pb-1">Talla (cm) <span class="required-point">*</span></label>
                                    <input class="form-control" type="text" id="talla" placeholder="30" />
                                    <span class="text-danger fw-normal d-none"></span>
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
    {{-- <script src="{{asset('js/quill.js')}}"></script> --}}
    @vite('resources/js/patients/newConsultation.js')

@endsection
