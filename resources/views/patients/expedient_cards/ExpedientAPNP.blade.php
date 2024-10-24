<x-card-custom title="Antecedentes personales NO patólogicos">
    <div class="row">
        @role('Administrador')
            <div class="d-flex justify-content-between">

                {{-- Alerta de edicion  --}}
                <x-alert-manage containerClass="APNP-data apnp-refresh" textClass="alert-APNP">
                </x-alert-manage>

                <div class="toggle tooltip-container">
                    <input type="checkbox" id="Edit-apnp">
                    <label for="Edit-apnp" class="label-check"></label>
                    <span class="tooltip-text">Habilitar edición.</span>
                </div>
            </div>
        @endrole
        {{-- Contenedor de las enfermedades --}}
       
        <div class="col-lg-8 col-12">
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
                    {{-- Icono de warning --}}
                    <div class="ms-3 apnp-refresh-toxi d-none animate__animated animate__fadeInUp">
                        <x-icon-warning />
                    </div>
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
                                            $fechaInicio = \Carbon\Carbon::parse($toxicomania->desde_cuando);
                                            $años = $fechaInicio->diffInYears(\Carbon\Carbon::now());
                                        @endphp

                                        <div class="align-self-center">
                                            <p class="m-0 fst-italic text-muted">Tiempo</p>

                                            <p> {{ $años }} años

                                            </p>

                                        </div>
                                        <div class="align-self-center">
                                            <p class="m-0 fst-italic text-muted">Cantidad</p>
                                            <p class="text-center"> {{ trim($cadena[0]) }}</p>
                                        </div>

                                        <div class="align-self-center">
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
                                        @php
                                            $string = $toxicomania->observacion;
                                            $cadena = explode(',', $string);
                                        @endphp
                                        {{-- Caso de las demas toxicomanias  --}}
                                        <div class="align-self-center"
                                            style="max-width: 80%; overflow: hidden; text-overflow: ellipsis;">
                                            <span>
                                                <p class="m-0 fst-italic text-muted">Observación</p>

                                                <p> {{ $cadena[1] }}</p>
                                            </span>
                                        </div>
                                        <div class="align-self-center">
                                            <span>
                                                @php
                                                    $fechaInicio = Carbon::parse($toxicomania->desde_cuando);
                                                    $años = $fechaInicio->diffInYears(Carbon::now());
                                                @endphp
                                                <p class="m-0 fst-italic text-muted">Tiempo</p>

                                                <p> {{ $años }} años

                                                </p>
                                            </span>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                @role('Administrador')
                    <div class="col-12 mt-3 ">
                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <x-button-custom type="button"
                                    class="btn-sec justify-content-center justify-content-lg-start  APNP-data d-none animate__animated animate__fadeInUp"
                                    data-bs-toggle="modal" data-bs-target="#add-toxic" text="Agregar"
                                    tooltipText="Agregar nueva toxicomanía.">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m5 11h-4v4h-2v-4H7v-2h4V7h2v4h4z" />
                                        </svg>
                                    </x-slot>
                                </x-button-custom>
                            </div>
                        </div>
                    </div>
                @endrole
            </div> <!-- FIN contenedor 1  -->
        </div>

        {{-- Contenedor del Hemotipo y la escoliaridad  --}}
        <div class="col-lg-4 col-12 m-0">
            <div class="form-group">

                <h5 class="m-0 d-flex justify-content-start">
                    <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                            viewBox="0 0 24 24">
                            <path fill="#BE3144"
                                d="M12 22q-3.425 0-5.712-2.35T4 13.8q0-1.55.7-3.1t1.75-2.975T8.725 5.05T11 2.875q.2-.2.463-.287T12 2.5t.538.088t.462.287q1.05.925 2.275 2.175t2.275 2.675T19.3 10.7t.7 3.1q0 3.5-2.287 5.85T12 22m0-2q2.6 0 4.3-1.763T18 13.8q0-1.825-1.513-4.125T12 4.65Q9.025 7.375 7.513 9.675T6 13.8q0 2.675 1.7 4.438T12 20m-2-2h4q.425 0 .713-.288T15 17t-.288-.712T14 16h-4q-.425 0-.712.288T9 17t.288.713T10 18m1-5v1q0 .425.288.713T12 15t.713-.288T13 14v-1h1q.425 0 .713-.288T15 12t-.288-.712T14 11h-1v-1q0-.425-.288-.712T12 9t-.712.288T11 10v1h-1q-.425 0-.712.288T9 12t.288.713T10 13z" />
                        </svg>
                    </span>
                    Hemotipo
                    {{-- Icono de warning --}}
                    <div class="ms-3 apnp-refresh-homo d-none animate__animated animate__fadeInUp">
                        <x-icon-warning />
                    </div>
                </h5>

                <ul class="list-group">
                    <li class="list-group-item p-2 mt-2">

                        <div class="d-flex justify-content-between">
                            <div class="align-self-center">
                                {{ $hemotipo->nombre }}

                            </div>
                            <div class="align-self-center d-none" id="id_hemotipo">
                                {{ $hemotipo->id_hemotipo }}
                            </div>
                            @role('Administrador')
                                <div class="align-self-center APNP-data d-none animate__animated animate__fadeInUp">

                                    <x-button-custom type="button"
                                        class="btn-blue-sec justify-content-center justify-content-lg-start"
                                        data-bs-toggle="collapse" href="#Edit-Hemotipo" role="button" aria-expanded="false"
                                        aria-controls="collapseExample" padding="px-1 py-1" :onlyIcon="true"
                                        tooltipText="Editar registro">
                                        <x-slot name="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 32 32">
                                                <path
                                                    d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z" />
                                            </svg>
                                        </x-slot>
                                    </x-button-custom>
                                </div>
                            @endrole
                        </div>
                        @role('Administrador')
                            {{-- Collapse para el cambio de tipo de sangre --}}
                            <div class="Edit-hemotipo collapse mt-1" id="Edit-Hemotipo">
                                @php
                                    $selected = $hemotipo->id_hemotipo ?? '';
                                @endphp

                                <label for="new_hemotipo"> Selecciona un hemotipo <span class="red-color">
                                        *</span></label>
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

                                    <x-button-custom type="button"
                                        class="btn-blue-sec justify-content-center justify-content-lg-start"
                                        id="save-Hemotipo" text="Guardar" tooltipText="Guardar cambios.">
                                        <x-slot name="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 24 24">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1.5"
                                                    d="M16.25 21v-4.765a1.59 1.59 0 0 0-1.594-1.588H9.344a1.59 1.59 0 0 0-1.594 1.588V21m8.5-17.715v2.362a1.59 1.59 0 0 1-1.594 1.588H9.344A1.59 1.59 0 0 1 7.75 5.647V3m8.5.285A3.2 3.2 0 0 0 14.93 3H7.75m8.5.285c.344.156.661.374.934.645l2.382 2.375A3.17 3.17 0 0 1 20.5 8.55v9.272A3.18 3.18 0 0 1 17.313 21H6.688A3.18 3.18 0 0 1 3.5 17.823V6.176A3.18 3.18 0 0 1 6.688 3H7.75" />
                                            </svg>
                                        </x-slot>
                                    </x-button-custom>
                                </div>
                            </div>

                        @endrole
                    </li>
                </ul>

            </div>
        </div>
        @role('Administrador')
            <div class="col-12 mt-3 ">
                <div class="row">
                    <div class="d-flex justify-content-center">
                        <div class="apnp-refresh d-none animate__animated animate__fadeInUp">
                            <x-button-custom type="button"
                                class="btn-sec justify-content-center justify-content-lg-start" text="Recargar"
                                tooltipText="Recargar página." onclick="location.reload();">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M10 3v2a5 5 0 0 0-3.54 8.54l-1.41 1.41A7 7 0 0 1 10 3m4.95 2.05A7 7 0 0 1 10 17v-2a5 5 0 0 0 3.54-8.54zM10 20l-4-4l4-4zm0-12V0l4 4z" />
                                    </svg>
                                </x-slot>
                            </x-button-custom>
                        </div>
                    </div>
                </div>
            </div>
        @endrole
    </div>
</x-card-custom>





@role('Administrador')
    @include('patients.expedient_cards.modals_expedient.modal_add_toxic')
@endrole
