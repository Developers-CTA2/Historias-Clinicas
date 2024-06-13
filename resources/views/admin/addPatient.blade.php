@extends('admin.layouts.main')

@section('title', 'Agregar nuevo paciente')

@section('viteConfig')
    @vite(['resources/sass/add-patients.scss', 'resources/sass/form-style.scss', 'resources/sass/main.scss', 'resources/sass/steps-bar.scss'])
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}">
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
                                                    <h5 class="md-w-custom text-center text-lg-start">Lista de enfermedades
                                                    </h5>
                                                </div>
                                                <div class="hr-custom"></div>
                                                <div class="form-group">
                                                    <div class="row pt-2 d-flex justify-content-center">

                                                        <div class="form-group md-w-custom mt-2"
                                                            id="enfermedad-container">
                                                            <label for="enfermedad" class="pb-1"><span
                                                                    class="required-point">*</span> Enfermedades</label>
                                                            <select class="form-control" name="enfermedad"
                                                                id="enfermedad">
                                                                <option value="0" selected>Seleccione una
                                                                    opción</option>
                                                                @if ($enfermedades->isEmpty())
                                                                    <option value="0" disabled selected>No hay
                                                                        enfermedades registradas</option>
                                                                @else
                                                                    @foreach ($enfermedades as $enfermedad)
                                                                        <option
                                                                            value="{{ $enfermedad->id_especifica_ahf }}">
                                                                            {{ $enfermedad->nombre }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            <span class="text-danger fw-normal d-none"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- FIN contenedor 1  -->
                                            <div class="col-lg-6 col-sm-12 mt-lg-0 mt-4">
                                                <h5 class="text-center">Enfermedades seleccionadas</h5>
                                                <div class="hr-custom"></div>
                                                <div
                                                    class="row d-flex justify-content-center justify-content-lg-start mt-3">
                                                    <div class="form-group container-list-custom">
                                                        <ul class="list-group mt-2 list-dependencies-custom"
                                                            id="listDiseasesSelected"></ul>
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
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="row d-flex justify-content-center">
                                                    <h5 class="md-w-custom text-center text-lg-start">Lista de toxicomanias
                                                    </h5>
                                                </div>
                                                <div class="hr-custom"></div>
                                                <div class="form-group">
                                                    <div class="row pt-2 d-flex flex-column align-items-center">
                                                        <div class="form-group md-w-custom mb-4">
                                                            <label for="enfermedad" class="pb-1"><span
                                                                    class="required-point">*</span> Toxicomanias</label>
                                                            <select class="form-control" name="toxico" id="toxico">
                                                                <option value="" disabled selected>Seleccione una
                                                                    opción</option>
                                                                @foreach ($toxicomania as $toxicomania)
                                                                    <option value="{{ $toxicomania->id }}">
                                                                        {{ $toxicomania->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger fw-normal mt-1"></span>
                                                        </div>

                                                        {{-- Section for dates and quantity smoking --}}
                                                        <section id="optionSmoking"
                                                            class="md-w-custom d-none animate__animated animate__fadeInUp">
                                                            <div class="form-group mb-2">
                                                                <label for="desdeCuando" class="pb-1"><span
                                                                        class="required-point">*</span>Número de
                                                                    cigarros</label>
                                                                <input class="form-control" type="number"
                                                                    id="cantidadCigarros" />
                                                                <span class="text-danger fw-normal"></span>
                                                            </div>

                                                            <div class="form-group mb-4">
                                                                <label for="desdeCuando" class="pb-1"><span
                                                                        class="required-point">*</span> Hace cuantos
                                                                    años</label>
                                                                <input class="form-control" type="number"
                                                                    id="desdeCuandoFuma" />
                                                                <span class="text-danger fw-normal"></span>
                                                            </div>

                                                            <div
                                                                class="form-group container-bg-custom text-center sm-h rounded-2">
                                                                <h5 class="fw-bold pt-2">Riesgo de EPOC</h5>
                                                                <p id="riegoEPOC">Nulo</p>
                                                            </div>
                                                        </section>

                                                        <section id="optionOthersDrugAddiction"
                                                            class="md-w-custom d-none animate__animated animate__fadeInUp">
                                                            <div class="form-group mb-4">
                                                                <label for="desdeCuandoOtros" class="pb-1"><span
                                                                        class="required-point">*</span>Desde cuando
                                                                    (años)</label>
                                                                <input class="form-control" type="number"
                                                                    id="desdeCuandoOtros" />
                                                                <span class="text-danger fw-normal"></span>
                                                            </div>

                                                            <div class="form-floating">
                                                                <textarea class="form-control" placeholder="Especifica la toxicomanía en específico" id="descripcionOtros"></textarea>
                                                                <label for="descripcionOtros"
                                                                    class="text-dark">Descripción</label>
                                                            </div>
                                                        </section>
                                                        <section class="md-w-custom mt-3">
                                                            <button id="addDrugAddiction"
                                                                class="btn-blue-sec px-3 py-2 w-full d-flex gap-1"
                                                                disabled>
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    style="width: 20px;" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M12 4.5v15m7.5-7.5h-15" />
                                                                </svg>
                                                                Agregar</button>
                                                        </section>

                                                    </div>
                                                </div>
                                            </div> <!-- FIN contenedor 1  -->
                                            <div class="col-lg-6 col-sm-12">
                                                <h5 class="text-center">Toxicomanias seleccionadas</h5>
                                                <div class="hr-custom"></div>
                                                <div
                                                    class="row d-flex justify-content-center justify-content-lg-start mt-3">
                                                    <div class="form-group container-list-custom">
                                                        <div class="accordion mt-2 list-dependencies-custom"
                                                            id="listDrugAddictionSelected"></div>
                                                        {{-- <ul class="list-group mt-2 list-dependencies-custom"
                                                            id="listDrugAddictionSelected"></ul> --}}
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


                    {{-- APP Data --}}
                    <div class="row form-step d-none animate__animated animate__fadeInUp">
                        <div class="col-lg-6 col-sm-12">

                            <h5 class="text-center">Antecendentes patológicos</h5>
                            <div class="hr-custom"></div>

                            <div class="accordion mt-3" id="antecedentesPatologicos">

                                {{-- Accordion Enfermedades --}}
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#enfermedad" aria-expanded="false"
                                            aria-controls="enfermedad">
                                            Enfermedades
                                        </button>
                                    </h2>
                                    <div id="enfermedad" class="accordion-collapse collapse"
                                        data-bs-parent="#antecedentesPatologicos">
                                        <div class="accordion-body d-flex justify-content-center h-custom-accordion-body">
                                            <section class="md-w-custom">
                                                <div class="form-group mt-2" id="enfermedad-container">
                                                    <label for="enfermedad" class="pb-1">Enfermedades</label>
                                                    <select class="form-control" name="enfermedadPersonal"
                                                        id="enfermedadPersonal">
                                                        <option value="0" selected>Seleccione una
                                                            opción</option>
                                                        @if ($enfermedades->isEmpty())
                                                            <option value="0" disabled selected>No hay
                                                                enfermedades registradas</option>
                                                        @else
                                                            @foreach ($enfermedades as $enfermedad)
                                                                <option value="{{ $enfermedad->id_especifica_ahf }}">
                                                                    {{ $enfermedad->nombre }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <span class="text-danger fw-normal d-none"></span>
                                                </div>
                                            </section>

                                        </div>
                                    </div>
                                </div>

                                {{-- Alergias --}}
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#alergiasAccordion"
                                            aria-expanded="false" aria-controls="alergiasAccordion">
                                            Alergias
                                        </button>
                                    </h2>
                                    <div id="alergiasAccordion" class="accordion-collapse collapse"
                                        data-bs-parent="#antecedentesPatologicos">
                                        <div class="accordion-body d-flex justify-content-center h-custom-accordion-body">
                                            <section class="md-w-custom">
                                                <div class="form-group mt-2" id="enfermedad-container">
                                                    <label for="enfermedad" class="pb-1">Alergias</label>
                                                    <select class="form-control" name="alergias" id="alergias">
                                                        <option value="0" selected>Seleccione una
                                                            opción</option>
                                                        @if ($alergias->isEmpty())
                                                            <option value="0" disabled selected>No hay
                                                                alergias registradas</option>
                                                        @else
                                                            @foreach ($alergias as $alergia)
                                                                <option value="{{ $alergia->id_alergia }}">
                                                                    {{ $alergia->nombre }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <span class="text-danger fw-normal d-none"></span>
                                                </div>

                                                <div class="form-floating mt-3">
                                                    <textarea class="form-control h-custom-detail-textarea" placeholder="Describe las alergias" id="descripcionAlergias"></textarea>
                                                    <label for="descripcionAlergias" class="text-dark">Descripción</label>
                                                </div>
                                                <span class="text-danger fw-normal d-none"></span>
                                            </section>

                                        </div>
                                    </div>
                                </div>


                                {{-- Accordion Hospitalizaciones --}}
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#hospitalizacionesRecientes"
                                            aria-expanded="false" aria-controls="hospitalizacionesRecientes">
                                            Hospitalizaciones recientes
                                        </button>
                                    </h2>
                                    <div id="hospitalizacionesRecientes" class="accordion-collapse collapse"
                                        data-bs-parent="#antecedentesPatologicos">
                                        <div class="accordion-body h-custom-accordion-body d-flex justify-content-center">
                                            <section class="md-w-custom">

                                                <div class="form-group mb-2">
                                                    <label for="fecha_H">Fecha:</label>
                                                    <input class="form-control" type="date" name="fecha_H"
                                                        id="fecha_H">
                                                    <span class="text-danger fw-normal d-none"></span>

                                                </div>

                                                <div class="form-floating mt-3">
                                                    <textarea class="form-control h-custom-detail-textarea" name="motivo_H" id="motivo_H"></textarea>
                                                    <label for="motivo_H" class="text-dark">Motivo</label>
                                                </div>
                                                <span class="text-danger fw-normal d-none"></span>


                                            </section>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#cirugias" aria-expanded="false"
                                            aria-controls="cirugias">
                                            Cirugías
                                        </button>
                                    </h2>
                                    <div id="cirugias" class="accordion-collapse collapse"
                                        data-bs-parent="#antecedentesPatologicos">
                                        <div class="accordion-body h-custom-accordion-body d-flex justify-content-center">
                                            <section class="md-w-custom">
                                                <div class="form-group  mb-2">
                                                    <label for="fecha_C">Fecha:</label>
                                                    <input class="form-control" type="date" name="fecha_C"
                                                        id="fecha_C">
                                                    <span class="text-danger fw-normal d-none"></span>

                                                </div>

                                                <div class="form-floating mt-3">
                                                    <textarea class="form-control h-custom-detail-textarea" name="motivo_C" id="motivo_C"></textarea>
                                                    <label for="motivo_C" class="text-dark">Motivo</label>
                                                </div>
                                                <span class="text-danger fw-normal d-none"></span>

                                            </section>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#transfusiones"
                                            aria-expanded="false" aria-controls="transfusiones">
                                            Transfusiones
                                        </button>
                                    </h2>
                                    <div id="transfusiones" class="accordion-collapse collapse"
                                        data-bs-parent="#antecedentesPatologicos">
                                        <div class="accordion-body h-custom-accordion-body d-flex justify-content-center">
                                            <section class="md-w-custom">
                                                
                                                <div class="form-group mb-2">
                                                    <label for="fecha_TF">Fecha:</label>
                                                    <input class="form-control" type="date" name="fecha_TF"
                                                        id="fecha_TF">
                                                    <span class="text-danger fw-normal d-none"></span>

                                                </div>
                                                <div class="form-floating mt-3">
                                                    <textarea class="form-control h-custom-detail-textarea" name="motivo_TF" id="motivo_TF"></textarea>
                                                    <label for="motivo_TF" class="text-dark">Motivo</label>
                                                </div>
                                                <span class="text-danger fw-normal d-none"></span>
                                            </section>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#traumatismos"
                                            aria-expanded="false" aria-controls="traumatismos">
                                            Traumatismos
                                        </button>
                                    </h2>
                                    <div id="traumatismos" class="accordion-collapse collapse"
                                        data-bs-parent="#antecedentesPatologicos">
                                        <div class="accordion-body h-custom-accordion-body d-flex justify-content-center">
                                            <section class="md-w-custom">
                                                <div class="form-group mb-2">
                                                    <label for="fecha_TU">Fecha:</label>
                                                    <input class="form-control" type="date" name="fecha_TU"
                                                        id="fecha_TU">
                                                    <span class="text-danger fw-normal d-none"></span>

                                                </div>

                                                <div class="form-floating mt-3">
                                                    <textarea class="form-control h-custom-detail-textarea" name="motivo_TU" id="motivo_TU"></textarea>
                                                    <label for="motivo_TU" class="text-dark">Motivo</label>
                                                </div>
                                                <span class="text-danger fw-normal d-none"></span>

                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <section class="mt-4 d-flex">
                                <button id="addAntecedentesPatologicos"
                                    class="btn-blue-sec px-3 py-2 w-full d-flex gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px;" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Agregar</button>
                            </section>



                        </div> <!-- FIN contenedor 1  -->
                        {{-- Contenedor 2 --}}
                        <div class="col-lg-6 col-sm-12">
                            <h5 class="text-center">Lista de Antecedentes patológicos</h5>
                            <div class="hr-custom"></div>
                            <div class="row d-flex justify-content-center justify-content-lg-start mt-3">
                                <div class="form-group container-list-custom">
                                    <div class="accordion mt-2 list-dependencies-custom" id="listPathologicalHistory">
                                    </div>
                                    {{-- <ul class="list-group mt-2 list-dependencies-custom" id="listPathologicalHistory">
                                    </ul> --}}
                                </div>
                            </div>
                        </div><!-- Fin de contenedor 2 -->
                        <!-- Fin de contenedor 3 -->
                    </div>

                    {{-- Ginecologia y obstetricia --}}
                    <div class="row form-step d-none animate__animated animate__fadeInUp">
                        <div class="col-12">
                            <h5 class="text-center">Ginecología y Obstetricia</h5>
                            <div class="hr-custom"></div>
                        </div>
                        <div class="col-12 col-xl-9 mt-3">
                            <div class="row">
                                <div class="col-12 col-lg-6 col-xl-5">
                                    <div class="form-group mt-2 group-gyo " id="enfermedad-container">
                                        <label for="enfermedad" class="pb-1"><span
                                                class="required-point">*</span>Menarca (Edad)</label>
                                        <input class="form-control" type="number" name="menarca" id="menarca"
                                            min="1" max="2">
                                        <span class="text-danger fw-normal d-none"></span>
                                    </div>
                                    <div class="form-group mt-2 group-gyo" id="enfermedad-container">
                                        <label for="enfermedad" class="pb-1"><span class="required-point">*</span>Fecha
                                            de última menstruación</label>
                                        <input class="form-control" type="date" name="fechaUltimaMenstruacion"
                                            id="fechaUltimaMenstruacion">
                                        <span class="text-danger fw-normal d-none"></span>
                                    </div>

                                    <div class="form-check mt-2 mb-4 group-gyo">
                                        <input class="form-check-input w-custom-checkbox" type="checkbox" value=""
                                            id="tieneEmbarazo">
                                        <label class="form-check-label ps-2" for="tieneEmbarazo">
                                            Está embarazada
                                        </label>
                                    </div>

                                    <section class="form-group mt-4">
                                        <label class="pb-1 text-center"><span
                                                class="required-point">*</span>Ciclos</label>
                                        <div
                                            class="funkyradio d-flex flex-column flex-md-row justify-content-center justify-content-lg-between gap-3 group-gyo">
                                            <div class="funkyradio-primary">
                                                <input type="radio" name="radio" id="cicloRegular" checked />
                                                <label class="me-3" for="cicloRegular">Regular</label>
                                            </div>
                                            <div class="funkyradio-primary">
                                                <input type="radio" name="radio" id="cicloIrregular" />
                                                <label class="me-3" for="cicloIrregular">Irregular</label>
                                            </div>
                                            <span class="text-danger fw-normal d-none"></span>
                                        </div>
                                    </section>


                                    <section class="d-flex gap-3 mt-3 align-items-end">
                                        <div class="form-group w-100 text-center group-gyo">
                                            <label>Dias de sangrado</label>
                                            <input class="form-control " type="number" name="diasSangrado"
                                                id="diasSangrado" min="1" max="2">
                                            <span class="text-danger fw-normal d-none"></span>
                                        </div>
                                        <span class="x-custom">X</span>
                                        <div class="form-group w-100 text-center group-gyo">
                                            <label>Dias de ciclos</label>
                                            <input class="form-control w-100" type="number" name="diasCiclo"
                                                id="diasCiclo" min="1" max="2">
                                            <span class="text-danger fw-normal d-none"></span>
                                        </div>
                                    </section>

                                </div>
                                <div class="col-12 col-lg-6 col-xl-7 mt-4 mt-lg-0">
                                    <section class="d-flex gap-3">
                                        <div class="form-group w-100 mt-2 group-gyo">
                                            <label for="fechaCitologia" class="pb-1"><span
                                                    class="required-point">*</span> Fecha de citología (año)</label>
                                            <input class="form-control" type="number" name="fechaCitologia"
                                                max="4" id="fechaCitologia">
                                            <span class="text-danger fw-normal d-none"></span>
                                        </div>

                                        <div class="form-group w-100 mt-2 group-gyo">
                                            <label for="enfermedad" class="pb-1"><span
                                                    class="required-point">*</span>Mastografía (año)</label>
                                            <input class="form-control" type="number" name="mastografia" max="4"
                                                id="mastografia">
                                            <span class="text-danger fw-normal d-none"></span>
                                        </div>
                                    </section>


                                    <div class="form-floating mt-4 group-gyo">
                                        <textarea class="form-control h-custom-metodo" id="metodoDescripcion"></textarea>
                                        <label for="metodoDescripcion">Método</label>
                                        <span class="text-danger fw-normal d-none"></span>
                                    </div>




                                </div>



                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-3 mt-5 mt-5 mt-lg-4">
                            <div class="form-group mt-2 group-gyo">
                                <label for="enfermedad" class="pb-1"><span class="required-point">*</span>Inicio de la
                                    vida sexual (Edad)</label>
                                <input class="form-control" type="number" name="inicioVidaSexual" id="inicioVidaSexual"
                                    min="1" max="2">
                                <span class="text-danger fw-normal d-none"></span>
                            </div>

                            <div class="form-group mt-2 group-gyo">
                                <label for="numPartos" class="pb-1"><span class="required-point">*</span>Partos</label>
                                <input class="form-control" type="number" name="numPartos" id="numPartos"
                                    min="1" max="2">
                                <span class="text-danger fw-normal d-none"></span>
                            </div>

                            <div class="form-group mt-2 group-gyo">
                                <label for="numAbortos" class="pb-1"><span
                                        class="required-point">*</span>Abortos</label>
                                <input class="form-control" type="number" name="numAbortos" id="numAbortos"
                                    min="1" max="2">
                                <span class="text-danger fw-normal d-none"></span>
                            </div>

                            <div class="form-group mt-2 group-gyo">
                                <label for="numCesareas" class="pb-1"><span
                                        class="required-point">*</span>Cesareas</label>
                                <input class="form-control" type="number" name="numCesareas" id="numCesareas"
                                    min="1" max="2">
                                <span class="text-danger fw-normal d-none"></span>
                            </div>

                            <div class="form-group mt-2 group-gyo">
                                <label for="numGestas" class="pb-1"><span class="required-point">*</span>Gestas</label>
                                <input class="form-control" type="number" name="numGestas" id="numGestas"
                                    max="2">
                                <span class="text-danger fw-normal d-none"></span>
                            </div>
                        </div>
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

    </div>

@endsection


@section('scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    @vite(['resources/js/loading-screen.js', 'resources/js/SideBar.js', 'resources/js/addPatients.js'])

@endsection
