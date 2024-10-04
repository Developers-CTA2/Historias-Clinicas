<div class="card">
    <div class="card-header text-center bg-blue">
        Expediente clínico
    </div>
    <div class="card-body">
        <div class="row col-12 m-0 p-0 cont-start">

            @role('Administrador')
                <div class="d-flex justify-content-between ">
                    <div class="mb-2">
                        {{-- Alerta de edicion  --}}
                        <x-alert-manage containerClass="personal-data" textClass="P-data">
                        </x-alert-manage>

                    </div>
                    <div class="toggle tooltip-container">
                        <input type="checkbox" id="Edit-personal">
                        <label for="Edit-personal" class="label-check"></label>
                        <span class="tooltip-text">Habilitar edición.</span>
                    </div>
                </div>
            @endrole
            <div class="col-lg-6 col-md-6 col-sm-12 top-content mb-2">
                <div class="row form-group px-2">

                    <h5 class="aling-items-center">
                        <span class="pe-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                <path fill="#0284c7"
                                    d="M9 20H5q-.825 0-1.412-.587T3 18V4q0-.825.588-1.412T5 2h14q.825 0 1.413.588T21 4v14q0 .825-.587 1.413T19 20h-4l-2.3 2.3q-.15.15-.325.213t-.375.062t-.375-.062t-.325-.213zm-4-3.15q1.35-1.325 3.138-2.087T12 14t3.863.763T19 16.85V4H5zM12 12q1.45 0 2.475-1.025T15.5 8.5t-1.025-2.475T12 5T9.525 6.025T8.5 8.5t1.025 2.475T12 12m-5 6h10v-.25q-1.05-.875-2.325-1.312T12 16t-2.675.438T7 17.75zm5-8q-.625 0-1.062-.437T10.5 8.5t.438-1.062T12 7t1.063.438T13.5 8.5t-.437 1.063T12 10m0 .425" />
                            </svg> </span> Datos personales
                    </h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-start pt-0">
                            <div class="form-group col-12 pt-2">
                                <p class="fw-bold mb-0">Nombre completo:</p>
                                <div class="mt-0 W-data" id="name"> {{ $Personal->nombre }}</div>
                                @role('Administrador')
                                    <div class="mt-2 mb-1 input-optional d-none animate__animated animate__fadeInUp">
                                        <label for="new_name">Nombre completo: <span class="red-color"> *</span></label>
                                        <input class="form-control form-disabled" type="text" name="new_name"
                                            id="new_name" value="{{ $Personal->nombre }}">
                                        <span class="text-danger fw-normal" style=" display: none;">Nombre no
                                            válido.</span>
                                    </div>
                                @endrole
                            </div>
                        </li>
                        <li class="list-group-item pt-0">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12 pt-2">
                                    <p class="fw-bold mb-0">Código:</p>
                                    <div class="mt-0 W-data" id="code"> {{ $Personal->codigo ?? '--' }} </div>
                                    @role('Administrador')
                                        <div class="mt-2 mb-1 input-optional d-none animate__animated animate__fadeInUp">
                                            <label for="new_code">Código:</label>
                                            <div class="mt-0 W-data"> <s>Sin código </s></div>
                                        </div>
                                    @endrole
                                </div>

                                <div class="form-group col-md-6 col-sm-12 pt-2 div-cedula">
                                    <p class="fw-bold mb-0">Genero:</p>
                                    <div class="mt-0 W-data" id="gender"> {{ $Personal->sexo }} </div>
                                    @role('Administrador')
                                        <div class="mt-2 mb-1 input-optional d-none animate__animated animate__fadeInUp">
                                            <label for="new_gender">Género: <span class="red-color"> *</span></label>
                                            @php
                                                $Male = $Personal->sexo == 'Masculino' ? 'selected' : '';
                                                $Female = $Personal->sexo === 'Femenino' ? 'selected' : '';
                                            @endphp
                                            <select class="form-control" id="new_gender" name="new_gender">
                                                <option value="1" {{ $Male }}>Masculino</option>
                                                <option value="2" {{ $Female }}> Femenino </option>
                                            </select>
                                            <span class="text-danger fw-normal" style=" display: none;">Género no
                                                válido.</span>
                                        </div>
                                    @endrole
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item pt-0">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12 pt-2">
                                    <p class="fw-bold mb-0">Teléfono:</p>
                                    <div class="mt-0 W-data" id="tel"> {{ $Personal->telefono }} </div>

                                    @role('Administrador')
                                        <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                            <label for="new_tel">Teléfono: <span class="red-color"> *</span></label>
                                            <input class="form-control form-disabled" type="text" name="new_tel"
                                                id="new_tel" value="{{ $Personal->telefono }}" maxlength="10">
                                            <span class="text-danger fw-normal" style=" display: none;">Teléfono no
                                                válida.</span>
                                        </div>
                                    @endrole
                                </div>

                                <div class="form-group col-md-6 col-sm-12 pt-2">
                                    <p class="fw-bold mb-0">F. nacimiento:</p>
                                    @php
                                        use Carbon\Carbon;
                                    @endphp
                                    <div class="mt-0 W-data">
                                        {{ Carbon::parse($Personal->fecha_nacimiento)->locale('es')->isoFormat('LL') }}
                                    </div>
                                    <div class="mt-0 d-none" id="birthday"> {{ $Personal->fecha_nacimiento }}
                                    </div>
                                    @role('Administrador')
                                        <div class="mt-2 mb-1 input-optional d-none animate__animated animate__fadeInUp">
                                            <label for="new_birthday">F. nacimiento: <span class="red-color">
                                                    *</span></label>
                                            <input class="form-control form-disabled" type="date" name="new_birthday"
                                                id="new_birthday" value="{{ $Personal->fecha_nacimiento }}">
                                            <span class="text-danger fw-normal" style=" display: none;">Fecha no
                                                válida.</span>
                                        </div>
                                    @endrole
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item pt-0">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12 pt-2">
                                    <p class="fw-bold mb-0">Escolaridad:</p>
                                    <div class="mt-0 W-data"> {{ $Personal->escolaridad->nombre }} </div>
                                    <div class="mt-0 W-data d-none" id="escolaridad">
                                        {{ $Personal->escolaridad->id_escolaridad }} </div>
                                    @role('Administrador')
                                        <div class="mt-2 mb-1 input-optional d-none animate__animated animate__fadeInUp">
                                            <label for="new_escolaridad">Escolaridad: <span class="red-color">
                                                    *</span></label>
                                            @php
                                                $selected = $Personal->escolaridad->id_escolaridad ?? '';
                                            @endphp
                                            <select class="form-control" id="new_escolaridad" name="new_escolaridad">
                                                @foreach ($escolaridades as $escolaridad)
                                                    <option value="{{ $escolaridad['id_escolaridad'] }}"
                                                        {{ $selected == $escolaridad['id_escolaridad'] ? 'selected' : '' }}>
                                                        {{ $escolaridad['nombre'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger fw-normal" style="display: none;">Escolaridad no
                                                válida.</span>
                                        </div>
                                    @endrole
                                </div>

                                <div class="form-group col-md-6 col-sm-12 pt-2 div-cedula">
                                    <p class="fw-bold mb-0">NSS:</p>
                                    <div class="mt-0 W-data" id="nss"> {{ $Personal->nss }} </div>
                                    @role('Administrador')
                                        <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                            <label for="new_nss">NSS: <span class="red-color"> *</span></label>
                                            <input class="form-control form-disabled" type="text" name="new_nss"
                                                id="new_nss" value="{{ $Personal->nss }}" maxlength="11">
                                            <span class="text-danger fw-normal" style=" display: none;">NSS no
                                                válido.</span>
                                        </div>
                                    @endrole
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item pt-0">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12 pt-2">
                                    <p class="fw-bold mb-0">Ocupación:</p>
                                    <div class="mt-0 W-data" id="ocupation"> {{ $Personal->ocupacion }} </div>
                                    @role('Administrador')
                                        <div class="mt-2 mb-1 input-optional d-none animate__animated animate__fadeInUp">
                                            <label for="new_ocupation">Ocupación: <span class="red-color">
                                                    *</span></label>
                                            <input class="form-control form-disabled" type="text" name="new_ocupation"
                                                id="new_ocupation" value="{{ $Personal->ocupacion }}">
                                            <span class="text-danger fw-normal" style=" display: none;">Ocupación no
                                                válida.</span>
                                        </div>
                                    @endrole
                                </div>

                                <div class="form-group col-md-6 col-sm-12 pt-2">
                                    <p class="fw-bold mb-0">Religion</p>
                                    <div class="mt-0 W-data" id="religion"> {{ $Personal->religion }} </div>
                                    @role('Administrador')
                                        <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                            <label for="new_religion">Religion: <span class="red-color"> *</span></label>
                                            <input class="form-control form-disabled" type="text" name="new_religion"
                                                id="new_religion" value="{{ $Personal->religion }}">
                                            <span class="text-danger fw-normal" style=" display: none;">Religión no
                                                válido.</span>
                                        </div>
                                    @endrole
                                </div>

                            </div>
                        </li>
                    </ul>

                    {{-- CONTACTO DE EMERGENCIA  --}}
                    <h5 class="mt-4 aling-items-center">
                        <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 24 24">
                                <path fill="#BE3144"
                                    d="M5 20v-2h1.6L9 10h6l2.4 8H19v2zm3.7-2h6.6l-1.8-6h-3zM11 8V3h2v5zm5.95 2.475L15.525 9.05l3.55-3.525l1.4 1.4zM18 15v-2h5v2zM7.05 10.475l-3.525-3.55l1.4-1.4l3.55 3.525zM1 15v-2h5v2zm11 3" />
                            </svg>
                        </span> Contacto de emergencia
                    </h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-start pt-0">
                            <div class="form-group col-12 pt-2">
                                <p class="fw-bold mb-0">Nombre del contacto:</p>
                                <div class="mt-0 W-data" id="name_e"> {{ $Personal->contacto_emerge }} </div>
                                @role('Administrador')
                                    <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                        <label for="new_name_e">Nombre del contacto: <span class="red-color">
                                                *</span></label>
                                        <input class="form-control form-disabled" type="text" name="new_name_e"
                                            id="new_name_e" value="{{ $Personal->contacto_emerge }}">
                                        <span class="text-danger fw-normal" style=" display: none;">Nombre no
                                            válido.</span>
                                    </div>
                                @endrole
                            </div>
                        </li>
                        <li class="list-group-item pt-0">
                            <div class="row mb-3">
                                <div class="form-group col-md-6 col-sm-12 pt-2">
                                    <p class="fw-bold mb-0">Teléfono:</p>
                                    <div class="mt-0 W-data" id="tel_e"> {{ $Personal->telefono_emerge }}
                                    </div>
                                    @role('Administrador')
                                        <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                            <label for="new_tel_e">Teléfono: <span class="red-color">
                                                    *</span></label>
                                            <input class="form-control form-disabled" type="text" name="new_tel_e"
                                                id="new_tel_e" value="{{ $Personal->telefono_emerge }}" maxlength="10">
                                            <span class="text-danger fw-normal" style=" display: none;">Teléfono no
                                                válido.</span>
                                        </div>
                                    @endrole
                                </div>
                                <div class="form-group col-md-6 col-sm-12 pt-2 ">
                                    <p class="fw-bold mb-0">Parentesco:</p>
                                    <div class="mt-0 W-data" id="parent_e"> {{ $Personal->parentesco_emerge }}
                                    </div>
                                    @role('Administrador')
                                        <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                            <label for="new_parent_e">Parentesco: <span class="red-color">
                                                    *</span></label>
                                            <input class="form-control form-disabled" type="text" name="new_parent_e"
                                                id="new_parent_e" value="{{ $Personal->parentesco_emerge }}">
                                            <span class="text-danger fw-normal" style=" display: none;">Parentesco no
                                                válido.</span>
                                        </div>
                                    @endrole
                                </div>
                            </div>
                        </li>
                    </ul>

                </div>
            </div> {{-- Contenedor deL lado izquierdo  --}}

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="row form-group px-2">
                    <span class="d-none" id="id_dom"> {{ $Personal->domicilio_id }}</span>
                    <h5 class="mb-2 aling-items-center">
                        <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 16 16">
                                <g fill="rgb(19, 87, 78)">
                                    <path
                                        d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207l-5 5V13.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 2 13.5V8.207l-.646.647a.5.5 0 1 1-.708-.708z" />
                                    <path
                                        d="M16 12.5a3.5 3.5 0 1 1-7 0a3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1.5a.5.5 0 1 0 1 0V11a.5.5 0 0 0-.5-.5m0 4a.5.5 0 1 0 0-1a.5.5 0 0 0 0 1" />
                                </g>
                            </svg>
                        </span>
                        Domicilio del paciente
                    </h5>
                    <ul class="list-group">
                        <li class="list-group-item pt-0">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12 pt-2">
                                    <p class="fw-bold mb-0">Pais:</p>
                                    <div class="mt-0 W-data" id="country"> {{ $domicilio->pais }}</div>
                                    @role('Administrador')
                                        <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                            <label for="new_country">País: <span class="red-color">
                                                    *</span></label>
                                            <input class="form-control form-disabled" type="text" name="new_country"
                                                id="new_country" value="{{ $domicilio->pais }}">
                                            <span class="text-danger fw-normal" style=" display: none;">País no
                                                válido.</span>
                                        </div>
                                    @endrole
                                </div>
                                <div class="form-group col-md-6 col-sm-12 pt-2">
                                    <p class="fw-bold mb-0">Estado:</p>
                                    <div class="mt-0 W-data">
                                        {{ $domicilio->rep_estado->nombre ?? '--' }} </div>
                                    <div class="mt-0 d-none" id="state">
                                        {{ $domicilio->rep_estado->id_estado }} </div>
                                    @role('Administrador')
                                        <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                            <label for="new_state">Estado: <span class="red-color">
                                                    *</span></label>
                                            @php
                                                $selected = $domicilio->rep_estado->id_estado ?? '';
                                            @endphp

                                            <select class="form-control" id="new_state" name="new_state">
                                                @foreach ($rep_estados as $estados)
                                                    <option value="{{ $estados['id_estado'] }}"
                                                        {{ $selected == $estados['id_estado'] ? 'selected' : '' }}>
                                                        {{ $estados['nombre'] }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <span class="text-danger fw-normal" style=" display: none;">Estado no
                                                válido.</span>
                                        </div>
                                    @endrole
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start pt-0">
                            <div class="form-group col-12 pt-2">
                                <p class="fw-bold mb-0">Ciudad o municipio:</p>
                                <div class="mt-0 W-data" id="city"> {{ $domicilio->cuidad_municipio ?? '--' }}
                                </div>
                                @role('Administrador')
                                    <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                        <label for="new_city">Ciudad o municipio: <span class="red-color">
                                                *</span></label>
                                        <input class="form-control form-disabled" type="text" name="new_city"
                                            id="new_city" value="{{ $domicilio->cuidad_municipio }}">
                                        <span class="text-danger fw-normal" style=" display: none;">Ciudad no
                                            válida.</span>
                                    </div>
                                @endrole
                            </div>
                        </li>
                        <li class="list-group-item pt-0">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12 pt-2">
                                    <p class="fw-bold mb-0">Colonia:</p>
                                    <div class="mt-0 W-data" id="colony"> {{ $domicilio->colonia ?? '--' }}</div>
                                    @role('Administrador')
                                        <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                            <label for="new_colony">Colonia: <span class="red-color">
                                                    *</span></label>
                                            <input class="form-control form-disabled" type="text" name="new_colony"
                                                id="new_colony" value="{{ $domicilio->colonia }}">
                                            <span class="text-danger fw-normal" style=" display: none;">Colonia no
                                                válida.</span>
                                        </div>
                                    @endrole
                                </div>
                                <div class="form-group col-md-6 col-sm-12 pt-2 div-cedula">
                                    <p class="fw-bold mb-0">Código postal:</p>
                                    <div class="mt-0 W-data" id="cp"> {{ $domicilio->cp ?? '--' }} </div>
                                    @role('Administrador')
                                        <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                            <label for="new_cp">Código postal: <span class="red-color">
                                                    *</span></label>
                                            <input class="form-control form-disabled" type="text" name="new_cp"
                                                id="new_cp" value="{{ $domicilio->cp }}">
                                            <span class="text-danger fw-normal" style=" display: none;">Código postal no
                                                válida.</span>
                                        </div>
                                    @endrole
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start pt-0">
                            <div class="form-group col-12 pt-2">
                                <p class="fw-bold mb-0">Calle:</p>
                                <div class="mt-0 W-data" id="street"> {{ $domicilio->calle ?? '--' }} </div>
                                @role('Administrador')
                                    <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                        <label for="new_street">Calle: <span class="red-color">
                                                *</span></label>
                                        <input class="form-control form-disabled" type="text" name="new_street"
                                            id="new_street" value="{{ $domicilio->calle }}">
                                        <span class="text-danger fw-normal" style=" display: none;">Calle no
                                            válida.</span>
                                    </div>
                                @endrole
                            </div>
                        </li>
                        <li class="list-group-item pt-0">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12 pt-2">
                                    <p class="fw-bold mb-0">Num. exterior:</p>
                                    <div class="mt-0 W-data" id="ext"> {{ $domicilio->num ?? '--' }}</div>
                                    @role('Administrador')
                                        <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                            <label for="new_ext">Num. exterior: <span class="red-color">
                                                    *</span></label>
                                            <input class="form-control form-disabled" type="text" name="new_ext"
                                                id="new_ext" value="{{ $domicilio->num }}">
                                            <span class="text-danger fw-normal" style=" display: none;">Num. exterior no
                                                válida.</span>
                                        </div>
                                    @endrole
                                </div>
                                <div class="form-group col-md-6 col-sm-12 pt-2">
                                    <p class="fw-bold mb-0">Num. interior:</p>
                                    <div class="mt-0 W-data" id="int"> {{ $domicilio->num_int ?? '--' }} </div>
                                    @role('Administrador')
                                        <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                            <label for="new_int">Num. exterior: </label>
                                            <input class="form-control form-disabled" type="text" name="new_int"
                                                id="new_int" value="{{ $domicilio->num_int }}">
                                            <span class="text-danger fw-normal" style=" display: none;">Num. interior no
                                                válida.</span>
                                        </div>
                                    @endrole
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- Botones  --}}

            @role('Administrador')
                <div class="col-12 p-0 mt-2 personal-data d-none animate__animated animate__fadeInUp">
                    <div class="row">
                        <div class="d-flex justify-content-end gap-2">
                            <div class="">
                                <x-button-custom type="button"
                                    class="btn-red  justify-content-center justify-content-lg-start" text="Cancelar"
                                    id="cancel_PD" tooltipText="Cancelar edición.">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M3.47 3.47a.75.75 0 0 1 1.06 0L8 6.94l3.47-3.47a.75.75 0 1 1 1.06 1.06L9.06 8l3.47 3.47a.75.75 0 1 1-1.06 1.06L8 9.06l-3.47 3.47a.75.75 0 0 1-1.06-1.06L6.94 8L3.47 4.53a.75.75 0 0 1 0-1.06"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </x-slot>
                                </x-button-custom>
                            </div>
                            <div class="">
                                <x-button-custom type="button"
                                    class="btn-blue-sec justify-content-center justify-content-lg-start" text="Guardar"
                                    id="savePD" tooltipText="Guardar cambios.">
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
                    </div>
                </div>
            @endrole
        </div>
    </div>
    {{-- Modal para editar los datos del usuario --}}
</div>
