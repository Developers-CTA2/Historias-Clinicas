<x-card-custom title="Antecedentes personales patólogicos">
    <div class="row">
        @role('Administrador')
            <div class="d-flex justify-content-end">
                <div class="toggle tooltip-container">
                    <input type="checkbox" id="Edit-APP">
                    <label for="Edit-APP" class="label-check"></label>
                    <span class="tooltip-text">Habilitar edición.</span>
                </div>
            </div>
            {{-- @include('patients.expedient_cards.modals_expedient.modal_add_toxic') --}}
        @endrole
        {{-- Contenedor de las enfermedades --}}
        <div class="col-lg-6 col-12">

            <div class="form-group">
                <div class="row">
                    <h5 class="m-0 mt-1 aling-items-center">
                        <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 48 48">
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
                    </h5>

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
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>

                </div>
            </div>
        </div> {{-- Contenedor del lado izquierdo  --}}

        <div class="col-lg-6 col-12 mt-3 mt-md-0">

            <div class="form-group">
                <div class="row">
                    <h5 class="m-0 mt-1 aling-items-center">
                        <span class="pe-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 64 64">
                                <path fill="#06285c"
                                    d="M35 2C20.09 2 8 14.09 8 29c0 2.935.493 5.748 1.358 8.393c-2.176.214-4.603.365-7.358.433c0 0 1.719 12.417 10.967 12.417c.613 0 1.259-.055 1.939-.171a6.295 6.295 0 0 1 1.043-.094c5.948 0 3.279 10.354 3.279 10.354s4.877-6.306 7.977-6.306c.865 0 1.592.491 2.037 1.745C31.332 61.662 36.076 62 36.076 62c1.313-1.83 2.384-4.007 3.227-6.352C52.168 53.588 62 42.446 62 29C62 14.09 49.912 2 35 2m.184 57.732c-.883-.343-2.166-1.119-3.2-2.818c1.624-3.437 5.586-13.053 3.127-20.602c-.31-.947-4.533 6.007-13.382 17.762c-.158-1.484-.556-2.944-1.423-4.063a5.112 5.112 0 0 0-1.398-1.253c2.633-1.653 10.409-6.963 11.765-12.778c.734-3.151-11.016 2.462-23.535 9.237c-1.375-1.744-2.194-3.895-2.651-5.476c14.033-.625 19.399-3.446 25.062-6.423c1.391-.731 2.827-1.486 4.398-2.197c.53-.24 1.014-.362 1.438-.362c.964 0 1.821.72 2.55 2.139c2.903 5.657 2.1 18.967-2.751 26.834m4.828-6.264c3.201-11.102 1.564-24.709-4.628-24.709c-.697 0-1.452.172-2.265.54c-6.614 2.995-10.319 6.425-21.738 7.87A24.84 24.84 0 0 1 10 29C10 15.215 21.215 4 35 4s25 11.215 25 25c0 12.066-8.602 22.137-19.988 24.468" />
                                <path fill="#06285c"
                                    d="M20.514 12.738c-.643.065-.351 2.021.177 1.965a12.803 12.803 0 0 1 10.237 3.725c.369.385 1.848-.926 1.398-1.389a14.778 14.778 0 0 0-11.812-4.301m18.56 5.69a12.81 12.81 0 0 1 10.236-3.725c.527.057.82-1.899.177-1.965a14.783 14.783 0 0 0-11.813 4.301c-.447.463 1.031 1.774 1.4 1.389m5.578 4.355c2.324-1.287 4.773-1.681 7.084-2.026a.5.5 0 0 0 .143-.938c-4.889-2.915-12.84-.583-14.252 5.599c-.09.384.27.625.687.582c5.292-.544 9.503.261 13.597 1.747c.381.139.805-.413.467-.819c-1.505-1.803-4.274-3.573-7.726-4.145m-26.531-2.965a.5.5 0 0 0 .144.938c2.312.346 4.761.739 7.085 2.026c-3.451.572-6.222 2.342-7.725 4.144c-.341.406.085.958.464.819c4.097-1.486 8.307-2.291 13.6-1.747c.417.043.774-.198.687-.582c-1.413-6.181-9.364-8.513-14.255-5.598" />
                            </svg>
                        </span> Alergias
                    </h5>

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
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>

                </div>
            </div>
        </div>

    </div>
    {{-- Segundo contenedor  --}}
    <div class="col-12 mt-3 mt-md-2">
        <div class="row">


            {{-- Contenedor de las enfermedades --}}
            <div class="col-lg-6 col-12">

                <div class="form-group">
                    <div class="row">
                        <h5 class="m-0 mt-1 aling-items-center">
                            <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                    viewBox="0 0 24 24">
                                    <path fill="none" stroke="#e11d48" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M21.25 9.944v4.112a1.028 1.028 0 0 1-1.028 1.027h-5.139v5.14a1.028 1.028 0 0 1-1.027 1.027H9.944a1.028 1.028 0 0 1-1.027-1.028v-5.139h-5.14a1.028 1.028 0 0 1-1.027-1.027V9.944a1.028 1.028 0 0 1 1.028-1.027h5.139v-5.14A1.028 1.028 0 0 1 9.944 2.75h4.112a1.028 1.028 0 0 1 1.027 1.028v5.139h5.14a1.028 1.028 0 0 1 1.027 1.027" />
                                </svg>
                            </span> Hospitalizaciones
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
                                            <div class="text-muted ">
                                                {{ Carbon\Carbon::parse($hospital->fecha)->locale('es')->isoFormat('LL') }}
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                    </div>
                </div>

            </div> {{-- Contenedor del lado izquierdo  --}}

            <div class="col-lg-6 col-12 mt-3 mt-md-0">

                <div class="form-group">
                    <div class="row">
                        <h5 class="m-0 mt-1 aling-items-center">
                            <span class="pe-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                    viewBox="0 0 14 14">
                                    <g fill="none" stroke="#0284c7" stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M1.5 7.838V3.5a3 3 0 0 1 3-3h5a3 3 0 0 1 3 3v4.338a3 3 0 0 1-2.051 2.846L9.5 11v.5a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1V11l-.949-.316A3 3 0 0 1 1.5 7.838" />
                                        <path
                                            d="M1.5 8.039c.667-.444 2.7-1.066 5.5 0c2.8 1.065 4.833.222 5.5-.333M8.118 4.661c0-.63-1.118-2.19-1.118-2.19S5.88 4.032 5.88 4.662c0 .31.118.606.328.825c.21.218.494.341.79.341a1.1 1.1 0 0 0 .792-.341a1.19 1.19 0 0 0 .327-.825v0ZM7 12.5v1" />
                                    </g>
                                </svg>
                            </span> Transfusiones
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
                                            <div class="text-muted ">
                                                {{ Carbon\Carbon::parse($transfucion->fecha)->locale('es')->isoFormat('LL') }}

                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- Tercer contenedor  --}}
    <div class="col-12 mt-3 mt-md-2">
        <div class="row">


            <div class="col-lg-6  col-12">
                <div class="form-group">
                    <div class="row">
                        <h5 class="m-0 mt-1 aling-items-center">
                            <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                    height="25" viewBox="0 0 24 24">
                                    <circle cx="7.5" cy="11.5" r="2.5" fill="#06285c" />
                                    <path fill="#06285c"
                                        d="M17.205 7H12a1 1 0 0 0-1 1v7H4V6H2v14h2v-3h16v3h2v-8.205A4.8 4.8 0 0 0 17.205 7M13 15V9h4.205A2.798 2.798 0 0 1 20 11.795V15z" />
                                </svg>
                            </span> Cirugías
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
                                            <div class="text-muted ">
                                                {{ Carbon\Carbon::parse($quirurgico->fecha)->locale('es')->isoFormat('LL') }}

                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-6 mt-3 mt-md-0 col-12" id="Cont_APP">

                <div class="form-group">
                    <div class="row">
                        <h5 class="m-0 mt-1 aling-items-center">
                            <span class="pe-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                    viewBox="0 0 16 16">
                                    <path fill="#059669"
                                        d="M6.5 3h3a.5.5 0 0 1 .5.5V5H6V3.5a.5.5 0 0 1 .5-.5M5 3.5V5H4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3.5A1.5 1.5 0 0 0 9.5 2h-3A1.5 1.5 0 0 0 5 3.5M12 6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1zM8.5 8a.5.5 0 0 0-1 0v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1z" />
                                </svg>
                            </span> Traumatismos
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
                                            <div class="text-muted ">
                                                {{ Carbon\Carbon::parse($traumaticos->fecha)->locale('es')->isoFormat('LL') }}
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</x-card-custom>
