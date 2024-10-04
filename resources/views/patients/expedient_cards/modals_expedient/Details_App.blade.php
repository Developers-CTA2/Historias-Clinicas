@extends('admin.layouts.main')

@section('title', 'Detalles')

@section('viteConfig')
    @vite(['resources/sass/form-style.scss', 'resources/sass/expedient.scss'])
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}">
@endsection

@section('content')

    <div class="container">
        <button id="btn-refresh-page"
            class="btnRestart  p-2 tooltip-container d-none animate__animated animate__fadeInUp"
            onclick="location.reload();">
           <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="#ffffff" d="M19.295 12a.704.704 0 0 1 .705.709v3.204a.704.704 0 0 1-.7.709a.704.704 0 0 1-.7-.709v-1.125C16.779 17.844 13.399 20 9.757 20c-4.41 0-8.106-2.721-9.709-6.915a.71.71 0 0 1 .4-.917c.36-.141.766.04.906.405c1.4 3.662 4.588 6.01 8.403 6.01c3.371 0 6.52-2.182 7.987-5.154l-1.471.01a.704.704 0 0 1-.705-.704a.705.705 0 0 1 .695-.714zm-9.05-12c4.408 0 8.105 2.721 9.708 6.915a.71.71 0 0 1-.4.917a.697.697 0 0 1-.906-.405c-1.4-3.662-4.588-6.01-8.403-6.01c-3.371 0-6.52 2.182-7.987 5.154l1.471-.01a.704.704 0 0 1 .705.704a.705.705 0 0 1-.695.714L.705 8A.704.704 0 0 1 0 7.291V4.087c0-.392.313-.709.7-.709s.7.317.7.709v1.125C3.221 2.156 6.601 0 10.243 0"/></svg> Recargar
            <span class="tooltip-text">Recargar la página</span>
        </button>

        <div class="mb-3 mx-0">
            <div class="card">
                <div class="card-header text-center bg-blue">
                    Edición de antecedentes personales patólogicos
                </div>
                <div class="card-body">

                    <div class="row col-12">
                        {{-- Contenedor de Enfermedades --}}
                        <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                            {{-- Alerta de edicion  --}}
                            <x-alert-manage containerClass="Diseases" textClass="Disease-Text">
                            </x-alert-manage>

                            <div class="form-group">
                                <div class="row">
                                    <h5 class="m-0 d-flex justify-content-start mt-1">
                                        <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                                height="25" viewBox="0 0 48 48">
                                                <g fill="rgb(19, 87, 78)">
                                                    <path fill-rule="evenodd"
                                                        d="M33.258 31c-1.72-3.562-5.22-6-9.258-6s-7.538 2.438-9.258 6c-.469.97.316 2 1.394 2h15.728c1.078 0 1.863-1.03 1.394-2M24 27c2.87 0 5.453 1.555 6.978 4H17.022c1.526-2.445 4.108-4 6.978-4"
                                                        clip-rule="evenodd" />
                                                    <path
                                                        d="M14.221 16.372a1 1 0 0 1 1.309-.22l4 2.5a1 1 0 0 1 0 1.696l-4 2.5a1 1 0 0 1-1.219-1.573c.373-.354.852-.72 1.244-1.02c.174-.133.331-.253.454-.352a4 4 0 0 0 .416-.38a4 4 0 0 0-.454-.409q-.16-.13-.367-.289c-.41-.319-.92-.716-1.32-1.127a1 1 0 0 1-.063-1.326m18.249-.22a1 1 0 0 1 1.246 1.546c-.4.41-.91.808-1.32 1.127q-.206.16-.367.29c-.21.17-.356.302-.454.409c.088.098.223.221.416.378c.123.1.28.22.454.353c.392.3.871.666 1.244 1.02a1 1 0 0 1-1.219 1.573l-4-2.5a1 1 0 0 1 0-1.696zM26 12.5a1.5 1.5 0 1 1-3 0a1.5 1.5 0 0 1 3 0m12 15a1.5 1.5 0 1 1-3 0a1.5 1.5 0 0 1 3 0" />
                                                    <path fill-rule="evenodd"
                                                        d="M42 24c0 9.941-8.059 18-18 18S6 33.941 6 24S14.059 6 24 6s18 8.059 18 18m-2 0c0 8.837-7.163 16-16 16q-.134 0-.266-.002a2 2 0 1 0-3.667-.485a16.04 16.04 0 0 1-10.994-9.74a2 2 0 1 0-.795-2.79A16 16 0 0 1 8 24a15.96 15.96 0 0 1 5.32-11.914a2 2 0 1 0 3.285-2.278A15.9 15.9 0 0 1 24 8c3.107 0 6.007.885 8.461 2.418a1.5 1.5 0 1 0 2.359 1.795A15.96 15.96 0 0 1 40 24"
                                                        clip-rule="evenodd" />
                                                </g>
                                            </svg>
                                        </span> Enfermedades
                                        <div class="ms-3 icon-refresh-Diseases d-none animate__animated animate__fadeInUp">
                                            <x-icon-warning />
                                        </div>

                                    </h5>
                                    @role('Administrador')
                                        @include('patients.expedient_cards.modals_expedient.collapse_APP_Diseases')
                                    @endrole

                                    <div class="cont-list p-2">
                                        <ul class="list-group">
                                            @if (!$enfermedades || $enfermedades->isEmpty())
                                                <li class="list-group-item text-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 20 20">
                                                        <path fill="#e11d48" fill-rule="evenodd"
                                                            d="M10 18a8 8 0 1 0 0-16a8 8 0 0 0 0 16M8.707 7.293a1 1 0 0 0-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 1 0 1.414 1.414L10 11.414l1.293 1.293a1 1 0 0 0 1.414-1.414L11.414 10l1.293-1.293a1 1 0 0 0-1.414-1.414L10 8.586z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Sin registros
                                                </li>
                                            @else
                                                @foreach ($enfermedades as $enfermedad)
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        {{ $enfermedad->enfermedad_especifica->nombre }}

                                                        <div class="d-flex gap-1 align-items-center">
                                                            <x-button-custom type="button" id="Delete-Disease"
                                                                data-id_reg="{{ $enfermedad->id }}"
                                                                class="btn-red justify-content-center justify-content-center"
                                                                padding="px-1 py-1" :onlyIcon="true"
                                                                tooltipText="Eliminar el registro">
                                                                <x-slot name="icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                        height="20" viewBox="0 0 24 24">
                                                                        <path
                                                                            d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5t.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5t-.288.713T19 6v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zm-7 11q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8t-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8t-.712.288T13 9v7q0 .425.288.713T14 17M7 6v13z" />
                                                                    </svg>
                                                                </x-slot>
                                                            </x-button-custom>

                                                            <x-button-custom type="button"
                                                                class="btn-blue-sec justify-content-center justify-content-center edit-APP"
                                                                padding="px-1 py-1" :onlyIcon="true"
                                                                tooltipText="Editar registro"
                                                                data-id_reg="{{ $enfermedad->id }}"
                                                                data-id_app="{{ $enfermedad->enfermedad_especifica->id_especifica_ahf }}"
                                                                data-name="{{ $enfermedad->enfermedad_especifica->nombre }}"
                                                                data-bs-toggle="collapse" data-bs-target="#Diseases_APP"
                                                                aria-expanded="false" aria-controls="Diseases_APP">
                                                                <x-slot name="icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                        height="20" viewBox="0 0 32 32">
                                                                        <path
                                                                            d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z" />
                                                                    </svg>
                                                                </x-slot>
                                                            </x-button-custom>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                    {{-- Botones de las opciones --}}
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="d-flex justify-content-center gap-3">
                                                <div class=" ">
                                                    <x-button-custom data-bs-toggle="collapse"
                                                        data-bs-target="#Diseases_APP" aria-expanded="false"
                                                        aria-controls="Diseases_APP" type="button"
                                                        class="btn-sec justify-content-center justify-content-lg-start add-Disease"
                                                        text="Agregar" tooltipText="Agregar una enfermedad">
                                                        <x-slot name="icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 24 24">
                                                                <path
                                                                    d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m5 11h-4v4h-2v-4H7v-2h4V7h2v4h4z" />
                                                            </svg>
                                                        </x-slot>
                                                    </x-button-custom>

                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            use Carbon\Carbon;
                        @endphp
                        {{-- Contenedor de alergias  --}}
                        <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                            {{-- Alerta de edicion  --}}
                            <x-alert-manage containerClass="Allergies" textClass="Allergy-Text">
                            </x-alert-manage>

                            <div class="form-group">
                                <div class="row">
                                    <h5 class="m-0 d-flex justify-content-start mt-1">
                                        <span class="pe-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 64 64">
                                                <path fill="#06285c"
                                                    d="M35 2C20.09 2 8 14.09 8 29c0 2.935.493 5.748 1.358 8.393c-2.176.214-4.603.365-7.358.433c0 0 1.719 12.417 10.967 12.417c.613 0 1.259-.055 1.939-.171a6.295 6.295 0 0 1 1.043-.094c5.948 0 3.279 10.354 3.279 10.354s4.877-6.306 7.977-6.306c.865 0 1.592.491 2.037 1.745C31.332 61.662 36.076 62 36.076 62c1.313-1.83 2.384-4.007 3.227-6.352C52.168 53.588 62 42.446 62 29C62 14.09 49.912 2 35 2m.184 57.732c-.883-.343-2.166-1.119-3.2-2.818c1.624-3.437 5.586-13.053 3.127-20.602c-.31-.947-4.533 6.007-13.382 17.762c-.158-1.484-.556-2.944-1.423-4.063a5.112 5.112 0 0 0-1.398-1.253c2.633-1.653 10.409-6.963 11.765-12.778c.734-3.151-11.016 2.462-23.535 9.237c-1.375-1.744-2.194-3.895-2.651-5.476c14.033-.625 19.399-3.446 25.062-6.423c1.391-.731 2.827-1.486 4.398-2.197c.53-.24 1.014-.362 1.438-.362c.964 0 1.821.72 2.55 2.139c2.903 5.657 2.1 18.967-2.751 26.834m4.828-6.264c3.201-11.102 1.564-24.709-4.628-24.709c-.697 0-1.452.172-2.265.54c-6.614 2.995-10.319 6.425-21.738 7.87A24.84 24.84 0 0 1 10 29C10 15.215 21.215 4 35 4s25 11.215 25 25c0 12.066-8.602 22.137-19.988 24.468" />
                                                <path fill="#06285c"
                                                    d="M20.514 12.738c-.643.065-.351 2.021.177 1.965a12.803 12.803 0 0 1 10.237 3.725c.369.385 1.848-.926 1.398-1.389a14.778 14.778 0 0 0-11.812-4.301m18.56 5.69a12.81 12.81 0 0 1 10.236-3.725c.527.057.82-1.899.177-1.965a14.783 14.783 0 0 0-11.813 4.301c-.447.463 1.031 1.774 1.4 1.389m5.578 4.355c2.324-1.287 4.773-1.681 7.084-2.026a.5.5 0 0 0 .143-.938c-4.889-2.915-12.84-.583-14.252 5.599c-.09.384.27.625.687.582c5.292-.544 9.503.261 13.597 1.747c.381.139.805-.413.467-.819c-1.505-1.803-4.274-3.573-7.726-4.145m-26.531-2.965a.5.5 0 0 0 .144.938c2.312.346 4.761.739 7.085 2.026c-3.451.572-6.222 2.342-7.725 4.144c-.341.406.085.958.464.819c4.097-1.486 8.307-2.291 13.6-1.747c.417.043.774-.198.687-.582c-1.413-6.181-9.364-8.513-14.255-5.598" />
                                            </svg>
                                        </span> Alergias

                                        {{-- Icono para mostrar una edicion  --}}
                                        <div class="ms-3 icon-refresh-Allergy d-none animate__animated animate__fadeInUp">
                                            <x-icon-warning />
                                        </div>
                                    </h5>

                                    @role('Administrador')
                                        @include('patients.expedient_cards.modals_expedient.collapse_APP_Allergies')
                                    @endrole

                                    <div class="cont-list p-2">
                                        <ul class="list-group">
                                            @if (!$alergias || $alergias->isEmpty())
                                                <li class="list-group-item text-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 20 20">
                                                        <path fill="#e11d48" fill-rule="evenodd"
                                                            d="M10 18a8 8 0 1 0 0-16a8 8 0 0 0 0 16M8.707 7.293a1 1 0 0 0-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 1 0 1.414 1.414L10 11.414l1.293 1.293a1 1 0 0 0 1.414-1.414L11.414 10l1.293-1.293a1 1 0 0 0-1.414-1.414L10 8.586z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Sin registros
                                                </li>
                                            @else
                                                @foreach ($alergias as $alergia)
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <div class="">
                                                            {{ $alergia->alergias->nombre }}
                                                        </div>
                                                        <div class="text-muted px-1">
                                                            {{ $alergia->especificar }}
                                                        </div>
                                                        <div class="d-flex gap-1">
                                                            <x-button-custom type="button"
                                                                class="btn-blue-sec justify-content-center justify-content-lg-start Edit-Allergy"
                                                                padding="px-1 py-1" :onlyIcon="true"
                                                                data-id_reg="{{ $alergia->id }}"
                                                                data-name="{{ $alergia->alergias->nombre }}"
                                                                data-description="{{ $alergia->especificar }}"
                                                                data-id_alergia="{{ $alergia->id_alergia }}"
                                                                data-bs-toggle="collapse" data-bs-target="#Allergies_APP"
                                                                tooltipText="Editar una alergia" aria-expanded="false"
                                                                aria-controls="Allergies_APP">
                                                                <x-slot name="icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                        height="20" viewBox="0 0 32 32">
                                                                        <path
                                                                            d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z" />
                                                                    </svg>
                                                                </x-slot>
                                                            </x-button-custom>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                    {{-- Botones de las opciones --}}
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="d-flex justify-content-center gap-3">
                                                <div class=" ">

                                                    <x-button-custom type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#Allergies_APP" aria-expanded="false"
                                                        aria-controls="Allergies_APP"
                                                        class="btn-sec justify-content-center justify-content-lg-start add-Allergy"
                                                        text="Agregar" tooltipText="Agregar una alergia">
                                                        <x-slot name="icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 24 24">
                                                                <path
                                                                    d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m5 11h-4v4h-2v-4H7v-2h4V7h2v4h4z" />
                                                            </svg>
                                                        </x-slot>
                                                    </x-button-custom>
                                                </div>

                                                {{-- <div
                                                    class="icon-refresh-Allergy d-none animate__animated animate__fadeInUp">
                                                    <x-button-custom type="button"
                                                        class="btn-sec justify-content-center justify-content-lg-start"
                                                        text="Recargar" tooltipText="Recargar página."
                                                        onclick="location.reload();">
                                                        <x-slot name="icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 20 20">
                                                                <path
                                                                    d="M10 3v2a5 5 0 0 0-3.54 8.54l-1.41 1.41A7 7 0 0 1 10 3m4.95 2.05A7 7 0 0 1 10 17v-2a5 5 0 0 0 3.54-8.54zM10 20l-4-4l4-4zm0-12V0l4 4z" />
                                                            </svg>
                                                        </x-slot>
                                                    </x-button-custom>
                                                </div> --}}
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- Segundo contenedor  --}}
                    <div class="row col-12 mt-3">


                        <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                            {{-- Alerta de edicion  --}}
                            <x-alert-manage containerClass="Hospital" textClass="Hospital-Text">
                            </x-alert-manage>
                            <div class="form-group">
                                <div class="row">
                                    <h5 class="m-0 d-flex justify-content-start mt-1">
                                        <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                                height="25" viewBox="0 0 24 24">
                                                <path fill="none" stroke="#e11d48" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1.5"
                                                    d="M21.25 9.944v4.112a1.028 1.028 0 0 1-1.028 1.027h-5.139v5.14a1.028 1.028 0 0 1-1.027 1.027H9.944a1.028 1.028 0 0 1-1.027-1.028v-5.139h-5.14a1.028 1.028 0 0 1-1.027-1.027V9.944a1.028 1.028 0 0 1 1.028-1.027h5.139v-5.14A1.028 1.028 0 0 1 9.944 2.75h4.112a1.028 1.028 0 0 1 1.027 1.028v5.139h5.14a1.028 1.028 0 0 1 1.027 1.027" />
                                            </svg>
                                        </span> Hospitalizaciones

                                        {{-- Icono para mostrar una edicion  --}}
                                        <div class="ms-3 icon-refresh-Hospital d-none animate__animated animate__fadeInUp">
                                            <x-icon-warning />
                                        </div>
                                    </h5>

                                    <div class="cont-list p-2">
                                        <ul class="list-group">
                                            @if (!$hospitalizaciones || $hospitalizaciones->isEmpty())
                                                <li class="list-group-item text-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 20 20">
                                                        <path fill="#e11d48" fill-rule="evenodd"
                                                            d="M10 18a8 8 0 1 0 0-16a8 8 0 0 0 0 16M8.707 7.293a1 1 0 0 0-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 1 0 1.414 1.414L10 11.414l1.293 1.293a1 1 0 0 0 1.414-1.414L11.414 10l1.293-1.293a1 1 0 0 0-1.414-1.414L10 8.586z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Sin registros
                                                </li>
                                            @else
                                                @foreach ($hospitalizaciones as $hospital)
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <div>
                                                            {{ $hospital->detalles }}
                                                        </div>
                                                        <div class="">
                                                            {{ Carbon::parse($hospital->fecha)->locale('es')->isoFormat('LL') }}
                                                        </div>

                                                        <div class="d-flex">
                                                            <x-button-custom type="button"
                                                                class="btn-blue-sec justify-content-center edit-hospital"
                                                                padding="px-1 py-1" :onlyIcon="true"
                                                                data-id_reg="{{ $hospital->id }}"
                                                                data-date="{{ $hospital->fecha }}"
                                                                data-description="{{ $hospital->detalles }}"
                                                                data-bs-toggle="modal" data-bs-target="#add-APP"
                                                                tooltipText="Editar registro">
                                                                <x-slot name="icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                        height="20" viewBox="0 0 32 32">
                                                                        <path
                                                                            d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z" />
                                                                    </svg>
                                                                </x-slot>
                                                            </x-button-custom>

                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>

                                    {{-- Botones de las opciones --}}
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="d-flex justify-content-center gap-3">
                                                <div class=" ">
                                                    <x-button-custom type="button"
                                                        class="btn-sec justify-content-center justify-content-lg-start add-Hospital"
                                                        data-bs-toggle="modal" data-bs-target="#add-APP" text="Agregar"
                                                        tooltipText="Agregar una hospitalización">
                                                        <x-slot name="icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 24 24">
                                                                <path
                                                                    d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m5 11h-4v4h-2v-4H7v-2h4V7h2v4h4z" />
                                                            </svg>
                                                        </x-slot>
                                                    </x-button-custom>
                                                </div>
 
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div> {{-- Contenedor del lado izquierdo  --}}

                        <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                            {{-- Alerta de edicion  --}}
                            <x-alert-manage containerClass="Trans" textClass="Trans-Text">
                            </x-alert-manage>

                            <div class="form-group">
                                <div class="row">
                                    <h5 class="m-0 d-flex justify-content-start mt-1">
                                        <span class="pe-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 14 14">
                                                <g fill="none" stroke="#0284c7" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path
                                                        d="M1.5 7.838V3.5a3 3 0 0 1 3-3h5a3 3 0 0 1 3 3v4.338a3 3 0 0 1-2.051 2.846L9.5 11v.5a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1V11l-.949-.316A3 3 0 0 1 1.5 7.838" />
                                                    <path
                                                        d="M1.5 8.039c.667-.444 2.7-1.066 5.5 0c2.8 1.065 4.833.222 5.5-.333M8.118 4.661c0-.63-1.118-2.19-1.118-2.19S5.88 4.032 5.88 4.662c0 .31.118.606.328.825c.21.218.494.341.79.341a1.1 1.1 0 0 0 .792-.341a1.19 1.19 0 0 0 .327-.825v0ZM7 12.5v1" />
                                                </g>
                                            </svg>
                                        </span> Transfusiones
                                        {{-- Icono para mostrar edicion  --}}
                                        <div class="ms-3 icon-refresh-Trans d-none animate__animated animate__fadeInUp">
                                            <x-icon-warning />
                                        </div>
                                    </h5>

                                    <div class="cont-list p-2">
                                        <ul class="list-group">
                                            @if (!$transfusiones || $transfusiones->isEmpty())
                                                <li class="list-group-item text-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 20 20">
                                                        <path fill="#e11d48" fill-rule="evenodd"
                                                            d="M10 18a8 8 0 1 0 0-16a8 8 0 0 0 0 16M8.707 7.293a1 1 0 0 0-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 1 0 1.414 1.414L10 11.414l1.293 1.293a1 1 0 0 0 1.414-1.414L11.414 10l1.293-1.293a1 1 0 0 0-1.414-1.414L10 8.586z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Sin registros
                                                </li>
                                            @else
                                                @foreach ($transfusiones as $transfucion)
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <div class="">
                                                            {{ $transfucion->detalles }}
                                                        </div>
                                                        <div class="">
                                                            {{ Carbon::parse($transfucion->fecha)->locale('es')->isoFormat('LL') }}
                                                        </div>
                                                        <div class="d-flex">

                                                            <x-button-custom type="button"
                                                                class="btn-blue-sec justify-content-center edit-trans"
                                                                padding="px-1 py-1" :onlyIcon="true"
                                                                data-id_reg="{{ $transfucion->id }}"
                                                                data-date="{{ $transfucion->fecha }}"
                                                                data-description="{{ $transfucion->detalles }}"
                                                                data-bs-toggle="modal" data-bs-target="#add-APP"
                                                                tooltipText="Editar registro">
                                                                <x-slot name="icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                        height="20" viewBox="0 0 32 32">
                                                                        <path
                                                                            d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z" />
                                                                    </svg>
                                                                </x-slot>
                                                            </x-button-custom>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>

                                    {{-- Botones de las opciones --}}
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="d-flex justify-content-center gap-3">
                                                <div class=" ">
                                                    <x-button-custom type="button"
                                                        class="btn-sec justify-content-center justify-content-lg-start add-Trans"
                                                        data-bs-toggle="modal" data-bs-target="#add-APP" text="Agregar"
                                                        tooltipText="Agregar una transfusión">
                                                        <x-slot name="icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 24 24">
                                                                <path
                                                                    d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m5 11h-4v4h-2v-4H7v-2h4V7h2v4h4z" />
                                                            </svg>
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
                    {{-- Tercer contenedor  --}}
                    <div class="row col-12 mt-2">
                        <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                            <x-alert-manage containerClass="Surgery" textClass="Surgery-Text">
                            </x-alert-manage>
                            <div class="form-group">
                                <div class="row">
                                    <h5 class="m-0 d-flex justify-content-start mt-1">
                                        <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                                height="25" viewBox="0 0 24 24">
                                                <circle cx="7.5" cy="11.5" r="2.5" fill="#06285c" />
                                                <path fill="#06285c"
                                                    d="M17.205 7H12a1 1 0 0 0-1 1v7H4V6H2v14h2v-3h16v3h2v-8.205A4.8 4.8 0 0 0 17.205 7M13 15V9h4.205A2.798 2.798 0 0 1 20 11.795V15z" />
                                            </svg>
                                        </span> Cirugías
                                        <div class="ms-3 icon-refresh-Surgery d-none animate__animated animate__fadeInUp">
                                            <x-icon-warning />
                                        </div>
                                    </h5>

                                    <div class="cont-list p-2">
                                        <ul class="list-group">
                                            @if (!$quirurgicos || $quirurgicos->isEmpty())
                                                <li class="list-group-item text-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 20 20">
                                                        <path fill="#e11d48" fill-rule="evenodd"
                                                            d="M10 18a8 8 0 1 0 0-16a8 8 0 0 0 0 16M8.707 7.293a1 1 0 0 0-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 1 0 1.414 1.414L10 11.414l1.293 1.293a1 1 0 0 0 1.414-1.414L11.414 10l1.293-1.293a1 1 0 0 0-1.414-1.414L10 8.586z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Sin registros
                                                </li>
                                            @else
                                                @foreach ($quirurgicos as $quirurgico)
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <div>
                                                            {{ $quirurgico->detalles }}
                                                        </div>
                                                        <div>
                                                            {{ Carbon::parse($quirurgico->fecha)->locale('es')->isoFormat('LL') }}
                                                        </div>
                                                        <div class="d-flex gap-1">
                                                            <x-button-custom type="button"
                                                                class="btn-blue-sec justify-content-center edit-Surgery"
                                                                padding="px-1 py-1" :onlyIcon="true"
                                                                data-id_reg="{{ $quirurgico->id }}"
                                                                data-date="{{ $quirurgico->fecha }}"
                                                                data-description="{{ $quirurgico->detalles }}"
                                                                data-bs-toggle="modal" data-bs-target="#add-APP"
                                                                tooltipText="Editar registro">
                                                                <x-slot name="icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                        height="20" viewBox="0 0 32 32">
                                                                        <path
                                                                            d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z" />
                                                                    </svg>
                                                                </x-slot>
                                                            </x-button-custom>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="d-flex justify-content-center gap-3">
                                                <div class=" ">
                                                    <x-button-custom type="button"
                                                        class="btn-sec justify-content-center justify-content-lg-start add-Surgery"
                                                        data-bs-toggle="modal" data-bs-target="#add-APP" text="Agregar"
                                                        tooltipText="Agregar una cirugía">
                                                        <x-slot name="icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 24 24">
                                                                <path
                                                                    d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m5 11h-4v4h-2v-4H7v-2h4V7h2v4h4z" />
                                                            </svg>
                                                        </x-slot>
                                                    </x-button-custom>
                                                </div>                                            
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                            <x-alert-manage containerClass="Trauma" textClass="Trauma-Text">
                            </x-alert-manage>

                            <div class="form-group">
                                <div class="row">
                                    <h5 class="m-0 d-flex justify-content-start mt-1">
                                        <span class="pe-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 16 16">
                                                <path fill="#059669"
                                                    d="M6.5 3h3a.5.5 0 0 1 .5.5V5H6V3.5a.5.5 0 0 1 .5-.5M5 3.5V5H4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3.5A1.5 1.5 0 0 0 9.5 2h-3A1.5 1.5 0 0 0 5 3.5M12 6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1zM8.5 8a.5.5 0 0 0-1 0v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1z" />
                                            </svg>
                                        </span> Traumatismos
                                        <div class="ms-3 icon-refresh-Trauma d-none animate__animated animate__fadeInUp">
                                            <x-icon-warning />
                                        </div>
                                    </h5>

                                    <div class="cont-list p-2">
                                        <ul class="list-group">
                                            @if (!$traumatismos || $traumatismos->isEmpty())
                                                <li class="list-group-item text-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 20 20">
                                                        <path fill="#e11d48" fill-rule="evenodd"
                                                            d="M10 18a8 8 0 1 0 0-16a8 8 0 0 0 0 16M8.707 7.293a1 1 0 0 0-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 1 0 1.414 1.414L10 11.414l1.293 1.293a1 1 0 0 0 1.414-1.414L11.414 10l1.293-1.293a1 1 0 0 0-1.414-1.414L10 8.586z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Sin registros
                                                </li>
                                            @else
                                                @foreach ($traumatismos as $traumaticos)
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <div>
                                                            {{ $traumaticos->detalles }}
                                                        </div>
                                                        <div>
                                                            {{ Carbon::parse($traumaticos->fecha)->locale('es')->isoFormat('LL') }}
                                                        </div>
                                                        <div class="d-flex gap-1">
                                                            <x-button-custom type="button"
                                                                class="btn-blue-sec justify-content-center edit-Trauma"
                                                                padding="px-1 py-1" :onlyIcon="true"
                                                                data-id_reg="{{ $traumaticos->id }}"
                                                                data-date="{{ $traumaticos->fecha }}"
                                                                data-description="{{ $traumaticos->detalles }}"
                                                                data-bs-toggle="modal" data-bs-target="#add-APP"
                                                                tooltipText="Editar registro">
                                                                <x-slot name="icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                        height="20" viewBox="0 0 32 32">
                                                                        <path
                                                                            d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z" />
                                                                    </svg>
                                                                </x-slot>
                                                            </x-button-custom>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="d-flex justify-content-center gap-3">
                                                <div class=" ">
                                                    <x-button-custom type="button"
                                                        class="btn-sec justify-content-center justify-content-lg-start add-Trauma"
                                                        data-bs-toggle="modal" data-bs-target="#add-APP" text="Agregar"
                                                        tooltipText="Agregar una traumatismo">
                                                        <x-slot name="icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 24 24">
                                                                <path
                                                                    d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m5 11h-4v4h-2v-4H7v-2h4V7h2v4h4z" />
                                                            </svg>
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
                </div>

            </div>

        </div>
        {{-- Modal para agregar o editar  --}}
        @include('patients.expedient_cards.modals_expedient.modal_Edit_APP')

    </div>

    @role('Administrador')
        @section('scripts')
            <script src="{{ asset('js/select2.min.js') }}"></script>
            @vite(['resources/js/patients/expedient/Diseases_Allergies.js', 'resources/js/patients/expedient/APP_Management.js'])
        @endsection
    @endrole

@endsection
