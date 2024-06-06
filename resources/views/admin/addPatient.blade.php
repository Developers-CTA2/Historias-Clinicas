@extends('admin.layouts.main')

@section('title', 'Agregar nuevo paciente')

@section('viteConfig')
    @vite(['resources/sass/add-patients.scss', 'resources/sass/form-style.scss', 'resources/sass/main.scss', 'resources/sass/steps-bar.scss'])
@endsection


@section('content')


    {{-- Select type Person --}}
    <div class="container max-w-custom" id="containerPersonSelect">
        <div class="row d-flex justify-content-center gap-3">
            <div class="col-2 d-flex flex-column align-items-center bg-content-custom shadow-custom text-center py-3 card-hover"
                id="udgPerson">
                <div class="bg-avatar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                        <g fill="#000000">
                            <path
                                d="M12.486 5.414a1 1 0 0 0-.972 0L5.06 9l6.455 3.586a1 1 0 0 0 .972 0L18.94 9l-6.455-3.586zm-1.943-1.749a3 3 0 0 1 2.914 0l8.029 4.46a1 1 0 0 1 0 1.75l-8.03 4.46a3 3 0 0 1-2.913 0l-8.029-4.46a1 1 0 0 1 0-1.75l8.03-4.46z" />
                            <path
                                d="M21 8a1 1 0 0 1 1 1v7a1 1 0 1 1-2 0V9a1 1 0 0 1 1-1zM6 10a1 1 0 0 1 1 1v5.382l4.553 2.276a1 1 0 0 0 .894 0L17 16.382V11a1 1 0 1 1 2 0v6a1 1 0 0 1-.553.894l-5.105 2.553a3 3 0 0 1-2.684 0l-5.105-2.553A1 1 0 0 1 5 17v-6a1 1 0 0 1 1-1z" />
                        </g>
                    </svg>
                </div>
                <h4 class="fw-bold title-size-sm mt-2">Perteneciente UDG</h4>
            </div>
            <div class="col-2 d-flex flex-column align-items-center bg-content-custom shadow-custom text-center py-3 card-hover"
                id="externalPerson">
                <div class="bg-avatar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                        <path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M3 21h18M5 21V7l8-4v18m6 0V11l-6-4M9 9v.01M9 12v.01M9 15v.01M9 18v.01" />
                    </svg>
                </div>
                <h4 class="fw-bold title-size-sm mt-2">Externos</h4>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-3 animate__animated animate__fadeInUp d-none"
            id="containerUdgPerson">
            <div class="col-4 bg-content-custom shadow-custom px-2 py-3">
                {{-- Alert for errors o no found code --}}
                <div class="alert text-center d-none" id="alertCodePerson" role="alert"></div>
                <div class="mb-3">
                    <label for="code" class="form-label">Código</label>
                    <input type="text" class="form-control" id="code" placeholder="216610402" autocomplete="false">
                </div>
                <div id="containerDataPerson" class="d-none animate__animated animate__fadeInUp">
                    <ul class="list-group mb-2">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Nombre</div>
                                <span> - </span>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Carrera / Puesto</div>
                                <span> - </span>
                            </div>
                        </li>
                    </ul>

                    <div class="d-flex justify-content-center mt-3">
                        <button class="w-full btn btn-primary" id="nextPersonUdg">Continuar</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row m-0 d-none max-w-custom" id="containerFatherForm">
        <div>
            <h4 class="fw-bold">Dar de alta a un paciente</h4>
            <h6>Ingresa los datos correspondientes del paciente</h6>
        </div>

        <div class="row justify-content-center px-0 d-flex justify-content-center">

            {{-- Steps progress --}}
            <div class="row">
                <div class="col-12 content-custom person-data bg-content-custom shadow-custom px-2 py-3">
                    <div class="row mb-3 px-3 line-progress-step d-flex justify-content-center mt-3">
                        <div class="col-2 p-0">
                            <div class="step-group d-flex flex-column align-items-center">
                                <div class="step-progress">
                                    <span class="step-circle active">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24">
                                            <path fill="#ffffff"
                                                d="m10.6 13.8l-2.15-2.15q-.275-.275-.7-.275t-.7.275t-.275.7t.275.7L9.9 15.9q.3.3.7.3t.7-.3l5.65-5.65q.275-.275.275-.7t-.275-.7t-.7-.275t-.7.275zM12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="text-center">
                                    <p>Datos <br />Personales</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-2 p-0">
                            <div class="step-group d-flex flex-column align-items-center">
                                <div class="step-progress">
                                    <span class="step-circle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24">
                                            <path fill="#ffffff"
                                                d="m10.6 13.8l-2.15-2.15q-.275-.275-.7-.275t-.7.275t-.275.7t.275.7L9.9 15.9q.3.3.7.3t.7-.3l5.65-5.65q.275-.275.275-.7t-.275-.7t-.7-.275t-.7.275zM12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="text-center">
                                    <p>Antecedentes <br /> heredofamiliares</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-2 p-0">
                            <div class="step-group d-flex flex-column align-items-center">
                                <div class="step-progress">
                                    <span class="step-circle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24">
                                            <path fill="#ffffff"
                                                d="m10.6 13.8l-2.15-2.15q-.275-.275-.7-.275t-.7.275t-.275.7t.275.7L9.9 15.9q.3.3.7.3t.7-.3l5.65-5.65q.275-.275.275-.7t-.275-.7t-.7-.275t-.7.275zM12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="text-center">
                                    <p>Antecendentes <br />no patológicos</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-2 p-0">
                            <div class="step-group d-flex flex-column align-items-center">
                                <div class="step-progress">
                                    <span class="step-circle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24">
                                            <path fill="#ffffff"
                                                d="m10.6 13.8l-2.15-2.15q-.275-.275-.7-.275t-.7.275t-.275.7t.275.7L9.9 15.9q.3.3.7.3t.7-.3l5.65-5.65q.275-.275.275-.7t-.275-.7t-.7-.275t-.7.275zM12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="text-center">
                                    <p>Antecedentes <br />patológicos</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-2 p-0">
                            <div class="step-group d-flex flex-column align-items-center">
                                <div class="step-progress">
                                    <span class="step-circle"></span>
                                </div>
                                <div class="text-center">
                                    <p>Ginecología <br />Obstetricia</p>
                                </div>
                            </div>
                        </div>


                    </div>

                    {{-- Form Container --}}

                    <div class="row mt-2 d-none form-step animate__animated animate__fadeInUp">
                        <div class="hr-custom mb-2"></div>
                        <h4 class="text-center fw-bold title-size-sm">Datos personales</h4>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <div class="row pt-2">
                                            <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                                                <label for="codigo"><span class="required-point">*</span>
                                                    Código:</label>
                                                <input class="form-control" type="text" id="codigo" name="codigo"
                                                    maxlength="7">
                                                <span class="text-danger fw-normal d-none">Código no válido.</span>
                                            </div>

                                            <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                                                <label for="gender"><span class="required-point">*</span>
                                                    Género:</label>
                                                <select class="form-control" name="gender" id="gender">
                                                    <option value="" disabled selected>Seleccione una opción</option>
                                                    <option value="1">Masculino</option>
                                                    <option value="2">Femenino</option>
                                                </select>
                                                <span class="text-danger fw-normal d-none"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group pt-2 col-12 mb-2 group-custom">
                                        <label for="name_P"><span class="required-point">*</span> Nombre
                                            Completo:</label>
                                        <input class="form-control" type="text" name="name_P" id="name_P"
                                            oninput="this.value = this.value.toUpperCase()" />
                                        <span class="text-danger fw-normal d-none"></span>

                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="row pt-2">
                                            <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                                                <label for="F_nacimiento"><span class="required-point">*</span> Fecha de
                                                    nacimiento</label>
                                                <input type="date" id="F_nacimiento" name="F_nacimiento"
                                                    class="form-control" />
                                                <span class="text-danger fw-normal d-none"></span>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                                                <label for="T_sangre"> <span class="required-point">*</span>Tipo de
                                                    sangre</label>
                                                <select class="form-control" name="T_sangre" id="T_sangre">
                                                    <option value="" disabled selected>Seleccione una opción</option>
                                                    <option value="1">Grupo A Rh positivo (A+)</option>
                                                    <option value="2">Grupo A Rh negativo (A-)</option>
                                                    <option value="3">Grupo B Rh positivo (B+)</option>
                                                    <option value="4">Grupo B Rh negativo (B-)</option>
                                                    <option value="5">Grupo AB Rh positivo (AB+)</option>
                                                    <option value="6">Grupo AB Rh negativo (AB-)</option>
                                                    <option value="7">Grupo O Rh positivo (O+)</option>
                                                    <option value="8">Grupo O Rh negativo (O-)</option>
                                                </select>
                                                <span class="text-danger fw-normal d-none"></span>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="hr-custom"></div>
                                    <h4 class="text-center pt-3 fw-bold title-size-sm">Domicilio</h4>
                                    <div class="form-group">
                                        <div class="row pt-2">
                                            <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                                                <label for="estado"><span class="required-point">*</span>
                                                    Estado:</label>
                                                <input class="form-control" type="text" id="estado"
                                                    name="estado">
                                                <span class="text-danger fw-normal d-none"></span>
                                            </div>

                                            <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                                                <label for="ciudad"><span class="required-point">*</span>
                                                    Ciudad:</label>
                                                <input class="form-control" type="text" id="ciudad"
                                                    name="ciudad">
                                                <span class="text-danger fw-normal d-none"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row pt-2">
                                            <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                                                <label for="calle"><span class="required-point">*</span> Calle</label>
                                                <input type="text" id="calle" name="calle"
                                                    class="form-control" />
                                                <span class="text-danger fw-normal d-none"></span>

                                            </div>
                                            <div class="form-group col-md-3 col-sm-8 mb-2 group-custom">
                                                <label for="sangre"><span class="required-point">*</span> Num </label>
                                                <input type="number" id="num" name="num" min="1"
                                                    class="form-control" />
                                                <span class="text-danger fw-normal d-none"></span>
                                            </div>
                                            <div class="form-group col-md-3 col-sm-8 mb-2 ">
                                                <label for="num_int">Num. Int </label>
                                                <input type="number" id="num_int" name="num_int" min="0"
                                                    class="form-control" />
                                                <span class="text-danger fw-normal d-none"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <div class="row pt-2">
                                            <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                                                <label for="telefono"><span class="required-point">*</span> Teléfono:
                                                </label>
                                                <input type="text" id="telefono" name="telefono"
                                                    class="form-control" maxlength="10" />
                                                <span class="text-danger fw-normal d-none"></span>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                                                <label for="nss"><span class="required-point">*</span> NSS:</label>
                                                <input class="form-control" type="text" id="nss" maxlength="11"
                                                    name="nss">
                                                <span class="text-danger fw-normal d-none"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row pt-2">
                                            <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                                                <label for="E_civil"><span class="required-point">*</span> Estado
                                                    civil:</label>
                                                <select class="form-control" name="E_civil" id="E_civil">
                                                    <option value="" disabled selected>Seleccione una opción</option>
                                                    <option value="1">Soltero(a)</option>
                                                    <option value="2">Casado(a)</option>
                                                    <option value="3">Viudo(a)</option>
                                                    <option value="4">Divorciado(a)</option>
                                                    <option value="5">Separado(a)</option>
                                                </select>
                                                <span class="text-danger fw-normal d-none"></span>

                                            </div>

                                            <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                                                <label for="religion"><span class="required-point">*</span>
                                                    Religión:</label>
                                                <input class="form-control" type="text" id="religion"
                                                    name="religion">
                                                <span class="text-danger fw-normal d-none"></span>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-2 mb-4">
                                        <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                                            <label for="Puesto"><span class="required-point">*</span>
                                                Carrera/Puesto:</label>
                                            <input class="form-control" type="text" id="Puesto" name="puesto">
                                            <span class="text-danger fw-normal d-none"></span>

                                        </div>
                                    </div>
                                    <div class="hr-custom"></div>
                                    <h4 class="text-center pt-3 fw-bold title-size-sm">Contacto de emergencia</h4>
                                    <div class="form-group">
                                        <div class="row pt-2">
                                            <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                                                <label for="nombre_e"><span class="required-point">*</span>
                                                    Nombre:</label>
                                                <input class="form-control" type="text" id="nombre_e"
                                                    name="nombre_e">
                                                <span class="text-danger fw-normal d-none"></span>

                                            </div>

                                            <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                                                <label for="telefono_e"><span class="required-point">*</span>
                                                    Telefono:</label>
                                                <input class="form-control" type="text" id="telefono_e"
                                                    name="telefono_e" maxlength="10">
                                                <span class="text-danger fw-normal d-none"></span>
                                            </div>

                                            <div class="form-group col-md-6 col-sm-12 mb-2 pt-md-2 group-custom">
                                                <label for="parentesco"><span class="required-point">*</span>
                                                    Parentesco:</label>
                                                <input class="form-control" type="text" id="parentesco"
                                                    name="parentesco">
                                                <span class="text-danger fw-normal d-none"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Datos AHF  -->
                    <div class="row pb-3 mt-4 ahf-data d-none form-step animate__animated animate__fadeInUp">
                        <div class="row pt-1">
                            <div class="col-12 content-custom">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="row d-flex justify-content-center">
                                                    <h5 class="md-w-custom text-center text-lg-start">Tipo</h5>
                                                </div>
                                                <div class="hr-custom"></div>
                                                <div class="form-group">
                                                    <div class="row pt-2 d-flex justify-content-center">
                                                        <div class="form-group md-w-custom">
                                                            <label for="tipo_AHF"><span class="required-point">*</span>
                                                                Tipo AHF:</label>
                                                            <select class="form-control" name="tipo_AHF" id="tipo_AHF">
                                                                <option value="0" disabled selected>Seleccione una
                                                                    opción</option>
                                                                @foreach ($tipos_ahf as $tipo_ahf)
                                                                    <option value="{{ $tipo_ahf->id_tipo_ahf }}">{{ $tipo_ahf->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger fw-normal"></span>
                                                        </div>

                                                        <div class="form-group md-w-custom mt-3" id="enfermedad-container">
                                                            <label for="enfermedad" ><span class="required-point">*</span> Enfermedad</label>
                                                            <select class="form-control" name="enfermedad"
                                                                id="enfermedad">
                                                                <option value="0" disabled selected>Seleccione
                                                                    una opción
                                                                </option>
                                                            </select>
                                                            <span class="text-danger fw-normal d-none"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- FIN contenedor 1  -->
                                            <div class="col-lg-6 col-sm-12 mt-lg-0 mt-4">
                                                <h5 class="text-center">Enfermedades seleccionadas</h5>
                                                <div class="hr-custom"></div>
                                                <div class="row d-flex justify-content-center justify-content-lg-start mt-3">
                                                    <div class="form-group container-list-custom"
                                                        id="enfermedades-seleccionadas">
                                                        <!-- Aquí se mostrarán las enfermedades seleccionadas -->
                                                    </div>
                                                </div>
                                            </div><!-- Fin de contenedor 2 -->
                                            <!-- Fin de contenedor 3 -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- APNP Data --}}

                    <!-- Datos APNP  -->
                    <div class="row pb-3 mt-4 apnp-data d-none form-step animate__animated animate__fadeInUp">
                        <div class="row pt-1">
                            <div class="col-12 content-custom">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <h5>Toxicomanias</h5>
                                                <div class="form-group">
                                                    <div class="row pt-2">
                                                        <div class="form-group col-md-8 col-sm-12 mb-4">
                                                            <select class="form-control" name="toxico" id="toxico">
                                                                <option value="" disabled selected>Seleccione una
                                                                    opción</option>
                                                                @foreach ($toxicomania as $toxicomania)
                                                                    <option value="{{ $toxicomania->id }}">
                                                                        {{ $toxicomania->nombre }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger fw-normal"
                                                                style=" display: none;">Toxicomanias
                                                                no válido.</span>
                                                        </div>
                                                        <h5>Alimentación</h5>
                                                        <div class="form-group">
                                                            <div class="row pt-2">
                                                                <div class="form-group col-md-8 col-sm-12 mb-2">
                                                                    <textarea class="form-control" aria-label="With textarea"></textarea>
                                                                    <span class="text-danger fw-normal"
                                                                        style=" display: none;">Campo
                                                                        no válido.</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- FIN contenedor 1  -->
                                            <div class="col-lg-6 col-md-6 col-sm-12 d-none">
                                                <h5>Toxicomanias</h5>
                                                <div class="form-group">
                                                    <div class="row pt-2">
                                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                                            <label for="ccantidad_toxi">Cantidad:</label>
                                                            <input class="form-control" type="text" id="cantidad_toxi"
                                                                name="cantidad_toxi">
                                                            <span class="text-danger fw-normal"
                                                                style=" display: none;">Cantidad no
                                                                válido.</span>

                                                        </div>

                                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                                            <label for="desde_toxi">Desde cuando:</label>
                                                            <input class="form-control" type="text" id="desde_toxi"
                                                                name="desde_toxi">
                                                            <span class="text-danger fw-normal"
                                                                style=" display: none;">Dato no
                                                                válida.</span>
                                                        </div>
                                                    </div>
                                                    <div class="text-center"> <!-- Agregado para centrar el botón -->
                                                        <button class="btn btn-primary" id="guardar_toxi">Guardar</button>
                                                    </div>
                                                </div>
                                            </div><!-- Fin de contenedor 2 -->
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <h5>Toxicomanias seleccionadas</h5>
                                                <div class="form-group" id="toxicomanias-seleccionadas">
                                                    <!-- Aquí se mostrarán las enfermedades seleccionadas -->
                                                </div>
                                            </div>
                                            <!-- Fin de contenedor 3 -->
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- APP Data --}}
                    <div class="row form-step d-none animate__animated animate__fadeInUp">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <h5>Hospitalizaciones recientes</h5>
                            <div class="form-group">
                                <div class="row pt-2">
                                    <label for="Hospitalizaciones">Selecciona:</label>
                                    <div class="form-group col-md-6 col-sm-12 mb-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="respuesta_H"
                                                id="si_H" value="si">
                                            <label class="form-check-label" for="si_H">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="respuesta_H"
                                                id="no_H" value="no">
                                            <label class="form-check-label" for="no_H">No</label>
                                        </div>
                                        <span class="text-danger fw-normal" style=" display: none;">Dato no
                                            válido.</span>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12 mb-2">
                                        <label for="fecha_H">Fecha:</label>
                                        <input class="form-control" type="date" name="fecha_H" id="fecha_H">
                                        <span class="text-danger fw-normal" style=" display: none;">Fecha no
                                            válida.</span>

                                    </div>
                                    <div class="form-group col-12">
                                        <label for="motivo_H">Motivo</label>
                                        <input class="form-control" type="text" name="motivo_H" id="motivo_H">
                                        <span class="text-danger fw-normal" style=" display: none;">Motivo no
                                            válido.</span>

                                    </div>
                                    <h5>Cirugías</h5>
                                    <div class="form-group">
                                        <div class="row pt-2">
                                            <label for="Cirugias">Selecciona:</label>
                                            <div class="form-group col-md-6 col-sm-12 mb-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_C"
                                                        id="si_C" value="si">
                                                    <label class="form-check-label" for="si_C">Sí</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_C"
                                                        id="no_C" value="no">
                                                    <label class="form-check-label" for="no_C">No</label>
                                                </div>
                                                <span class="text-danger fw-normal" style=" display: none;">Dato
                                                    no válido.</span>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12 mb-2">
                                                <label for="fecha_C">Fecha:</label>
                                                <input class="form-control" type="date" name="fecha_C"
                                                    id="fecha_C">
                                                <span class="text-danger fw-normal" style=" display: none;">Fecha
                                                    no válida.</span>

                                            </div>
                                            <div class="form-group col-12">
                                                <label for="motivo_C">Motivo</label>
                                                <input class="form-control" type="text" name="motivo_C"
                                                    id="motivo_C">
                                                <span class="text-danger fw-normal" style=" display: none;">Motivo
                                                    no válido.</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- FIN contenedor 1  -->
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <h5>Transfusiones</h5>
                            <div class="form-group">
                                <div class="row pt-2">
                                    <label for="Transfusiones">Selecciona:</label>
                                    <div class="form-group col-md-6 col-sm-12 mb-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="respuesta_TF"
                                                id="si_TF" value="si">
                                            <label class="form-check-label" for="si_TF">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="respuesta_TF"
                                                id="no_TF" value="no">
                                            <label class="form-check-label" for="no_TF">No</label>
                                        </div>
                                        <span class="text-danger fw-normal" style=" display: none;">Dato no
                                            válido.</span>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12 mb-2">
                                        <label for="fecha_TF">Fecha:</label>
                                        <input class="form-control" type="date" name="fecha_TF" id="fecha_TF">
                                        <span class="text-danger fw-normal" style=" display: none;">Fecha no
                                            válida.</span>

                                    </div>
                                    <div class="form-group col-12">
                                        <label for="motivo_TF">Motivo</label>
                                        <input class="form-control" type="text" name="motivo_TF" id="motivo_TF">
                                        <span class="text-danger fw-normal" style=" display: none;">Motivo no
                                            válido.</span>

                                    </div>
                                    <h5>Traumatismos</h5>
                                    <div class="form-group">
                                        <div class="row pt-2">
                                            <label for="Traumatismos">Selecciona:</label>
                                            <div class="form-group col-md-6 col-sm-12 mb-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_TU"
                                                        id="si_TU" value="si">
                                                    <label class="form-check-label" for="si_TU">Sí</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="respuesta_TU"
                                                        id="no_TU" value="no">
                                                    <label class="form-check-label" for="no_TU">No</label>
                                                </div>
                                                <span class="text-danger fw-normal" style=" display: none;">Dato
                                                    no válido.</span>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12 mb-2">
                                                <label for="fecha_TU">Fecha:</label>
                                                <input class="form-control" type="date" name="fecha_TU"
                                                    id="fecha_TU">
                                                <span class="text-danger fw-normal" style=" display: none;">Fecha
                                                    no válida.</span>

                                            </div>
                                            <div class="form-group col-12">
                                                <label for="motivo_C">Motivo</label>
                                                <input class="form-control" type="text" name="motivo_TU"
                                                    id="motivo_TU">
                                                <span class="text-danger fw-normal" style=" display: none;">Motivo
                                                    no válido.</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Fin de contenedor 2 -->
                        <!-- Fin de contenedor 3 -->
                    </div>

                    <div class="row form-step d-none animate__animated animate__fadeInUp">
                        <h3>Hola mundo</h3>
                    </div>




                    <div class="row mt-3 justify-content-end text-end">
                        <div class="col-6">
                            <button type="button" class="btn btn-secondary-custom" id="prevStep">Regresar</button>
                            <button type="button" class="btn btn-primary" id="nextStep">Siguiente</button>
                            <button type="button" class="btn btn-primary d-none" id="sendForm">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <!-- Formulario para los datos APP  -->
        {{-- <div class="row pb-3 mt-4 job-data d-none form-step animate__animated animate__fadeInUp">
            <div class="row pt-1">
                <div class="col-12 content-custom">

                    <div class="row">
                        <div class="col-12">
                            
                            <div class="row mt-3 justify-content-end text-end">
                                <div class="col-6">
                                    <button class="btn button-eliminar" id="personal-atras"> Atras</button>
                                    <button class="btn fst-italic animated-icon btn-primary"
                                        id="confirm-register">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}


    </div>

@endsection


@section('scripts')
    @vite(['resources/js/loading-screen.js', 'resources/js/SideBar.js', 'resources/js/addPatients.js'])

@endsection
