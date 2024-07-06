<div class="card">
    <div class="card-header text-center bg-blue">
        Datos personales
    </div>
    <div class="card-body">
        <div class="row col-12 m-0 p-0 cont-start">

            @role('Administrador')
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="p-0 m-0  personal-data d-none animate__animated animate__fadeInUp">
                            <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between p-0 m-0"
                                role="alert">
                                <p class="p-2 mb-0 me-3 text-alert">
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="toggle tooltip-container">
                        <input type="checkbox" id="Edit-personal">
                        <label for="Edit-personal" class="label-check"></label>
                        <span class="tooltip-text">Habilitar edición.</span>
                    </div>
                </div>
            @endrole
            <div class="col-lg-6 col-md-6 col-sm-12 top-content">
                <div class="form-group px-2">
                    <div class="row">
                        <div class="form-group col-12 pt-2">
                            <p class="fw-bold mb-0">Nombre completo:</p>
                            <div class="mt-0" id="name"> {{ $Personal->nombre }}</div>

                            <div class="mt-2 mb-1 input-optional d-none animate__animated animate__fadeInUp">
                                <label for="new_name">Nombre completo: <span class="red-color"> *</span></label>
                                <input class="form-control form-disabled" type="text" name="new_name" id="new_name"
                                    value="{{ $Personal->nombre }}">
                                <span class="text-danger fw-normal" style=" display: none;">Nombre no válido.</span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12 pt-2">
                                <p class="fw-bold mb-0">Código:</p>
                                <div class="mt-0" id="code"> {{ $Personal->codigo ?? '--' }} </div>

                                <div class="mt-2 mb-1 input-optional d-none animate__animated animate__fadeInUp">
                                    <label for="new_code">Código:</label>
                                    <div class="mt-0"> <s>Sin código </s></div>

                                </div>

                            </div>

                            <div class="form-group col-md-6 col-sm-12 pt-2 div-cedula">
                                <p class="fw-bold mb-0">Genero:</p>
                                <div class="mt-0" id="gender"> {{ $Personal->sexo }} </div>



                                <div class="mt-2 mb-1 input-optional d-none animate__animated animate__fadeInUp">
                                    {{-- <label for="new_gender">Genero: </label>
                                    <input class="form-control form-disabled" type="text" name="new_gender"
                                        id="new_gender" maxlength="9"> --}}

                                    <label for="new_gender">Genero: <span class="red-color"> *</span></label>
                                    @php
                                        $Male = $Personal->sexo == 'Masculino' ? 'selected' : '';
                                        $Female = $Personal->sex === 'Femenino' ? 'selected' : '';
                                    @endphp

                                    <select class="form-control" id="new_gender" name="new_gender">
                                        <option value="1" {{ $Male }}>Masculino</option>
                                        <option value="2" {{ $Female }}> Femenino </option>
                                    </select>

                                    <span class="text-danger fw-normal" style=" display: none;">Genero no válido.</span>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12 pt-2">
                                <p class="fw-bold mb-0">Teléfono:</p>
                                <div class="mt-0" id="tel"> {{ $Personal->telefono }} </div>


                                <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                    <label for="new_tel">Teléfono: <span class="red-color"> *</span></label>
                                    <input class="form-control form-disabled" type="text" name="new_tel"
                                        id="new_tel" value="{{ $Personal->telefono }}" maxlength="10">
                                    <span class="text-danger fw-normal" style=" display: none;">Teléfono no
                                        válida.</span>
                                </div>
                            </div>

                            <div class="form-group col-md-6 col-sm-12 pt-2">
                                <p class="fw-bold mb-0">F. nacimiento:</p>
                                @php
                                    use Carbon\Carbon;
                                @endphp
                                <div class="mt-0">
                                    {{ Carbon::parse($Personal->fecha_nacimiento)->locale('es')->isoFormat('LL') }}
                                </div>
                                <div class="mt-0 d-none" id="birthday"> {{ $Personal->fecha_nacimiento }} </div>



                                <div class="mt-2 mb-1 input-optional d-none animate__animated animate__fadeInUp">
                                    <label for="new_birthday">F. nacimiento: <span class="red-color"> *</span></label>
                                    <input class="form-control form-disabled" type="date" name="new_birthday"
                                        id="new_birthday" value="{{ $Personal->fecha_nacimiento }}">
                                    <span class="text-danger fw-normal" style=" display: none;">Fecha no
                                        válida.</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12 pt-2">
                                <p class="fw-bold mb-0">Ocupación:</p>
                                <div class="mt-0" id="ocupation"> {{ $Personal->ocupacion }} </div>


                                <div class="mt-2 mb-1 input-optional d-none animate__animated animate__fadeInUp">
                                    <label for="new_ocupation">Ocupación: <span class="red-color"> *</span></label>
                                    <input class="form-control form-disabled" type="text" name="new_ocupation"
                                        id="new_ocupation" value="{{ $Personal->ocupacion }}">
                                    <span class="text-danger fw-normal" style=" display: none;">Ocupación no
                                        válida.</span>
                                </div>

                            </div>

                            <div class="form-group col-md-6 col-sm-12 pt-2 div-cedula">
                                <p class="fw-bold mb-0">NSS:</p>
                                <div class="mt-0" id="nss"> {{ $Personal->nss }} </div>

                                <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                    <label for="new_nss">NSS: <span class="red-color"> *</span></label>
                                    <input class="form-control form-disabled" type="text" name="new_nss"
                                        id="new_nss" value="{{ $Personal->nss }}">
                                    <span class="text-danger fw-normal" style=" display: none;">NSS no
                                        válido.</span>
                                </div>
                            </div>
                        </div>


                        <div class="form-group col-12 pt-2">
                            <p class="fw-bold mb-0">Religion</p>
                            <div class="mt-0" id="religion"> {{ $Personal->religion }} </div>

                            <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                <label for="new_religion">Religion: <span class="red-color"> *</span></label>
                                <input class="form-control form-disabled" type="text" name="new_religion"
                                    id="new_religion" value="{{ $Personal->religion }}">
                                <span class="text-danger fw-normal" style=" display: none;">Religión no
                                    válido.</span>
                            </div>
                        </div>

                        <h5 class="mt-4 aling-items-center">
                            <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                    height="25" viewBox="0 0 24 24">
                                    <path fill="#BE3144"
                                        d="M5 20v-2h1.6L9 10h6l2.4 8H19v2zm3.7-2h6.6l-1.8-6h-3zM11 8V3h2v5zm5.95 2.475L15.525 9.05l3.55-3.525l1.4 1.4zM18 15v-2h5v2zM7.05 10.475l-3.525-3.55l1.4-1.4l3.55 3.525zM1 15v-2h5v2zm11 3" />
                                </svg>
                            </span> Contacto de emergencia
                        </h5>

                        <div class="form-group col-12 pt-2">
                            <p class="fw-bold mb-0">Nombre contacto:</p>
                            <div class="mt-0" id="name_e"> {{ $Personal->contacto_emerge }} </div>

                            <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                <label for="new_name_e">Nombre contacto: <span class="red-color"> *</span></label>
                                <input class="form-control form-disabled" type="text" name="new_name_e"
                                    id="new_name_e" value="{{ $Personal->contacto_emerge }}">
                                <span class="text-danger fw-normal" style=" display: none;">Nombre no
                                    válido.</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-group col-md-6 col-sm-12 pt-2">
                                <p class="fw-bold mb-0">Teléfono:</p>
                                <div class="mt-0" id="tel_e"> {{ $Personal->telefono_emerge }}</div>


                                <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                    <label for="new_tel_e">Teléfono: <span class="red-color">
                                            *</span></label>
                                    <input class="form-control form-disabled" type="text" name="new_tel_e"
                                        id="new_tel_e" value="{{ $Personal->telefono_emerge }}" maxlength="10">
                                    <span class="text-danger fw-normal" style=" display: none;">Teléfono no
                                        válido.</span>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 pt-2 ">
                                <p class="fw-bold mb-0">Parentesco:</p>
                                <div class="mt-0" id="parent_e"> {{ $Personal->parentesco_emerge }}</div>

                                <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                    <label for="new_parent_e">Parentesco: <span class="red-color">
                                            *</span></label>
                                    <input class="form-control form-disabled" type="text" name="new_parent_e"
                                        id="new_parent_e" value="{{ $Personal->parentesco_emerge }}">
                                    <span class="text-danger fw-normal" style=" display: none;">Parentesco no
                                        válido.</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div> {{-- Contenedor deñ lado izquierdo  --}}

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group px-2">
                    <div class="row">
                        <span class="mt-0 d-none" id="id_dom"> {{ $Personal->domicilio_id }}</span>

                        <h5 class="m-0 mt-3 aling-items-center">
                            <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                    height="25" viewBox="0 0 16 16">
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

                        <div class="form-group col-12 pt-2">

                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12 pt-2">
                                    <p class="fw-bold mb-0">Pais:</p>
                                    <div class="mt-0" id="country"> {{ $domicilio->pais }}</div>

                                    <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                        <label for="new_country">País: <span class="red-color">
                                                *</span></label>
                                        <input class="form-control form-disabled" type="text" name="new_country"
                                            id="new_country" value="{{ $domicilio->pais }}">
                                        <span class="text-danger fw-normal" style=" display: none;">País no
                                            válido.</span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-12 pt-2">
                                    <p class="fw-bold mb-0">Estado:</p>
                                    <div class="mt-0" id="state"> {{ $domicilio->estado ?? '--' }} </div>

                                    <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                        <label for="new_state">Estado: <span class="red-color">
                                                *</span></label>
                                        <input class="form-control form-disabled" type="text" name="new_state"
                                            id="new_state" value="{{ $domicilio->estado }}">
                                        <span class="text-danger fw-normal" style=" display: none;">Estado no
                                            válido.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-12 pt-2">
                                <p class="fw-bold mb-0">Ciudad o municipio:</p>
                                <div class="mt-0" id="city"> {{ $domicilio->cuidad_municipio ?? '--' }} </div>

                                <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                    <label for="new_city">Ciudad o municipio: <span class="red-color">
                                            *</span></label>
                                    <input class="form-control form-disabled" type="text" name="new_city"
                                        id="new_city" value="{{ $domicilio->cuidad_municipio }}">
                                    <span class="text-danger fw-normal" style=" display: none;">Ciudad no
                                        válida.</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12 pt-2">
                                    <p class="fw-bold mb-0">Colonia:</p>
                                    <div class="mt-0" id="colony"> {{ $domicilio->colonia ?? '--' }}</div>

                                    <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                        <label for="new_colony">Colonia: <span class="red-color">
                                                *</span></label>
                                        <input class="form-control form-disabled" type="text" name="new_colony"
                                            id="new_colony" value="{{ $domicilio->colonia }}">
                                        <span class="text-danger fw-normal" style=" display: none;">Colonia no
                                            válida.</span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-12 pt-2 div-cedula">
                                    <p class="fw-bold mb-0">Código postal:</p>
                                    <div class="mt-0" id="cp"> {{ $domicilio->cp ?? '--' }} </div>

                                    <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                        <label for="new_cp">Código postal: <span class="red-color">
                                                *</span></label>
                                        <input class="form-control form-disabled" type="text" name="new_cp"
                                            id="new_cp" value="{{ $domicilio->cp }}">
                                        <span class="text-danger fw-normal" style=" display: none;">Código postal no
                                            válida.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-12 pt-2">
                                <p class="fw-bold mb-0">Calle:</p>
                                <div class="mt-0" id="street"> {{ $domicilio->calle ?? '--' }} </div>

                                <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                    <label for="new_street">Calle: <span class="red-color">
                                            *</span></label>
                                    <input class="form-control form-disabled" type="text" name="new_street"
                                        id="new_street" value="{{ $domicilio->calle }}">
                                    <span class="text-danger fw-normal" style=" display: none;">Calle no
                                        válida.</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12 pt-2">
                                    <p class="fw-bold mb-0">Num. exterior:</p>
                                    <div class="mt-0" id="ext"> {{ $domicilio->num ?? '--' }}</div>

                                    <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                        <label for="new_ext">Num. exterior: <span class="red-color">
                                                *</span></label>
                                        <input class="form-control form-disabled" type="text" name="new_ext"
                                            id="new_ext" value="{{ $domicilio->num }}">
                                        <span class="text-danger fw-normal" style=" display: none;">Num. exterior no
                                            válida.</span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-12 pt-2 div-cedula">
                                    <p class="fw-bold mb-0">Num. interior:</p>
                                    <div class="mt-0" id="int"> {{ $domicilio->num_int ?? '--' }} </div>

                                    <div class="mt-2 mb-1 input-show d-none animate__animated animate__fadeInUp">
                                        <label for="new_int">Num. exterior: <span class="red-color">
                                                *</span></label>
                                        <input class="form-control form-disabled" type="text" name="new_int"
                                            id="new_int" value="{{ $domicilio->num_int }}">
                                        <span class="text-danger fw-normal" style=" display: none;">Num. interior no
                                            válida.</span>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>
            </div>
            {{-- Botones  --}}

            @role('Administrador')
                <div class="col-12 p-0 mt-2 personal-data d-none animate__animated animate__fadeInUp">
                    <div class="row">
                        <div class="d-flex justify-content-end gap-2">
                            <div class="">
                                <button class="btn-red fst-normal tooltip-container" type="button" id="cancel_PD">
                                    Cancelar
                                    <span class="tooltip-text">Cancelar edición.</span>
                                </button>
                            </div>
                            <div class="">
                                <button class="btn-blue-sec fst-normal tooltip-container" type="button" id="savePD">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
                                    </svg>
                                    Guardar
                                    <span class="tooltip-text">Editar datos.</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole
        </div>
    </div>
    {{-- Modal para editar los datos del usuario --}}
</div>
