<div class="card">
    <div class="card-header text-center bg-blue">
        Antecedentes personales NO patólogicos
    </div>
    <div class="card-body">
        <div class="row col-12">
            {{-- Contenedor de las enfermedades --}}
            <div class="col-lg-6 col-md-6 col-sm-12">

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
                                            <button class="btn-blue-sec fst-normal tooltip-container">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 32 32">
                                                    <path
                                                        d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z" />
                                                </svg>
                                                <span class="tooltip-text">Editar registro.</span>
                                            </button>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                    </div>
                </div>
            </div> {{-- Contenedor deñ lado izquierdo  --}}

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <h5 class="m-0 mt-1 aling-items-center">
                        <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 48 48">
                                <g fill="none" stroke="#BE3144" stroke-linejoin="round" stroke-width="4">
                                    <path
                                        d="M33.958 44s.024-3.47 0-4.24a18.993 18.993 0 0 0 4.477-3.325A18.94 18.94 0 0 0 44 23c0-10.493-8.507-19-19-19S6 12.507 6 23a18.94 18.94 0 0 0 5.565 13.435a19.088 19.088 0 0 0 2.879 2.365c.515.345 1.01.666 1.56.96V44z"
                                        clip-rule="evenodd" />
                                    <path
                                        d="M18 27a4 4 0 0 0 4-4l-4-4a4 4 0 0 0 0 8Zm14 0a4 4 0 0 1-4-4l4-4a4 4 0 0 1 0 8Z" />
                                    <path stroke-linecap="round" d="m22 34l2.938-3L28 33.897" />
                                </g>
                            </svg>
                        </span> Toxicomanías
                    </h5>
                    <div class="cont-list p-2">
                        <ul class="list-group">
                            @if (!$toxicomanias || $toxicomanias->isEmpty())
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
                                @foreach ($toxicomanias as $toxicomania)
                                    <li class="list-group-item d-flex justify-content-between">
                                        <div class="align-self-center">
                                            {{ $toxicomania->toxicomanias->nombre }}

                                        </div>
                                        {{-- caso de ser tabaquismo --}}
                                        @if ($toxicomania->toxicomanias->id == 2)
                                            @php
                                                // Asumiendo que tienes el string que necesitas separar
                                                $string = $toxicomania->observacion;
                                                $cadena = explode(',', $string);

                                            @endphp

                                            <span>
                                                <p class="m-0 fst-italic text-muted">Desde</p>
                                                <p class="text-center">{{ trim($cadena[1]) }}</p>

                                            </span>
                                            <span>

                                                <p class="m-0 fst-italic text-muted">Cantidad</p>

                                                <p class="text-center"> {{ trim($cadena[3]) }}</p>
                                            </span>
                                            <span>
                                                <p class="m-0 fst-italic text-muted">Riesgo</p>

                                                <p class="text-center">{{ trim($cadena[5]) }}</p>
                                            </span>
                                        @endif
                                        <div class="align-self-center">
                                            <button class="btn-blue-sec fst-normal tooltip-container">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 32 32">
                                                    <path
                                                        d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z" />
                                                </svg>
                                                <span class="tooltip-text">Editar registro.</span>
                                            </button>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>

                </div> <!-- FIN contenedor 1  -->
                {{-- Botones  --}}
                <div class="col-12 p-0 mt-2">
                    <div class="row">
                        <div class="d-flex justify-content-end">
                            <div class="mx-2">
                                <a href="" class="btn-red fst-normal tooltip-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 1024 1024">
                                        <path d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64" />
                                        <path
                                            d="m237.248 512l265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312z" />
                                    </svg>
                                    Atras
                                    <span class="tooltip-text">Volver a la ventana anterior.</span>
                                </a>
                            </div>
                            <div class="">
                                <button href="" class="btn-sec fst-normal tooltip-container" type="button"
                                    data-bs-toggle="modal" data-bs-target="#EditData">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
                                    </svg>
                                    Editar
                                    <span class="tooltip-text">Editar datos.</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- Modal para editar los datos del usuario --}}
</div>
