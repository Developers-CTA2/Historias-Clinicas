<div class="card">
    <div class="card-header text-center bg-blue">
        Antecedentes personales NO patólogicos
    </div>
    <div class="card-body">
        <div class="row col-12">
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
                                        {{-- boton de de editar --}}
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
            </div>


            <div class="col-lg-4 col-md-4 col-sm-12 m-0">
                <div class="form-group">

                    <h5 class="m-0 aling-items-center">
                        <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 24 24">
                                <path fill="#BE3144"
                                    d="M12 22q-3.425 0-5.712-2.35T4 13.8q0-1.55.7-3.1t1.75-2.975T8.725 5.05T11 2.875q.2-.2.463-.287T12 2.5t.538.088t.462.287q1.05.925 2.275 2.175t2.275 2.675T19.3 10.7t.7 3.1q0 3.5-2.287 5.85T12 22m0-2q2.6 0 4.3-1.763T18 13.8q0-1.825-1.513-4.125T12 4.65Q9.025 7.375 7.513 9.675T6 13.8q0 2.675 1.7 4.438T12 20m-2-2h4q.425 0 .713-.288T15 17t-.288-.712T14 16h-4q-.425 0-.712.288T9 17t.288.713T10 18m1-5v1q0 .425.288.713T12 15t.713-.288T13 14v-1h1q.425 0 .713-.288T15 12t-.288-.712T14 11h-1v-1q0-.425-.288-.712T12 9t-.712.288T11 10v1h-1q-.425 0-.712.288T9 12t.288.713T10 13z" />
                            </svg>
                        </span> Hemotipo
                    </h5>

                    <div class="p-2">
                        <div class="d-flex justify-content-between">
                            <span class="align-self-center">
                                AB +
                            </span>
                            <div class="align-self-center">
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

                        <div class="Edit-hemotipo collapse" id="Edit-Hemotipo">
                            <label for="E_type">Selecciona un tipo</label>
                            <select class="form-control" name="E_type" id="E_type">
                                <option value="0" selected>Selecciona una opción</option>
                                <option value="1">A -</option>
                                <option value="2">A +</option>
                                <option value="3">B -</option>
                                <option value="4">B +</option>

                            </select>
                            <span class="text-danger fw-normal" id="error-message" style="display: none;">Tipo
                                no válido.</span>

                            <div class="d-flex justify-content-center mt-1">

                                <a class="btn-sec fst-normal tooltip-container">
                                    Guardar
                                    <span class="tooltip-text">Guardar cambios.</span>
                                </a>
                            </div>
                        </div>
                    </div>


                    <h5 class="m-0 aling-items-center">
                        <span class="pe-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="#0284c7" fill-rule="evenodd"
                                    d="M11.612 3.302c.243-.07.5-.07.743 0c.518.147 1.04.283 1.564.42c2.461.641 4.96 1.293 7.184 3.104l1.024.834c.415.338.623.84.623 1.34v7a.75.75 0 0 1-1.5 0v-4.943l-.163.133a11.946 11.946 0 0 1-2.398 1.513c.04.091.061.191.061.297v4.294a2.75 2.75 0 0 1-1.751 2.562l-4 1.56a2.75 2.75 0 0 1-1.998 0l-4-1.56a2.75 2.75 0 0 1-1.751-2.562V13c0-.108.023-.211.064-.304c-.83-.399-1.64-.89-2.417-1.522l-1.024-.834c-.83-.677-.83-2.003 0-2.68l1.04-.85c2.207-1.8 4.689-2.449 7.132-3.087a74.375 74.375 0 0 0 1.567-.421m9.638 5.699c0-.09-.036-.15-.07-.178l-1.024-.834C18 6.5 16.078 5.843 13.64 5.202a90.449 90.449 0 0 1-1.656-.446c-.57.161-1.124.307-1.662.449c-2.42.636-4.529 1.191-6.46 2.768l-1.041.849c-.035.028-.071.087-.071.177s.036.15.07.178l1.025.834c1.948 1.587 4.076 2.146 6.515 2.787c.537.14 1.088.286 1.656.446c.57-.161 1.124-.307 1.662-.449c2.42-.636 4.529-1.191 6.46-2.767l1.041-.85c.035-.028.071-.087.071-.177m-7.294 5.276c1.1-.287 2.207-.577 3.294-.972v3.989c0 .515-.316.977-.796 1.165l-4 1.559a1.25 1.25 0 0 1-.908 0l-4-1.56a1.25 1.25 0 0 1-.796-1.164v-3.998c1.099.4 2.219.692 3.33.982c.525.137 1.047.273 1.565.42c.243.07.5.07.743 0c.519-.148 1.042-.284 1.568-.421"
                                    clip-rule="evenodd" />
                            </svg>
                        </span> Escolaridad
                    </h5>

                    <div class="p-2">
                        <div class="d-flex justify-content-between">
                            <span class="align-self-center">
                                Licenciatura
                            </span>
                            <div class="align-self-center">
                                <a class="btn-blue-sec fst-normal tooltip-container" data-bs-toggle="collapse"
                                    href="#Edit-escolaridad" role="button" aria-expanded="false"
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

                        <div class="Edit-hemotipo collapse" id="Edit-escolaridad">
                            <label for="E_type">Selecciona un tipo</label>
                            <select class="form-control" name="E_type" id="E_type">
                                <option value="0" selected>Selecciona una opción</option>
                                <option value="1">Primaria</option>
                                <option value="2">Secunadria</option>
                                <option value="3">Preparatoria</option>
                                <option value="4">Licenciatura</option>
                                <option value="5">Maestría</option>
                                <option value="6">Doctorado</option>

                            </select>
                            <span class="text-danger fw-normal" id="error-message" style="display: none;">Tipo
                                no válido.</span>

                            <div class="d-flex justify-content-center mt-1">

                                <a class="btn-sec fst-normal tooltip-container">
                                    Guardar
                                    <span class="tooltip-text">Guardar cambios.</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
