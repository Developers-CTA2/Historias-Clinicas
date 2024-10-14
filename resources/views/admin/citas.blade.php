@extends('admin.layouts.main')

@section('title', 'Citas del Día')

@section('viteConfig')
    @vite('resources/sass/citas.scss')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
@endsection

@section('content')
    <!-- Boton para ingresar una nueva cita -->
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 col-lg-6">
                <h5 class="mb-0 fw-bold text-muted">Citas:</h5>
                <p class="mb-0">{{ $fechaFormateada }}</p>
            </div>

            <input type="hidden" id="dateInitial" value="{{ $fecha }}">
            <div class="col-12 col-lg-6 d-flex justify-content-end align-items-center">

                <x-button-custom class="btn-blue" data-bs-toggle="modal" data-bs-target="#addCitaModal" text="Agendar cita"
                    tooltipText="Agendar una nueva cita">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 32 32">
                            <path fill="currentColor" d="M17 15V8h-2v7H8v2h7v7h2v-7h7v-2z" />
                        </svg>
                    </x-slot>
                </x-button-custom>

            </div>
        </div>



        <div class="row mb-4 card shadow-custom ">
            <div class="col-12 d-flex justify-content-between py-3 px-3 align-items-center">
                <div>
                    <h5 class="fw-bold text-muted mb-0">Citas para la <span id="citasPara"> - <span></h5>
                </div>
                <div class="form-group">
                    <select class="form-select" id="selectFilterTable">
                        <option value="medico">Consultas para el Médico</option>
                        <option value="nuticion">Consultas para la Nutriologa</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row card shadow-custom p-3 ">

            <div class="col-12 animate__animated animate__bounceIn" id="containerTableDoctor">
                <div id="tableCitasDoctor"></div>
            </div>

            <div class="col-12 d-none animate__animated animate__bounceIn" id="containerTableNutrition">
                <div id="tableCitasNutrition"></div>
            </div>

        </div>

        
        {{-- Modal for add cita --}}
        <x-modal-citas modal-id="addCitaModal" modal-title="Agendar cita" :route-form="route('guardarCita')" method-form="POST"
            :date-cita=$fecha button-submit-text="Agendar cita" form-id="addCitaForm" error-alert-id="errorListAddCita">

            {{-- Nombre completo --}}
            <x-form-group class="col-xl-12">
                <x-slot name="label">
                    <label for="nombre"><span class="required-point me-1">*</span> Nombre
                        Completo:</label>
                </x-slot>
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                        <path fill="#ea580c"
                            d="M15.71 12.71a6 6 0 1 0-7.42 0a10 10 0 0 0-6.22 8.18a1 1 0 0 0 2 .22a8 8 0 0 1 15.9 0a1 1 0 0 0 1 .89h.11a1 1 0 0 0 .88-1.1a10 10 0 0 0-6.25-8.19M12 12a4 4 0 1 1 4-4a4 4 0 0 1-4 4" />
                    </svg>
                </x-slot>
                <x-slot name="input">
                    <input class="form-control group-add-form" type="text" id="nombre" name="nombre"
                        oninput="this.value = this.value.toUpperCase()" />
                </x-slot>
            </x-form-group>

            {{-- Correo  --}}
            <x-form-group>
                <x-slot name="label">
                    <label for="correo"><span class="required-point me-1">*</span> Correo
                        Electrónico:</label>
                </x-slot>
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                        <path fill="#0891b2"
                            d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm3.519 0L12 11.671L18.481 6zM20 7.329l-7.341 6.424a1 1 0 0 1-1.318 0L4 7.329V18h16z" />
                    </svg>
                </x-slot>
                <x-slot name="input">
                    <input class="form-control group-add-form" type="email" name="correo" id="correo"
                        oninput="this.value = this.value.toUpperCase()" />
                </x-slot>
            </x-form-group>

            {{-- Telefono --}}
            <x-form-group>
                <x-slot name="label">
                    <label for="telefono"><span class="required-point me-1">*</span> Teléfono:</label>
                </x-slot>
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256">
                        <path fill="#059669"
                            d="m222.37 158.46l-47.11-21.11l-.13-.06a16 16 0 0 0-15.17 1.4a8 8 0 0 0-.75.56L134.87 160c-15.42-7.49-31.34-23.29-38.83-38.51l20.78-24.71c.2-.25.39-.5.57-.77a16 16 0 0 0 1.32-15.06v-.12L97.54 33.64a16 16 0 0 0-16.62-9.52A56.26 56.26 0 0 0 32 80c0 79.4 64.6 144 144 144a56.26 56.26 0 0 0 55.88-48.92a16 16 0 0 0-9.51-16.62M176 208A128.14 128.14 0 0 1 48 80a40.2 40.2 0 0 1 34.87-40a.6.6 0 0 0 0 .12l21 47l-20.67 24.74a6 6 0 0 0-.57.77a16 16 0 0 0-1 15.7c9.06 18.53 27.73 37.06 46.46 46.11a16 16 0 0 0 15.75-1.14a8 8 0 0 0 .74-.56L168.89 152l47 21.05h.11A40.21 40.21 0 0 1 176 208" />
                    </svg>
                </x-slot>
                <x-slot name="input">
                    <input class="form-control group-add-form" name="telefono" id="telefono" pattern="[0-9]{10}"
                        maxlength="10" />
                </x-slot>
            </x-form-group>

            {{-- TIpo de profesional --}}
            <x-form-group>
                <x-slot name="label">
                    <label for="tipo_profesional"><span class="required-point me-1">*</span> Tipo de
                        especialista:</label>
                </x-slot>
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                        <path fill="#4f46e5"
                            d="M5.5 12.4L1.6 8.5l3.9-3.9l3.9 3.9zM9 22v-5q-1.525-.125-3.025-.363T3 16l.5-2q2.1.575 4.213.788T12 15t4.288-.213T20.5 14l.5 2q-1.475.4-2.975.638T15 17v5zM5.5 9.6l1.1-1.1l-1.1-1.1l-1.1 1.1zM12 7q-1.25 0-2.125-.875T9 4t.875-2.125T12 1t2.125.875T15 4t-.875 2.125T12 7m0 7q-.825 0-1.412-.587T10 12t.588-1.412T12 10t1.413.588T14 12t-.587 1.413T12 14m0-9q.425 0 .713-.288T13 4t-.288-.712T12 3t-.712.288T11 4t.288.713T12 5m5.05 7l-1.7-3l1.7-3h3.4l1.7 3l-1.7 3zm1.15-2h1.1l.55-1l-.55-1h-1.1l-.55 1zm.55-1" />
                    </svg>
                </x-slot>
                <x-slot name="input">
                    <select class="form-control group-add-form" name="tipo_profesional" id="tipo_profesional">
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="Doctora">Doctora</option>
                        <option value="Nutrióloga">Nutrióloga</option>
                    </select>
                </x-slot>
            </x-form-group>

            {{-- Horario --}}
            <x-form-group>
                <x-slot name="label">
                    <label for="hora"><span class="required-point me-1">*</span> Hora:</label>
                </x-slot>
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                        <path fill="none" stroke="#c026d3" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0-18 0m9 0l-3-2m3-3v5" />
                    </svg>
                </x-slot>
                <x-slot name="input">
                    <select class="form-control group-add-form" name="hora" id="hora" required>
                        @for ($hour = 8; $hour <= 18; $hour++)
                            @foreach (['00', '30'] as $minute)
                                <option value="{{ sprintf('%02d:%02d', $hour, $minute) }}">
                                    {{ sprintf('%02d:%02d', $hour, $minute) }}</option>
                            @endforeach
                        @endfor
                    </select>
                </x-slot>
            </x-form-group>


            {{-- Motivo --}}
            <x-form-group class="col-xl-12">
                <x-slot name="label">
                    <label for="motivo"><span class="required-point me-1">*</span> Motivo:</label>
                </x-slot>
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                        <path fill="#0891b2"
                            d="M8 18h8v-2H8zm0-4h8v-2H8zm-2 8q-.825 0-1.412-.587T4 20V4q0-.825.588-1.412T6 2h8l6 6v12q0 .825-.587 1.413T18 22zm7-13V4H6v16h12V9zM6 4v5zv16z" />
                    </svg>
                </x-slot>
                <x-slot name="input">
                    <input type="text" class="form-control group-add-form" name="motivo" id="motivo">
                </x-slot>
            </x-form-group>

        </x-modal-citas>



        {{-- Modal for edit cita --}}
        <x-modal-citas modal-id="editModalCita" modal-title="Editar cita" route-form="#"
            :date-cita=$fecha button-submit-text="Guardar cambios" form-id="editFormCita" :is-method-put="false" error-alert-id="errorListEditCita">

            {{-- Nombre completo --}}
            <x-form-group class="col-xl-12">
                <x-slot name="label">
                    <label for="nameEdit"><span class="required-point me-1">*</span> Nombre
                        Completo:</label>
                </x-slot>
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                        <path fill="#ea580c"
                            d="M15.71 12.71a6 6 0 1 0-7.42 0a10 10 0 0 0-6.22 8.18a1 1 0 0 0 2 .22a8 8 0 0 1 15.9 0a1 1 0 0 0 1 .89h.11a1 1 0 0 0 .88-1.1a10 10 0 0 0-6.25-8.19M12 12a4 4 0 1 1 4-4a4 4 0 0 1-4 4" />
                    </svg>
                </x-slot>
                <x-slot name="input">
                    <input class="form-control group-edit-form" type="text" id="nameEdit" name="nameEdit"
                        oninput="this.value = this.value.toUpperCase()" />
                </x-slot>
            </x-form-group>

            {{-- Correo  --}}
            <x-form-group class="col-xl-12">
                <x-slot name="label">
                    <label for="emailEdit"><span class="required-point me-1">*</span> Correo
                        Electrónico:</label>
                </x-slot>
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                        <path fill="#0891b2"
                            d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm3.519 0L12 11.671L18.481 6zM20 7.329l-7.341 6.424a1 1 0 0 1-1.318 0L4 7.329V18h16z" />
                    </svg>
                </x-slot>
                <x-slot name="input">
                    <input class="form-control group-edit-form" type="email" name="emailEdit" id="emailEdit"
                        oninput="this.value = this.value.toUpperCase()" />
                </x-slot>
            </x-form-group>

            {{-- Telefono --}}
            <x-form-group>
                <x-slot name="label">
                    <label for="phoneEdit"><span class="required-point me-1">*</span> Teléfono:</label>
                </x-slot>
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256">
                        <path fill="#059669"
                            d="m222.37 158.46l-47.11-21.11l-.13-.06a16 16 0 0 0-15.17 1.4a8 8 0 0 0-.75.56L134.87 160c-15.42-7.49-31.34-23.29-38.83-38.51l20.78-24.71c.2-.25.39-.5.57-.77a16 16 0 0 0 1.32-15.06v-.12L97.54 33.64a16 16 0 0 0-16.62-9.52A56.26 56.26 0 0 0 32 80c0 79.4 64.6 144 144 144a56.26 56.26 0 0 0 55.88-48.92a16 16 0 0 0-9.51-16.62M176 208A128.14 128.14 0 0 1 48 80a40.2 40.2 0 0 1 34.87-40a.6.6 0 0 0 0 .12l21 47l-20.67 24.74a6 6 0 0 0-.57.77a16 16 0 0 0-1 15.7c9.06 18.53 27.73 37.06 46.46 46.11a16 16 0 0 0 15.75-1.14a8 8 0 0 0 .74-.56L168.89 152l47 21.05h.11A40.21 40.21 0 0 1 176 208" />
                    </svg>
                </x-slot>
                <x-slot name="input">
                    <input class="form-control group-edit-form" name="phoneEdit" id="phoneEdit" pattern="[0-9]{10}"
                        maxlength="10" />
                </x-slot>
            </x-form-group>

            {{-- TIpo de profesional --}}
            <x-form-group>
                <x-slot name="label">
                    <label for="typeProfessionalEdit"><span class="required-point me-1">*</span> Tipo de
                        especialista:</label>
                </x-slot>
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                        <path fill="#4f46e5"
                            d="M5.5 12.4L1.6 8.5l3.9-3.9l3.9 3.9zM9 22v-5q-1.525-.125-3.025-.363T3 16l.5-2q2.1.575 4.213.788T12 15t4.288-.213T20.5 14l.5 2q-1.475.4-2.975.638T15 17v5zM5.5 9.6l1.1-1.1l-1.1-1.1l-1.1 1.1zM12 7q-1.25 0-2.125-.875T9 4t.875-2.125T12 1t2.125.875T15 4t-.875 2.125T12 7m0 7q-.825 0-1.412-.587T10 12t.588-1.412T12 10t1.413.588T14 12t-.587 1.413T12 14m0-9q.425 0 .713-.288T13 4t-.288-.712T12 3t-.712.288T11 4t.288.713T12 5m5.05 7l-1.7-3l1.7-3h3.4l1.7 3l-1.7 3zm1.15-2h1.1l.55-1l-.55-1h-1.1l-.55 1zm.55-1" />
                    </svg>
                </x-slot>
                <x-slot name="input">
                    <select class="form-control group-edit-form" name="typeProfessionalEdit" id="typeProfessionalEdit">
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="Doctora">Doctora</option>
                        <option value="Nutrióloga">Nutrióloga</option>
                    </select>
                </x-slot>
            </x-form-group>

            {{-- Horario --}}
            <x-form-group>
                <x-slot name="label">
                    <label for="hourEdit"><span class="required-point me-1">*</span> Hora:</label>
                </x-slot>
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                        <path fill="none" stroke="#c026d3" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0-18 0m9 0l-3-2m3-3v5" />
                    </svg>
                </x-slot>
                <x-slot name="input">
                    <select class="form-control group-edit-form" name="hourEdit" id="hourEdit" required>
                        @for ($hour = 8; $hour <= 18; $hour++)
                            @foreach (['00', '30'] as $minute)
                                <option value="{{ sprintf('%02d:%02d', $hour, $minute) }}">
                                    {{ sprintf('%02d:%02d', $hour, $minute) }}</option>
                            @endforeach
                        @endfor
                    </select>
                </x-slot>
            </x-form-group>

            <x-form-group>
                <x-slot name="label">
                    <label for="statusEdit"><span class="required-point me-1">*</span> Estatus:</label>
                </x-slot>
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 16 16"><path fill="#e11d48" fill-rule="evenodd" d="M15.941 7.033a8 8 0 0 1-14.784 5.112a.75.75 0 1 1 1.283-.778a6.5 6.5 0 1 0 8.922-8.93a.75.75 0 0 1 .776-1.284a8 8 0 0 1 3.803 5.88M9 1a1 1 0 1 1-2 0a1 1 0 0 1 2 0M2.804 5a1 1 0 1 0-1.732-1a1 1 0 0 0 1.732 1M1 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2m4-4.196a1 1 0 1 0-1-1.732a1 1 0 0 0 1 1.732" clip-rule="evenodd"/></svg>
                </x-slot>
                <x-slot name="input">
                    <select class="form-control group-edit-form" name="statusEdit" id="statusEdit" required>
                        @foreach ($estatus as $value)
                            <option value="{{ $value->id }}">{{ $value->status }}</option>
                        @endforeach
                    </select>
                </x-slot>
            </x-form-group>


            {{-- Motivo --}}
            <x-form-group class="col-xl-12">
                <x-slot name="label">
                    <label for="reasonEdit"><span class="required-point me-1">*</span> Motivo:</label>
                </x-slot>
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                        <path fill="#0891b2"
                            d="M8 18h8v-2H8zm0-4h8v-2H8zm-2 8q-.825 0-1.412-.587T4 20V4q0-.825.588-1.412T6 2h8l6 6v12q0 .825-.587 1.413T18 22zm7-13V4H6v16h12V9zM6 4v5zv16z" />
                    </svg>
                </x-slot>
                <x-slot name="input">
                    <input type="text" class="form-control group-edit-form" name="reasonEdit" id="reasonEdit">
                </x-slot>
            </x-form-group>

        </x-modal-citas>


    </div>
@endsection

@section('scripts')
    @vite(['resources/js/citas.js'])
@endsection
