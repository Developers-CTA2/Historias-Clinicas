@extends('admin.layouts.main')

@section('title', 'Detalles')

@section('viteConfig')
    @vite(['resources/sass/form-style.scss', 'resources/sass/details-nutrition-consultation.scss'])
@endsection


@section('content')



    {{-- Select type Person --}}
    <div class="container max-w-custom mb-4">
        <h4 class="fw-bold">Detalle de la consulta</h4>

        <x-button-up-screen />

        <div class="row mt-3">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-9">

                        {{-- Card de datos de la consulta --}}
                        <x-card-custom>
                            <x-slot name="title">Datos generales</x-slot>

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
                                        </span>{{ $doctor->name }}</p>
                                    <p class="m-0"><span class="fw-bold me-2 text-muted">Cédula :
                                        </span>{{ $doctor->cedula ?? 'No tiene' }}</p>
                                    <p class="m-0"><span class="fw-bold me-2 text-muted">Fecha de consulta :
                                        </span>{{ $consulta->fecha ?? 'No hay fecha' }}</p>
                                </div>
                            </div>

                        </x-card-custom>


                        <div class="row">
                            <div class="col-12 col-lg-4">

                                {{-- Estilo de vida --}}
                                <x-card-custom>
                                    <x-slot name="title">Estilo de vida</x-slot>

                                    {{-- Actividad fisica --}}
                                    <x-form-group-details-consultation label="Actividad física" :text="$estiloVida->actividad ?? '--'">
                                        <x-slot name="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 24 24">
                                                <path fill="#059669"
                                                    d="m19.4 9.375l-.688-.688l.48-.506q.193-.192.193-.433q0-.24-.193-.433l-2.508-2.507q-.192-.192-.432-.192t-.433.192l-.506.48l-.713-.713l.558-.583q.44-.44 1.079-.427t1.079.452l2.667 2.668q.44.44.44 1.066t-.44 1.066zM8.842 19.958q-.44.44-1.066.44t-1.066-.44l-2.59-2.59q-.46-.46-.46-1.144t.46-1.143l.48-.481l.714.714l-.487.48q-.192.193-.192.433t.192.433l2.514 2.513q.192.193.432.193t.433-.193l.48-.486l.714.713zm9.733-6.804l1.137-1.137q.192-.192.192-.442t-.192-.442l-6.845-6.844q-.192-.193-.442-.193t-.442.192l-1.137 1.137q-.192.192-.192.433q0 .24.192.433l6.864 6.863q.192.192.432.192t.433-.192m-6.558 6.558l1.137-1.143q.192-.192.192-.432t-.192-.433l-6.858-6.858q-.192-.192-.433-.192q-.24 0-.432.192l-1.143 1.137q-.192.192-.192.442t.192.442l6.845 6.844q.192.193.442.193t.442-.192m-.708-5.273l3.135-3.13l-1.754-1.753l-3.129 3.135zm1.402 5.98q-.459.46-1.136.46t-1.137-.46l-6.857-6.857q-.46-.46-.46-1.137t.46-1.136l1.136-1.156q.46-.46 1.144-.46t1.143.46l1.844 1.844l3.135-3.135l-1.844-1.838q-.46-.46-.46-1.146t.46-1.146l1.155-1.156q.46-.46 1.143-.46t1.144.46l6.863 6.863q.46.46.46 1.144t-.46 1.143l-1.155 1.156q-.46.46-1.147.46t-1.146-.46l-1.838-1.845l-3.135 3.135l1.844 1.844q.46.46.46 1.144t-.46 1.143z" />
                                            </svg>
                                        </x-slot>
                                    </x-form-group-details-consultation>

                                    <hr class="my-3">

                                    <x-form-group-details-consultation label="Tipo de ejercicio" :text="$estiloVida->tipo_ejercicio ?? '--'">
                                        <x-slot name="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 24 24">
                                                <path fill="none" stroke="#4f46e5" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1.5"
                                                    d="M17 4.5a1.5 1.5 0 1 1-3 0a1.5 1.5 0 0 1 3 0M15 21l-.664-2.616a4.9 4.9 0 0 0-1.315-2.288L11.5 14.6M6 11.153C7 9.183 8.538 8.04 12 8m0 0c.219-.003.544-.004.87-.004c.505 0 .757 0 .958.094s.408.34.82.834c.118.14.24.267.352.352M12 8l-1.27 1.958c-.697 1.076-1.046 1.615-1.06 2.18a2 2 0 0 0 .123.739c.195.53.7.927 1.707 1.721M15 9.277c1.155.866 2.963 1.214 5-1.079m-5 1.079l-3.5 5.322M4 17.73l.678.162C6.407 18.302 8.203 17.516 9 16"
                                                    color="#4f46e5" />
                                            </svg>
                                        </x-slot>
                                    </x-form-group-details-consultation>

                                    <hr class="my-3">

                                    <x-form-group-details-consultation label="Frecuencia" :text="$estiloVida->frecuencia_ejercicio ?? '--'">
                                        <x-slot name="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 36 36">
                                                <path fill="#0891b2"
                                                    d="M32.25 6H29v2h3v22H4V8h3V6H3.75A1.78 1.78 0 0 0 2 7.81v22.38A1.78 1.78 0 0 0 3.75 32h28.5A1.78 1.78 0 0 0 34 30.19V7.81A1.78 1.78 0 0 0 32.25 6"
                                                    class="clr-i-outline clr-i-outline-path-1" />
                                                <path fill="#0891b2" d="M8 14h2v2H8z"
                                                    class="clr-i-outline clr-i-outline-path-2" />
                                                <path fill="#0891b2" d="M14 14h2v2h-2z"
                                                    class="clr-i-outline clr-i-outline-path-3" />
                                                <path fill="#0891b2" d="M20 14h2v2h-2z"
                                                    class="clr-i-outline clr-i-outline-path-4" />
                                                <path fill="#0891b2" d="M26 14h2v2h-2z"
                                                    class="clr-i-outline clr-i-outline-path-5" />
                                                <path fill="#0891b2" d="M8 19h2v2H8z"
                                                    class="clr-i-outline clr-i-outline-path-6" />
                                                <path fill="#0891b2" d="M14 19h2v2h-2z"
                                                    class="clr-i-outline clr-i-outline-path-7" />
                                                <path fill="#0891b2" d="M20 19h2v2h-2z"
                                                    class="clr-i-outline clr-i-outline-path-8" />
                                                <path fill="#0891b2" d="M26 19h2v2h-2z"
                                                    class="clr-i-outline clr-i-outline-path-9" />
                                                <path fill="#0891b2" d="M8 24h2v2H8z"
                                                    class="clr-i-outline clr-i-outline-path-10" />
                                                <path fill="#0891b2" d="M14 24h2v2h-2z"
                                                    class="clr-i-outline clr-i-outline-path-11" />
                                                <path fill="#0891b2" d="M20 24h2v2h-2z"
                                                    class="clr-i-outline clr-i-outline-path-12" />
                                                <path fill="#0891b2" d="M26 24h2v2h-2z"
                                                    class="clr-i-outline clr-i-outline-path-13" />
                                                <path fill="#0891b2"
                                                    d="M10 10a1 1 0 0 0 1-1V3a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1"
                                                    class="clr-i-outline clr-i-outline-path-14" />
                                                <path fill="#0891b2"
                                                    d="M26 10a1 1 0 0 0 1-1V3a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1"
                                                    class="clr-i-outline clr-i-outline-path-15" />
                                                <path fill="#0891b2" d="M13 6h10v2H13z"
                                                    class="clr-i-outline clr-i-outline-path-16" />
                                                <path fill="none" d="M0 0h36v36H0z" />
                                            </svg>
                                        </x-slot>
                                    </x-form-group-details-consultation>

                                    <hr class="my-3">

                                    <x-form-group-details-consultation label="Tipo de ejercicio" :text="$estiloVida->duracion_ejercicio ?? '--'">
                                        <x-slot name="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 24 24">
                                                <path fill="#e11d48"
                                                    d="M9.385 2.5v-1h5.23v1zM11.5 13.616h1V8.385h-1zM12 21q-1.658 0-3.113-.626t-2.545-1.716t-1.716-2.546T4 13t.626-3.113t1.716-2.545t2.546-1.716T12 5q1.454 0 2.812.52t2.492 1.469l1.092-1.093l.708.708l-1.092 1.092q.95 1.135 1.469 2.493T20 13q0 1.658-.626 3.113t-1.716 2.545t-2.546 1.716T12 21m0-1q2.9 0 4.95-2.05T19 13t-2.05-4.95T12 6T7.05 8.05T5 13t2.05 4.95T12 20m0-7" />
                                            </svg>
                                        </x-slot>
                                    </x-form-group-details-consultation>

                                    <hr class="my-3">


                                </x-card-custom>
                            </div>

                            {{-- Indicadores dieteticos --}}
                            <div class="col-12 col-lg-8">

                                <x-card-custom>
                                    <x-slot name="title">Indicadores dietéticos</x-slot>

                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            {{-- Comidas al dia --}}
                                            <x-form-group-details-consultation label="Comidas al día" :text="$indicadoresDieteticos->comidas_al_dia ?? '--'">
                                                <x-slot name="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                        viewBox="0 0 2048 2048">
                                                        <path fill="#059669"
                                                            d="M960 0q26 0 45 19t19 45v704q0 53-20 99t-55 81t-82 55t-99 21v960q0 26-19 45t-45 19t-45-19t-19-45v-960q-53 0-99-20t-81-55t-55-81t-21-100V64q0-26 19-45t45-19t45 19t19 45v704q0 27 10 50t27 40t41 28t50 10V64q0-26 19-45t45-19t45 19t19 45v832q27 0 50-10t40-27t28-41t10-50V64q0-26 19-45t45-19m704 0v1984q0 26-19 45t-45 19t-45-19t-19-45v-576q-37 0-80 1t-85-1t-82-12t-70-31t-49-57t-18-92V448q0-93 35-174t96-142t142-96t175-36zm-128 134q-56 11-102 40t-81 72t-54 93t-19 109v768q0 26 19 45t45 19h192z" />
                                                    </svg>
                                                </x-slot>
                                            </x-form-group-details-consultation>

                                            <hr class="my-3">


                                            {{-- Quien lo prepara --}}
                                            <x-form-group-details-consultation label="Quien la prepara" :text="$indicadoresDieteticos->qien_prepara_comida ?? '--'">
                                                <x-slot name="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                        viewBox="0 0 256 256">
                                                        <path fill="#4f46e5"
                                                            d="M139 158.25a66 66 0 1 0-62 0c-22 6.23-41.88 19.16-57.61 37.89a6 6 0 0 0 9.18 7.72C49.11 179.44 77.31 166 108 166s58.9 13.44 79.41 37.86a6 6 0 1 0 9.18-7.72C180.86 177.41 161 164.48 139 158.25M54 100a54 54 0 1 1 54 54a54.06 54.06 0 0 1-54-54m198.24 32.24l-32 32a6 6 0 0 1-8.48 0l-16-16a6 6 0 0 1 8.48-8.48L216 151.51l27.76-27.75a6 6 0 1 1 8.48 8.48" />
                                                    </svg>
                                                </x-slot>
                                            </x-form-group-details-consultation>

                                            <hr class="my-3">

                                            {{-- Apetito --}}
                                            <x-form-group-details-consultation label="Apetito" :text="$indicadoresDieteticos->apetito ?? '--'">
                                                <x-slot name="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                        viewBox="0 0 14 14">
                                                        <path fill="none" stroke="#0284c7" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M.858 6.612h12.007a6 6 0 0 1-3.43 5.426v1.078H4.287v-1.078a6 6 0 0 1-3.43-5.426ZM10.499.858c-.858 1.231 1.286 2.462.429 3.693M6.633.858C5.775 2.09 7.919 3.32 7.06 4.551M2.78.858c-.858 1.231 1.286 2.462.429 3.693" />
                                                    </svg>
                                                </x-slot>
                                            </x-form-group-details-consultation>

                                            <hr class="my-3">

                                            {{-- Grasas consumidas --}}
                                            <x-form-group-details-consultation label="Grasas consumidas" :text="$indicadoresDieteticos->grasas_consumidas ?? '--'">
                                                <x-slot name="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                        viewBox="0 0 512 512">
                                                        <path fill="#db2777"
                                                            d="M333.7 21.92S347.8 45.41 344 57c-3.4 10.38-23.5 9.3-26 19.94c-1.9 8.45 7.2 21.49 12.5 28.16h6.8c7.1-11.21 12.6-21.78 14-34.94c7.9 8.26 10.4 21.29 1.1 34.94h8.4c8-9.54 24.2-30.9 21.2-44.69c-4.3-20.13-48.3-38.49-48.3-38.49M104 51.07c-17.5 0-29.44 4.94-35.49 14.01S63 84.07 63 92.07v12.03h18V92.07c0-8 .54-14.08 2.49-17.01s6.01-5.99 20.51-5.99h64c10 0 23 12.46 23 24.59V215.7h18v-28.6h103.3l1.6-18H209V93.66c0-23.05-19-42.59-41-42.59zM56 121.1v18h32v-18zm280.2 2l-14.3 158h44.2l-14.3-158zM72 155.1c-10 0-19.88 3.4-27.02 9.7C37.83 171.2 33 180.3 33 194.1v296h78v-296c0-13.7-4.8-22.9-12-29.3c-7.12-6.3-17-9.7-27-9.7m307.9 78l1.6 18H408c14.5 0 23.7 3.5 29.6 9.4c5.9 6 9.4 15.5 9.4 30.4v39.9c2.8-1.1 5.8-1.7 9-1.7s6.2.6 9 1.7v-39.9c0-17.9-4.5-32.8-14.6-43c-10.1-10.3-24.9-14.8-42.4-14.8zm-202.9 2v14h46v-14zm23.5 32c-29.7 0-55.8 14.7-71.5 37.3v16.7h142V303c-15.8-21.7-41.4-35.9-70.5-35.9m88.5 32v110h110v-110zm-160 40v14h142v-14zm327 8c-4 0-7 3-7 7s3 7 7 7s7-3 7-7s-3-7-7-7m-327 24v32.6c6.6 9.5 15 17.6 24.7 23.8L131 473.1v17h37.5v-17h-17.4l18.8-37.5c9.5 3.5 19.8 5.5 30.6 5.5s21.1-2 30.6-5.5l18.8 37.5h-17.4v17h64v-17h-26.4l-22.8-45.6c9.2-5.9 17.3-13.5 23.7-22.3v-34.1zm318 6.3v31.7h18v-31.7c-2.8 1.1-5.8 1.7-9 1.7s-6.2-.6-9-1.7m-116.3 49.7l49.6 63h41l-49.6-63zm64 0l49.6 63H479v-8.9l-43.3-54.1zm64 0l20.3 25.4v-25.4zM321 443.7v46.4h36.3z" />
                                                    </svg>
                                                </x-slot>
                                            </x-form-group-details-consultation>

                                            <hr class="my-3">
                                        </div>


                                        <div class="col-12 col-lg-6 d-flex flex-column">


                                            {{-- Alimentos no preferidos --}}
                                            <div class="flex-grow-1 overflow-y-auto max-h-custom-content">
                                                <x-form-group-details-consultation label="Alimentos no preferidos"
                                                    :text="$indicadoresDieteticos->alimentos_no_preferidos ?? '--'">
                                                    <x-slot name="icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                                            height="25" viewBox="0 0 24 24">
                                                            <g fill="none" stroke="#e11d48" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="1.5"
                                                                color="#e11d48">
                                                                <circle cx="12" cy="12" r="10" />
                                                                <path
                                                                    d="M7 8c.21.583.775 1 1.44 1s1.229-.417 1.438-1m4.244 0c.21.583.774 1 1.439 1c.664 0 1.23-.417 1.439-1m-5 5.5c1.673 0 3.11.956 3.73 2.32c.25.552.375.828.159 1.055c-.217.227-.598.116-1.362-.105c-.723-.21-1.625-.4-2.527-.4s-1.804.19-2.527.4c-.764.221-1.145.332-1.362.105c-.216-.227-.091-.503.16-1.055c.62-1.364 2.056-2.32 3.729-2.32" />
                                                            </g>
                                                        </svg>
                                                    </x-slot>
                                                </x-form-group-details-consultation>

                                                <hr class="my-3">
                                            </div>

                                            <div class="flex-grow-1 overflow-y-auto max-h-custom-content">
                                                {{-- Suplementos --}}
                                                <x-form-group-details-consultation label="Suplementos" :text="$indicadoresDieteticos->suplementos ?? '--'">
                                                    <x-slot name="icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                                            height="25" viewBox="0 0 24 24">
                                                            <g fill="none" stroke="#7c3aed" stroke-width="1.5">
                                                                <path
                                                                    d="M17.845 6.155s-.433 2.245-2.94 4.751c-2.505 2.506-4.75 2.938-4.75 2.938m10.253 2.563a5.437 5.437 0 0 1-7.69 0l-5.126-5.126a5.437 5.437 0 1 1 7.69-7.689l5.125 5.126a5.437 5.437 0 0 1 0 7.69Z" />
                                                                <path stroke-linecap="round" d="M14.5 6.5L13 5"
                                                                    opacity=".5" />
                                                                <path d="M6.73 10.135a6 6 0 1 0 7.143 7.098"
                                                                    opacity=".5" />
                                                            </g>
                                                        </svg>
                                                    </x-slot>
                                                </x-form-group-details-consultation>

                                                <hr class="my-3">

                                            </div>
                                        </div>

                                    </div>

                                </x-card-custom>
                            </div>

                            <div class="col-12 col-lg-8">
                                <x-card-custom>
                                    <x-slot name="title">Medidas Corporales</x-slot>

                                    <div class="row">
                                        <div class="col-12 col-lg-6">

                                            {{-- Peso actual --}}
                                            <x-form-group-details-consultation label="Peso actual" :text="$medidas->peso_actual . ' kg'" >
                                                <x-slot name="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 48 48"><g fill="#0891b2" fill-rule="evenodd" clip-rule="evenodd"><path d="M35.851 16.25c.742.819.515 2.076-.39 2.71l-4.872 3.418c-.904.634-2.14.378-3.033-.27a6.04 6.04 0 0 0-3.455-1.156a6.05 6.05 0 0 0-3.492 1.04c-.915.619-2.158.834-3.04.17l-4.757-3.578c-.882-.664-1.068-1.929-.299-2.722a16 16 0 0 1 23.338.389m-1.655 1.156a14 14 0 0 0-20.067-.334l4.638 3.488a.4.4 0 0 0 .13.006c.157-.014.377-.086.59-.23a8.05 8.05 0 0 1 4.8-1.38q.057-.12.149-.226l2.746-3.158a1 1 0 0 1 1.51 1.312l-2.155 2.478a8 8 0 0 1 2.195 1.127c.208.151.425.23.582.25c.076.01.116.003.13-.001zm-4.743 3.329l-.008.003q.006-.005.008-.003m-10.694-.178l.008.003z"/><path d="M36.216 42a4 4 0 0 0 3.994-3.778l1.556-28A4 4 0 0 0 37.772 6H10.228a4 4 0 0 0-3.993 4.222l1.555 28A4 4 0 0 0 11.784 42zm-24.432-2h24.432a2 2 0 0 0 1.997-1.89l1.556-28A2 2 0 0 0 37.772 8H10.228a2 2 0 0 0-1.997 2.11l1.556 28A2 2 0 0 0 11.784 40"/></g></svg>
                                                </x-slot>
                                            </x-form-group-details-consultation>

                                            <hr class="my-3">

                                            {{-- Peso habitual --}}
                                            <x-form-group-details-consultation label="Peso habitual" :text="$medidas->peso_habitual . ' kg'">
                                                <x-slot name="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 48 48"><g fill="#0891b2" fill-rule="evenodd" clip-rule="evenodd"><path d="M35.851 16.25c.742.819.515 2.076-.39 2.71l-4.872 3.418c-.904.634-2.14.378-3.033-.27a6.04 6.04 0 0 0-3.455-1.156a6.05 6.05 0 0 0-3.492 1.04c-.915.619-2.158.834-3.04.17l-4.757-3.578c-.882-.664-1.068-1.929-.299-2.722a16 16 0 0 1 23.338.389m-1.655 1.156a14 14 0 0 0-20.067-.334l4.638 3.488a.4.4 0 0 0 .13.006c.157-.014.377-.086.59-.23a8.05 8.05 0 0 1 4.8-1.38q.057-.12.149-.226l2.746-3.158a1 1 0 0 1 1.51 1.312l-2.155 2.478a8 8 0 0 1 2.195 1.127c.208.151.425.23.582.25c.076.01.116.003.13-.001zm-4.743 3.329l-.008.003q.006-.005.008-.003m-10.694-.178l.008.003z"/><path d="M36.216 42a4 4 0 0 0 3.994-3.778l1.556-28A4 4 0 0 0 37.772 6H10.228a4 4 0 0 0-3.993 4.222l1.555 28A4 4 0 0 0 11.784 42zm-24.432-2h24.432a2 2 0 0 0 1.997-1.89l1.556-28A2 2 0 0 0 37.772 8H10.228a2 2 0 0 0-1.997 2.11l1.556 28A2 2 0 0 0 11.784 40"/></g></svg>
                                                </x-slot>
                                            </x-form-group-details-consultation>

                                            <hr class="my-3">

                                        </div>


                                        <div class="col-12 col-lg-6">
                                            
                                            {{-- Circunferencia  cadera --}}
                                            <x-form-group-details-consultation label="Circunferencia de cadera" :text="$medidas->circunferencia_cadera . ' cm'">
                                                <x-slot name="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#7c3aed" d="M5.616 19v-7.5q0-3.132 2.182-5.316T13.112 4t5.317 2.183t2.187 5.313t-2.184 5.318T13.116 19zm1-1h6.5q2.7 0 4.6-1.9t1.9-4.6t-1.9-4.6t-4.6-1.9t-4.6 1.9t-1.9 4.6zm6.5-3.5q1.257 0 2.128-.871t.872-2.129t-.872-2.129t-2.128-.871t-2.13.871q-.87.871-.87 2.129t.87 2.129t2.13.871m-.003-1q-.834 0-1.416-.584q-.581-.584-.581-1.418t.584-1.416t1.418-.582t1.416.584t.582 1.418t-.584 1.416t-1.419.582M3.385 19v-4h1v4zm9.73-7.5"/></svg>
                                                </x-slot>
                                            </x-form-group-details-consultation>

                                            <hr class="my-3">

                                            {{-- Circunferencia  cintura--}}
                                            <x-form-group-details-consultation label="Circunferencia de cintura" :text="$medidas->circunferencia_cintura . ' cm'">
                                                <x-slot name="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#7c3aed" d="M5.616 19v-7.5q0-3.132 2.182-5.316T13.112 4t5.317 2.183t2.187 5.313t-2.184 5.318T13.116 19zm1-1h6.5q2.7 0 4.6-1.9t1.9-4.6t-1.9-4.6t-4.6-1.9t-4.6 1.9t-1.9 4.6zm6.5-3.5q1.257 0 2.128-.871t.872-2.129t-.872-2.129t-2.128-.871t-2.13.871q-.87.871-.87 2.129t.87 2.129t2.13.871m-.003-1q-.834 0-1.416-.584q-.581-.584-.581-1.418t.584-1.416t1.418-.582t1.416.584t.582 1.418t-.584 1.416t-1.419.582M3.385 19v-4h1v4zm9.73-7.5"/></svg>
                                                </x-slot>
                                            </x-form-group-details-consultation>

                                            <hr class="my-3">

                                        </div>


                                        <div class="col-12">

                                            {{-- Estatura  --}}
                                            <x-form-group-details-consultation label="Estatura" :text="$medidas->estatura . ' cm'">
                                                <x-slot name="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 48 48"><g fill="#059669"><path d="m36.5 3.586l4.207 4.207a1 1 0 0 1-1.414 1.414L37.5 7.414V44h-2V7.414l-1.793 1.793a1 1 0 1 1-1.414-1.414z"/><path fill-rule="evenodd" d="M29 9a5 5 0 1 1-10 0a5 5 0 0 1 10 0m-2 0a3 3 0 1 1-6 0a3 3 0 0 1 6 0m.913 35a3 3 0 0 1-2.988-2.729L24.173 33h-.347l-.752 8.271a3 3 0 0 1-.096.531A3 3 0 0 1 20.086 44H20a3 3 0 0 1-3-3v-8.793a4 4 0 0 1-1.608-3.096l-.264-9.517a4 4 0 0 1 4.44-4.087l3.99.444q.442.048.884 0l3.86-.43a4 4 0 0 1 4.436 4.198l-.528 9.503a4 4 0 0 1-1.21 2.65V41a3 3 0 0 1-3 3zM19 32.207a2 2 0 0 0-.804-1.603a2 2 0 0 1-.805-1.549l-.264-9.516a2 2 0 0 1 2.22-2.044l3.99.444c.44.049.885.049 1.326 0l3.86-.43a2 2 0 0 1 2.218 2.1l-.528 9.502a2 2 0 0 1-.605 1.325A2 2 0 0 0 29 31.872V41a1 1 0 0 1-1 1h-.087a1 1 0 0 1-.996-.91l-.752-8.271a2 2 0 0 0-1.992-1.82h-.347a2 2 0 0 0-1.992 1.82l-.752 8.271a1 1 0 0 1-.995.91H20a1 1 0 0 1-1-1z" clip-rule="evenodd"/></g></svg>
                                                </x-slot>
                                            </x-form-group-details-consultation>

                                            <hr class="my-3">

                                        </div>
                                    </div>

                                </x-card-custom>
                            </div>

                            <div class="col-12 col-lg-4">
                                <x-card-custom>
                                    <x-slot name="title">IMC</x-slot>

                                    <div class="row d-flex flex-column">
                                        <div class="col-12 h-custom-avatar-imc d-flex justify-content-center">
                                            <img src="{{asset('/images/'.$imc['url'])}}" alt="Medidor indice de masa corporal">
                                        </div>
                                        <div class="col-12 text-center">
                                            <hr class="my-3">
                                            <h5>{{$imc['titleImc']}}</h5>
                                        </div>
                                    </div>

                                </x-card-custom>
                            </div>

                            <div class="col-12">
                                <x-card-custom>
                                    <x-slot name="title">Consulta</x-slot>

                                    <div class="row">
                                        <div class="col-12">

                                             {{-- Vasos de agua  --}}
                                             <x-form-group-details-consultation label="Vasos de agua" :text="$consulta->vasos_agua">
                                                <x-slot name="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><g fill="none" stroke="#0284c7" stroke-width="2"><path stroke-linecap="round" d="M12 18a2 2 0 0 1-1.932-1.482"/><path d="M10.424 4.679c.631-1.073.947-1.61 1.398-1.69a1 1 0 0 1 .356 0c.451.08.767.617 1.398 1.69l1.668 2.836a27.2 27.2 0 0 1 2.707 6.315c1.027 3.593-1.67 7.17-5.408 7.17h-1.086c-3.737 0-6.435-3.577-5.408-7.17a27.2 27.2 0 0 1 2.707-6.315z"/></g></svg>
                                                </x-slot>
                                            </x-form-group-details-consultation>

                                            <hr class="my-3">

                                            {{-- Motivo de la consulta  --}}
                                            <x-form-group-details-consultation label="Motivo de la consulta" :text="$consulta->motivo_consulta">
                                                <x-slot name="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 32 32"><path fill="#4f46e5" d="m25.7 9.3l-7-7c-.2-.2-.4-.3-.7-.3H8c-1.1 0-2 .9-2 2v24c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V10c0-.3-.1-.5-.3-.7M18 4.4l5.6 5.6H18zM24 28H8V4h8v6c0 1.1.9 2 2 2h6z"/><path fill="#4f46e5" d="M10 22h12v2H10zm0-6h12v2H10z"/></svg>
                                                </x-slot>
                                            </x-form-group-details-consultation>

                                            <hr class="my-3">

                                            {{-- Toma medicamentos  --}}
                                            <x-form-group-details-consultation label="Toma medicamentos" :text="$consulta->toma_medicamentos">
                                                <x-slot name="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><g fill="none" stroke="#e11d48" stroke-width="1.5"><path d="M17.845 6.155s-.433 2.245-2.94 4.751c-2.505 2.506-4.75 2.938-4.75 2.938m10.253 2.563a5.437 5.437 0 0 1-7.69 0l-5.126-5.126a5.437 5.437 0 1 1 7.69-7.689l5.125 5.126a5.437 5.437 0 0 1 0 7.69Z"/><path stroke-linecap="round" d="M14.5 6.5L13 5"/><path d="M6.73 10.135a6 6 0 1 0 7.143 7.098"/></g></svg>
                                                </x-slot>
                                            </x-form-group-details-consultation>

                                            <hr class="my-3">

                                            {{-- Toma medicamentos  --}}
                                            <x-form-group-details-consultation label="Diagnóstico" :text="$consulta->diagnostico">
                                                <x-slot name="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 56 56"><path fill="#ea580c" d="M16.586 52.246c1.172 0 1.969-.61 3.375-1.875l8.11-7.195h15.023c6.984 0 10.734-3.867 10.734-10.735V14.488c0-6.867-3.75-10.734-10.734-10.734H12.906c-6.96 0-10.734 3.844-10.734 10.734v17.953c0 6.891 3.773 10.735 10.734 10.735h1.125v6.093c0 1.805.938 2.977 2.555 2.977m.96-4.289V41.16c0-1.265-.468-1.758-1.757-1.758h-2.86c-4.757 0-6.984-2.414-6.984-6.984v-17.93c0-4.57 2.227-6.96 6.985-6.96h30.164c4.734 0 6.96 2.39 6.96 6.96v17.93c0 4.57-2.226 6.984-6.96 6.984H27.906c-1.289 0-1.968.188-2.86 1.102Zm-4.218-21.281h9.68c.75 0 1.336-.586 1.336-1.36c0-.726-.586-1.359-1.336-1.359h-9.68c-.75 0-1.336.633-1.336 1.36c0 .773.586 1.359 1.336 1.359m14.508 0H43c.75 0 1.36-.586 1.36-1.36c0-.726-.61-1.359-1.36-1.359H27.836c-.75 0-1.336.633-1.336 1.36c0 .773.586 1.359 1.336 1.359m-14.508 6.14h3.985a1.34 1.34 0 0 0 1.359-1.336c0-.773-.61-1.382-1.36-1.382h-3.984c-.75 0-1.336.61-1.336 1.383c0 .75.586 1.335 1.336 1.335m8.836 0h11.742a1.32 1.32 0 0 0 1.336-1.336c0-.773-.586-1.382-1.336-1.382H22.164c-.75 0-1.36.61-1.36 1.383c0 .75.61 1.335 1.36 1.335m16.57 0H43c.75 0 1.36-.586 1.36-1.336c0-.773-.61-1.382-1.36-1.382h-4.266c-.75 0-1.336.61-1.336 1.383c0 .75.586 1.335 1.336 1.335"/></svg>
                                                </x-slot>
                                            </x-form-group-details-consultation>

                                            <hr class="my-3">

                                        </div>
                                    </div>

                                </x-card-custom>
                            </div>

                        </div>







                    </div>

                    <div class="col-12 col-md-6 col-lg-5 col-xl-3">
                        <x-card-only-shadow>

                            <x-button-link-custom :route="route('nutrition.consultation.create', $person->id_persona)" class="btn-blue justify-content-center  mb-2"
                                text="Agregar consulta" tooltipText="Agregar una nueva consulta al paciente">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24">
                                        <path d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                                    </svg>
                                </x-slot>
                            </x-button-link-custom>

                            <x-button-link-custom route="{{route('nutrition.consultation.history',['id_persona' => $person->id_persona])}}" class="btn-sec justify-content-center"
                                text="Historial de consultas" tooltipText="Ver el historial de consultas del paciente">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M7 9V7h14v2zm0 4v-2h14v2zm0 4v-2h14v2zM4 9q-.425 0-.712-.288T3 8t.288-.712T4 7t.713.288T5 8t-.288.713T4 9m0 4q-.425 0-.712-.288T3 12t.288-.712T4 11t.713.288T5 12t-.288.713T4 13m0 4q-.425 0-.712-.288T3 16t.288-.712T4 15t.713.288T5 16t-.288.713T4 17" />
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
