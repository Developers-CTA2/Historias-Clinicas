<div class="card">
    <div class="card-header text-center bg-blue">
        Antecedentes personales NO patólogicos
    </div>
    <div class="card-body">
        <div class="row col-12">
            @role('Administrador')
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="p-0 m-0 APNP-data d-none animate__animated animate__fadeInUp">
                            <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between p-0 m-0"
                                role="alert">
                                <p class="p-2 mb-0 me-3 alert-APNP">
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="toggle tooltip-container">
                        <input type="checkbox" id="Edit-apnp">
                        <label for="Edit-apnp" class="label-check"></label>
                        <span class="tooltip-text">Habilitar edición.</span>
                    </div>
                </div>
                @include('patients.expedient_cards.modals_expedient.modal_add_toxic')
            @endrole
            {{-- Contenedor de las enfermedades --}}
            @php
                use Carbon\Carbon;
            @endphp
            <div class="col-lg-8 col-md-8 col-sm-12">
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
                                {{-- Existen toxicomanias  --}}
                                @foreach ($toxicomanias as $toxicomania)
                                    <li class="list-group-item d-flex justify-content-between">
                                        <div class="align-self-center fw-bold">
                                            {{ $toxicomania->toxicomanias->nombre }}

                                        </div>
                                        {{-- caso de ser tabaquismo --}}
                                        @if ($toxicomania->toxicomanias->nombre == 'Tabaquismo')
                                            @php
                                                // Asumiendo que tienes el string que necesitas separar
                                                $string = $toxicomania->observacion;
                                                $cadena = explode(',', $string);
                                                $fechaInicio = Carbon::parse($toxicomania->desde_cuando);
                                                $años = $fechaInicio->diffInYears(Carbon::now());
                                            @endphp

                                            <div>
                                                <p class="m-0 fst-italic text-muted">Desde</p>

                                                <p> {{ $años }} años

                                                </p>

                                            </div>
                                            <div>

                                                <p class="m-0 fst-italic text-muted">Cantidad</p>

                                                <p class="text-center"> {{ trim($cadena[0]) }}</p>
                                            </div>
                                            <div>
                                                <p class="m-0 fst-italic text-muted">Riesgo</p>
                                                @if (trim($cadena[2]) == 'Alto')
                                                    <p class="text-center text-danger">{{ trim($cadena[2]) }}</p>
                                                @elseif(trim($cadena[2]) == 'Intenso')
                                                    <p class="text-center text-warning ">{{ trim($cadena[2]) }}</p>
                                                @elseif(trim($cadena[2]) == 'Moderado')
                                                    <p class="text-center text-secondary">{{ trim($cadena[2]) }}</p>
                                                @else
                                                    <p class="text-center text-dark">{{ trim($cadena[2]) }}</p>
                                                @endif
                                            </div>
                                        @else
                                            {{-- Caso de las demas toxicomanias  --}}
                                            <span>
                                                <p> {{ $toxicomania->observacion }}</p>
                                            </span>
                                            <span>
                                                @php
                                                    $fechaInicio = Carbon::parse($toxicomania->desde_cuando);
                                                    $años = $fechaInicio->diffInYears(Carbon::now());
                                                @endphp
                                                <p> {{ $años }} años

                                                </p>
                                            </span>
                                        @endif
                                        {{-- boton de de editar 
                                        <div class="align-self-center">
                                            <button
                                                class="btn-blue-sec fst-normal tooltip-container APNP-data d-none animate__animated animate__fadeInUp">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 32 32">
                                                    <path
                                                        d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z" />
                                                </svg>
                                                <span class="tooltip-text">Editar registro.</span>
                                            </button>
                                        </div>
                                        --}}  
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>

                    <div class="col-12 mt-3 ">
                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="">
                                    <button
                                        class="btn-blue-sec fst-normal p-1 tooltip-container APNP-data d-none animate__animated animate__fadeInUp"
                                        type="button" data-bs-toggle="modal" data-bs-target="#add-toxic">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m5 11h-4v4h-2v-4H7v-2h4V7h2v4h4z" />
                                        </svg>
                                        Agregar
                                        <span class="tooltip-text">Agregar nueva toxicomanía.</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div> <!-- FIN contenedor 1  -->
            </div>

{{-- Contenedor del Hemotipo y la escoliaridad  --}}
            <div class="col-lg-4 col-md-4 col-sm-12 m-0">
                <div class="form-group">

                    <h5 class="m-0 d-flex justify-content-start">
                        <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 24 24">
                                <path fill="#BE3144"
                                    d="M12 22q-3.425 0-5.712-2.35T4 13.8q0-1.55.7-3.1t1.75-2.975T8.725 5.05T11 2.875q.2-.2.463-.287T12 2.5t.538.088t.462.287q1.05.925 2.275 2.175t2.275 2.675T19.3 10.7t.7 3.1q0 3.5-2.287 5.85T12 22m0-2q2.6 0 4.3-1.763T18 13.8q0-1.825-1.513-4.125T12 4.65Q9.025 7.375 7.513 9.675T6 13.8q0 2.675 1.7 4.438T12 20m-2-2h4q.425 0 .713-.288T15 17t-.288-.712T14 16h-4q-.425 0-.712.288T9 17t.288.713T10 18m1-5v1q0 .425.288.713T12 15t.713-.288T13 14v-1h1q.425 0 .713-.288T15 12t-.288-.712T14 11h-1v-1q0-.425-.288-.712T12 9t-.712.288T11 10v1h-1q-.425 0-.712.288T9 12t.288.713T10 13z" />
                            </svg>
                        </span>
                        Hemotipo
                        <div class="ms-3 apnp-refresh-homo d-none animate__animated animate__fadeInUp" data-icon="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 64 64">
                                <path fill="#ffdd15"
                                    d="M63.37 53.52C53.982 36.37 44.59 19.22 35.2 2.07a3.687 3.687 0 0 0-6.522 0C19.289 19.22 9.892 36.37.508 53.52c-1.453 2.649.399 6.083 3.258 6.083h56.35c1.584 0 2.648-.853 3.203-2.01c.698-1.102.885-2.565.055-4.075" />
                                <path fill="#1f2e35"
                                    d="m28.917 34.477l-.889-13.262c-.166-2.583-.246-4.439-.246-5.565c0-1.534.4-2.727 1.202-3.588c.805-.856 1.863-1.286 3.175-1.286c1.583 0 2.646.551 3.178 1.646c.537 1.102.809 2.684.809 4.751c0 1.215-.066 2.453-.198 3.708l-1.19 13.649c-.129 1.626-.404 2.872-.827 3.739c-.426.871-1.128 1.301-2.109 1.301c-.992 0-1.69-.419-2.072-1.257c-.393-.841-.668-2.12-.833-3.836m3.072 18.217c-1.125 0-2.106-.362-2.947-1.093c-.841-.728-1.26-1.748-1.26-3.058c0-1.143.4-2.12 1.202-2.921c.805-.806 1.786-1.206 2.951-1.206s2.153.4 2.977 1.206c.815.801 1.234 1.778 1.234 2.921c0 1.29-.419 2.308-1.246 3.044a4.245 4.245 0 0 1-2.911 1.107" />
                            </svg>
                        </div>

                    </h5>

                    <div class="p-2 mb-2">
                        <div class="d-flex justify-content-between">
                            <div class="align-self-center">
                                {{ $hemotipo->nombre }}

                            </div>
                            <div class="align-self-center d-none" id="id_hemotipo">
                                {{ $hemotipo->id_hemotipo }}
                            </div>
                            <div class="align-self-center APNP-data d-none animate__animated animate__fadeInUp">
                                <a class="btn-blue-sec fst-normal tooltip-container" data-bs-toggle="collapse"
                                    href="#Edit-Hemotipo" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 32 32">
                                        <path
                                            d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z" />
                                    </svg>
                                    <span class="tooltip-text">Editar hemotipo.</span>
                                </a>
                            </div>
                        </div>

                        {{-- Collapse para el cambio de tipo de sangre --}}
                        <div class="Edit-hemotipo collapse mt-1" id="Edit-Hemotipo">
                            @php
                                $selected = $hemotipo->id_hemotipo ?? '';
                            @endphp

                            <select class="form-control" id="new_hemotipo" name="new_hemotipo">
                                @foreach ($hemotipos as $hemotipo)
                                    <option value="{{ $hemotipo['id_hemotipo'] }}"
                                        {{ $selected == $hemotipo['id_hemotipo'] ? 'selected' : '' }}>
                                        {{ $hemotipo['nombre'] }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- Boton de guardar cambios  --}}
                            <div class="d-flex justify-content-center mt-2">

                                <button class="btn-sec fst-normal tooltip-container" id="save-Hemotipo">
                                    Guardar
                                    <span class="tooltip-text2">Guardar cambios.</span>
                                </button>
                            </div>
                        </div>
                    </div>


                    <h5 class="m-0 d-flex justify-content-start mt-2">
                        <span class="pe-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path fill="#0284c7" fill-rule="evenodd"
                                    d="M11.612 3.302c.243-.07.5-.07.743 0c.518.147 1.04.283 1.564.42c2.461.641 4.96 1.293 7.184 3.104l1.024.834c.415.338.623.84.623 1.34v7a.75.75 0 0 1-1.5 0v-4.943l-.163.133a11.946 11.946 0 0 1-2.398 1.513c.04.091.061.191.061.297v4.294a2.75 2.75 0 0 1-1.751 2.562l-4 1.56a2.75 2.75 0 0 1-1.998 0l-4-1.56a2.75 2.75 0 0 1-1.751-2.562V13c0-.108.023-.211.064-.304c-.83-.399-1.64-.89-2.417-1.522l-1.024-.834c-.83-.677-.83-2.003 0-2.68l1.04-.85c2.207-1.8 4.689-2.449 7.132-3.087a74.375 74.375 0 0 0 1.567-.421m9.638 5.699c0-.09-.036-.15-.07-.178l-1.024-.834C18 6.5 16.078 5.843 13.64 5.202a90.449 90.449 0 0 1-1.656-.446c-.57.161-1.124.307-1.662.449c-2.42.636-4.529 1.191-6.46 2.768l-1.041.849c-.035.028-.071.087-.071.177s.036.15.07.178l1.025.834c1.948 1.587 4.076 2.146 6.515 2.787c.537.14 1.088.286 1.656.446c.57-.161 1.124-.307 1.662-.449c2.42-.636 4.529-1.191 6.46-2.767l1.041-.85c.035-.028.071-.087.071-.177m-7.294 5.276c1.1-.287 2.207-.577 3.294-.972v3.989c0 .515-.316.977-.796 1.165l-4 1.559a1.25 1.25 0 0 1-.908 0l-4-1.56a1.25 1.25 0 0 1-.796-1.164v-3.998c1.099.4 2.219.692 3.33.982c.525.137 1.047.273 1.565.42c.243.07.5.07.743 0c.519-.148 1.042-.284 1.568-.421"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        Escolaridad

                        <div class="ms-3 apnp-refresh-esc d-none animate__animated animate__fadeInUp" data-icon="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 64 64">
                                <path fill="#ffdd15"
                                    d="M63.37 53.52C53.982 36.37 44.59 19.22 35.2 2.07a3.687 3.687 0 0 0-6.522 0C19.289 19.22 9.892 36.37.508 53.52c-1.453 2.649.399 6.083 3.258 6.083h56.35c1.584 0 2.648-.853 3.203-2.01c.698-1.102.885-2.565.055-4.075" />
                                <path fill="#1f2e35"
                                    d="m28.917 34.477l-.889-13.262c-.166-2.583-.246-4.439-.246-5.565c0-1.534.4-2.727 1.202-3.588c.805-.856 1.863-1.286 3.175-1.286c1.583 0 2.646.551 3.178 1.646c.537 1.102.809 2.684.809 4.751c0 1.215-.066 2.453-.198 3.708l-1.19 13.649c-.129 1.626-.404 2.872-.827 3.739c-.426.871-1.128 1.301-2.109 1.301c-.992 0-1.69-.419-2.072-1.257c-.393-.841-.668-2.12-.833-3.836m3.072 18.217c-1.125 0-2.106-.362-2.947-1.093c-.841-.728-1.26-1.748-1.26-3.058c0-1.143.4-2.12 1.202-2.921c.805-.806 1.786-1.206 2.951-1.206s2.153.4 2.977 1.206c.815.801 1.234 1.778 1.234 2.921c0 1.29-.419 2.308-1.246 3.044a4.245 4.245 0 0 1-2.911 1.107" />
                            </svg>
                        </div>
                    </h5>

                    <div class="p-2">
                        <div class="d-flex justify-content-between">
                            <div class="align-self-center">
                                {{ $escolaridad->nombre }}
                            </div>
                            <div class="align-self-center d-none" id="id_escolaridad">
                                {{ $escolaridad->id_escolaridad }}
                            </div>
                            <div class="align-self-center APNP-data d-none animate__animated animate__fadeInUp">
                                <a class="btn-blue-sec fst-normal tooltip-container" data-bs-toggle="collapse"
                                    href="#Edit-escolaridad" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 32 32">
                                        <path
                                            d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z" />
                                    </svg>
                                    <span class="tooltip-text">Editar escolaridad.</span>
                                </a>
                            </div>
                        </div>

                        <div class="Edit-school collapse mt-1" id="Edit-escolaridad">
                            @php
                                $selected = $escolaridad->id_escolaridad ?? '';
                            @endphp

                            <select class="form-control" id="new_school" name="new_school">
                                @foreach ($escolaridades as $escolaridad)
                                    <option value="{{ $escolaridad['id_escolaridad'] }}"
                                        {{ $selected == $escolaridad['id_escolaridad'] ? 'selected' : '' }}>
                                        {{ $escolaridad['nombre'] }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- Boton de guardar cambios  --}}
                            <div class="d-flex justify-content-center mt-2">

                                <button class="btn-sec fst-normal tooltip-container" id="save-School">
                                    Guardar
                                    <span class="tooltip-text2">Guardar cambios.</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12 mt-3 ">
                <div class="row">
                    <div class="d-flex justify-content-center">
                        <div class="">
                            <button
                                class="btn-sec fst-normal tooltip-container  apnp-refresh d-none animate__animated animate__fadeInUp"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M10 3v2a5 5 0 0 0-3.54 8.54l-1.41 1.41A7 7 0 0 1 10 3m4.95 2.05A7 7 0 0 1 10 17v-2a5 5 0 0 0 3.54-8.54zM10 20l-4-4l4-4zm0-12V0l4 4z" />
                                </svg>
                                Recargar
                                <span class="tooltip-text">Recargar página.</span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
