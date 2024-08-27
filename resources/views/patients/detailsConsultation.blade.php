@extends('admin.layouts.main')

@section('title', 'Detalles')

@section('viteConfig')
    @vite(['resources/sass/form-style.scss'])
@endsection


@section('content')



    {{-- Select type Person --}}
    <div class="container max-w-custom mb-4">
        <h4 class="fw-bold">Detalle de la consulta</h4>

        <x-button-up-screen/>        

        <div class="row mt-3">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-9">

                        {{-- Card de datos de la consulta --}}
                        <x-card-custom>
                            <x-slot name="title">Datos generares</x-slot>

                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="d-flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="20" height="20"
                                            viewBox="0 0 24 24">
                                            <g fill="none" stroke="#7c3aed" stroke-width="2">
                                                <circle cx="12" cy="7" r="5" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17 14h.352a3 3 0 0 1 2.976 2.628l.391 3.124A2 2 0 0 1 18.734 22H5.266a2 2 0 0 1-1.985-2.248l.39-3.124A3 3 0 0 1 6.649 14H7" />
                                            </g>
                                        </svg>
                                        <h5 class="fw-bold mb-2 text-muted">Fecha de identificación</h5>
                                    </div>
                                    <p class="m-0"><span class="fw-bold me-2 text-muted">Código :
                                        </span>{{ $person->codigo }}</p>
                                    <p class="m-0"><span class="fw-bold me-2 text-muted">Nombre :
                                        </span>{{ $person->nombre }}</p>
                                    <p class="m-0"><span class="fw-bold me-2 text-muted">Edad :
                                        </span>{{ $person->edad }} años</p>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="d-flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="25" height="25"
                                            viewBox="0 0 48 48">
                                            <path fill="#0891b2" fill-rule="evenodd"
                                                d="M14.433 33.442a3 3 0 1 0 1.96-.416a9 9 0 0 1-.103-.405a20 20 0 0 1-.32-1.87a17 17 0 0 1-.14-1.914a7 7 0 0 1 .015-.527q.577-.166 1.155-.297c.441-.1.703.42.914.842l.086.169h11.749c.229-.434.748-1.126 1.251-1.011q.806.184 1.609.433l-.003.001q-.003-.003 0 .002c.004.014.026.08.048.22q.038.244.05.625c.014.504-.015 1.117-.074 1.735c-.06.617-.149 1.214-.249 1.685q-.033.157-.066.286H31a1 1 0 0 0-.894.553l-1 2A1 1 0 0 0 29 36v2a1 1 0 0 0 1 1h2v-2h-1v-.764L31.618 35h2.764L35 36.236V37h-1v2h2a1 1 0 0 0 1-1v-2a1 1 0 0 0-.106-.447l-1-2A1 1 0 0 0 35 33h-.636c.107-.533.196-1.155.256-1.779c.066-.674.1-1.373.083-1.983l-.001-.028C38.69 30.895 42 33.666 42 36.57V42H6v-5.43c0-3.032 3.61-5.92 7.831-7.577c.011.622.07 1.325.155 2.006c.092.735.217 1.466.355 2.068q.045.193.092.375M16 37.015c.538 0 1-.44 1-1.015c0-.574-.462-1.015-1-1.015s-1 .44-1 1.015c0 .574.462 1.015 1 1.015M24 24a8 8 0 1 0 0-16a8 8 0 0 0 0 16m0 2c5.523 0 10-4.477 10-10S29.523 6 24 6s-10 4.477-10 10s4.477 10 10 10"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <h5 class="fw-bold mb-2 text-muted">Atendido por</h5>
                                    </div>
                                    <p class="m-0"><span class="fw-bold me-2 text-muted">Nombre :
                                        </span>{{ auth()->user()->name }}</p>
                                    <p class="m-0"><span class="fw-bold me-2 text-muted">Cédula :
                                        </span>{{ auth()->user()->cedula ?? 'No tiene' }}</p>
                                    <p class="m-0"><span class="fw-bold me-2 text-muted">Fecha de consulta :
                                        </span>{{ $consulta->fecha }}</p>
                                </div>
                            </div>

                        </x-card-custom>

                        <x-card-custom>
                            <x-slot name="title">Signos vitales</x-slot>

                            <div class="row">
                                <div class="col-12 col-md-6 col-xl-4">

                                    {{-- Frecuencia cardiaca --}}
                                    <x-form-group-vital-signs label="Frecuencia cardiaca (Ipm)" class="vitalSigns"
                                        :text="$signosVitales->frecuencia_cardiaca ?? 'Error en cargar los datos'" />

                                    <hr class="my-2">

                                    {{-- Presión arterial --}}
                                    <x-form-group-vital-signs label="Presión arterial (mm/Hg)" class="vitalSigns"
                                        :text="$signosVitales->presion_arterial ?? 'Error en cargar los datos'" />

                                    <hr class="my-2">

                                    {{-- Temperatura --}}
                                    <x-form-group-vital-signs label="Temperatura (°C)" class="vitalSigns"
                                        :text="$signosVitales->temperatura ?? 'Error en cargar los datos'" />

                                </div>

                                <div class="col-12 col-md-6 col-xl-4">

                                    <hr class="my-2 d-md-none">


                                    {{-- Peso --}}
                                    <x-form-group-vital-signs label="Peso (kg)" class="vitalSigns" :text="$signosVitales->peso ?? 'Error en cargar los datos'" />

                                    <hr class="my-2">

                                    {{-- Frecuencia respiratoria --}}
                                    <x-form-group-vital-signs label="Frecuencia respiratoria (rpm)" class="vitalSigns"
                                        :text="$signosVitales->ritmo_respiratorio ?? 'Error en cargar los datos'" />

                                    <hr class="my-2">

                                    {{-- Síndrome autoinmune tirogástrico --}}
                                    <x-form-group-vital-signs label="Síndrome autoinmune tirogástrico (%)"
                                        class="vitalSigns" :text="$signosVitales->sindrome_autoinmune_tirogastrico ??
                                            'Error en cargar los datos'" />


                                </div>

                                <div class="col-12 col-md-6 col-xl-4">

                                    <hr class="my-2 d-xl-none">

                                    {{-- Talla --}}
                                    <x-form-group-vital-signs label="Talla (cm)" class="vitalSigns" :text="$signosVitales->talla ?? 'Error en cargar los datos'" />

                                    <hr class="my-2">

                                    {{-- Glucosa --}}
                                    <x-form-group-vital-signs label="Glucosa (mg/dL)" class="vitalSigns"
                                        :text="$signosVitales->glucosa ?? 'Error en cargar los datos'" />

                                </div>

                            </div>

                        </x-card-custom>


                        <x-card-custom>
                            <x-slot name="title">Interrogatorio</x-slot>

                            {{-- Motivo de la consulta --}}
                            <x-form-group-details-consultation label="Motivo de la consulta" :text="$consulta->motivo_consulta">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="20" height="20"
                                        viewBox="0 0 24 24">
                                        <g fill="none" stroke="#0284c7" stroke-width="1.5">
                                            <path
                                                d="M3 10c0-3.771 0-5.657 1.172-6.828C5.343 2 7.229 2 11 2h2c3.771 0 5.657 0 6.828 1.172C21 4.343 21 6.229 21 10v4c0 3.771 0 5.657-1.172 6.828C18.657 22 16.771 22 13 22h-2c-3.771 0-5.657 0-6.828-1.172C3 19.657 3 17.771 3 14z" />
                                            <path stroke-linecap="round" d="M8 12h8M8 8h8m-8 8h5" />
                                        </g>
                                    </svg>
                                </x-slot>
                            </x-form-group-details-consultation>

                            <hr class="my-4">

                            {{-- Enfermedad actual --}}

                            {{-- Auxiliares DX y TX previos --}}
                            <x-form-group-details-consultation label="Auxiliares DX y TX previos" :text="$consulta->auxiliares_dx_tx_previo">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="20" height="20"
                                        viewBox="0 0 24 24">
                                        <path fill="#4f46e5" d="M17 16q-1.25 0-2.125-.875T14 13t.875-2.125T17 10t2.125.875T20 13t-.875 2.125T17 16m0-2q.425 0 .713-.288T18 13t-.288-.712T17 12t-.712.288T16 13t.288.713T17 14m-6 9v-2.9q0-.525.25-.987t.7-.738q.8-.475 1.688-.788t1.812-.462L17 19l1.55-1.875q.925.15 1.8.463t1.675.787q.45.275.713.738T23 20.1V23zm1.975-2h3.075l-1.35-1.65q-.45.125-.875.325t-.85.425zm4.975 0H21v-.9q-.4-.25-.825-.437t-.875-.313zM5 21q-.825 0-1.413-.587T3 19V5q0-.825.588-1.412T5 3h14q.825 0 1.413.588T21 5v5q-.4-.5-.875-.95T19 8.45V5H5v14h4.15q-.075.275-.112.55T9 20.1v.9zM7 9h7q.65-.5 1.425-.75T17 8V7H7zm0 4h5q0-.525.112-1.025t.313-.975H7zm0 4h3.45q.275-.225.588-.4
                                                t.637-.325V15H7zm-2 2V5v3.425V8zm12-6" />
                                    </svg>
                                </x-slot>
                            </x-form-group-details-consultation>

                        </x-card-custom>

                        <x-card-custom>
                            <x-slot name="title">Detalles</x-slot>


                            {{-- Exploracion fisica --}}
                            <x-form-group-details-consultation label="Exploración física" :text="$consulta->exploracion_fisica">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="20" height="20"
                                        viewBox="0 0 24 24">
                                        <path fill="#0891b2"
                                            d="M3 20v-4q0-2.075 1.463-3.537T8 11h10.725q.95 0 1.613.65t.662 1.6q0 .775-.475 1.388t-1.2.812L17 16.125V20q0 .525-.237.95t-.638.7t-.875.338t-.975-.138L9.55 20zm12-3H9.375q-.175 0-.262.1T9 17.325t.038.238t.212.162L15 20zM5 18h2.1q-.05-.15-.075-.3T7 17.375q0-.975.7-1.675t1.675-.7h4.075l5.35-1.475q.125-.05.175-.125t.025-.175t-.088-.162t-.187-.063H8q-1.25 0-2.125.875T5 16zm5-8q-1.65 0-2.825-1.175T6 6t1.175-2.825T10 2t2.825 1.175T14 6t-1.175 2.825T10 10m0-2q.825 0 1.413-.587T12 6t-.587-1.412T10 4t-1.412.588T8 6t.588 1.413T10 8m0-2" />
                                    </svg>
                                </x-slot>
                            </x-form-group-details-consultation>


                            <hr class="my-4">

                            {{-- Diagnóstico --}}
                            <x-form-group-details-consultation label="Diagnóstico" :text="$consulta->diagnostico">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="20" height="20"
                                        viewBox="0 0 2048 2048">
                                        <path fill="#0284c7"
                                            d="M1920 128v1792H128V128zM256 256v1024h150l109-109q19-19 45-19t45 19l177 176l244-947q5-21 22-34t40-14q23 0 40 13t22 36l102 417h156q22 0 39 13t23 35l72 286h250V256zm1536 1536v-512h-300q-23 0-40-13t-22-36l-72-285h-156q-23 0-40-13t-22-36l-54-218l-208 809q-5 21-22 34t-40 14q-26 0-45-19l-211-211l-83 83q-19 19-45 19H256v384z" />
                                    </svg>
                                </x-slot>
                            </x-form-group-details-consultation>
                        
                            <hr class="my-4">


                            {{-- Tratamiento --}}
                            <x-form-group-details-consultation label="Tratamiento" :text="$consulta->tratamiento">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="20" height="20"
                                        viewBox="0 0 24 24">
                                        <g fill="none" stroke="#e11d48" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2">
                                            <path d="m11 18l7-7a3.536 3.536 0 0 0-5-5l-7 7a3.536 3.536 0 0 0 5 5" />
                                            <path d="M14.5 14.5a9.52 9.52 0 0 1-5-5v0" />
                                        </g>
                                    </svg>
                                </x-slot>
                            </x-form-group-details-consultation>

                            <hr class="my-4">

                            {{-- Observaciones --}}
                            <x-form-group-details-consultation label="Observaciones" :text="$consulta->observaciones">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="20" height="20"
                                        viewBox="0 0 48 48">
                                        <defs>
                                            <mask id="IconifyId190503196b5afcd6a3">
                                                <g fill="none" stroke="#fff" stroke-linejoin="round"
                                                    stroke-width="4">
                                                    <rect width="12" height="38" x="6" y="5" rx="6" />
                                                    <rect width="12" height="38" x="30" y="5" rx="6" />
                                                    <path fill="#555"
                                                        d="M12 43a6 6 0 1 0 0-12a6 6 0 0 0 0 12Zm24 0a6 6 0 1 0 0-12a6 6 0 0 0 0 12Z" />
                                                    <path stroke-linecap="round"
                                                        d="M30 21a6 6 0 0 0-12 0m12 10a6 6 0 0 0-12 0" />
                                                </g>
                                            </mask>
                                        </defs>
                                        <path fill="#059669" d="M0 0h48v48H0z" mask="url(#IconifyId190503196b5afcd6a3)" />
                                    </svg>
                                </x-slot>
                            </x-form-group-details-consultation>


                        </x-card-custom>


                    </div>

                    <div class="col-12 col-md-6 col-lg-5 col-xl-3">
                        <x-card-only-shadow>
                            <x-button-link-custom type="text" class="btn-blue-sec justify-content-center w-100 mb-2"
                                text="Descargar receta" :route="route('consultation.history.pdf',[ $person->id_persona, $consulta->id_consulta])"
                                tooltipText="Presiona para descargar la receta de la consulta">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="me-1"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z" />
                                    </svg>
                                </x-slot>
                            </x-button-custom>

                            <x-button-link-custom :route="route('consultation.history', $person->id_persona)" class="btn-sec justify-content-center mb-2"
                                text="Historial de consultas" tooltipText="Ver el historial de consultas del paciente">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M7 9V7h14v2zm0 4v-2h14v2zm0 4v-2h14v2zM4 9q-.425 0-.712-.288T3 8t.288-.712T4 7t.713.288T5 8t-.288.713T4 9m0 4q-.425 0-.712-.288T3 12t.288-.712T4 11t.713.288T5 12t-.288.713T4 13m0 4q-.425 0-.712-.288T3 16t.288-.712T4 15t.713.288T5 16t-.288.713T4 17" />
                                    </svg>
                                </x-slot>
                            </x-button-link-custom>

                            <x-button-link-custom :route="route('consultation.new', $person->id_persona)" class="btn-blue justify-content-center"
                                text="Agregar consulta" tooltipText="Agregar una nueva consulta al paciente">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24">
                                        <path d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                                    </svg>
                                </x-slot>
                            </x-button-link-custom>


                        </x-card-only-shadow>




                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('scripts')
    @vite('resources/js/consultations/detailsConsultation.js')
@endsection
