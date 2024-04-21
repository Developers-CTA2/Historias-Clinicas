@extends('admin.layouts.main')

@section('title', 'Agregar nuevo paciente')

@section('viteConfig')
@vite(['resources/sass/sideBar.scss','resources/sass/loadingScreen.scss', 'resources/sass/StyleForm.scss','resources/sass/colorButtons.scss', 'resources/js/app.js'])
@endsection

<!-- Esto no se que hace pero lo puse jsjsjsj -->
@section('breadCrumb')
<nav aria-label="breadcrumb" class="d-flex justify-content-between align-items-center">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a class="item-custom-link" href="{{ route('home') }}">Pacientes</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Dar de alta</li>
    </ol>
    <span class="text-end">{{ now()->setTimezone('America/Mexico_City')->format('d F Y') }}</span>
</nav>
@endsection



@section('content')
<div class="container ">
    <div>
        <h4 class="fw-bold">Dar de alta a un paciente</h4>
        <h6>Ingresa los datos correspondientes del paciente</h6>
    </div>
    <div class="row justify-content-center px-0">
        <div class="row">
            <h4 class="text-center pt-3">Datos personales</h4>
            <div class="col-12 content-custom">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="codigo">Código:</label>
                                            <input class="form-control" type="text" id="codigo" name="codigo" pattern="[0-9]{7}" maxlength="7">
                                            <span class="text-danger fw-normal" style=" display: none;">Código no válido.</span>

                                        </div>

                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="sex">Género:</label>
                                            <select class="form-control" name="sex" id="sex">
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <option value="1">Masculino</option>
                                                <option value="2">Femenino</option>
                                            </select>
                                            <span class="text-danger fw-normal" style=" display: none;">Género no válido.</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group pt-2 col-12 mb-2">
                                    <label for="name_P">Nombre Completo:</label>
                                    <input class="form-control" type="text" name="name_P" id="name_P" oninput="this.value = this.value.toUpperCase()">
                                    <span class="text-danger fw-normal" style=" display: none;">Nombre no válido.</span>

                                </div>
                                <div class="form-group mb-4">
                                    <div class="row pt-2">
                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="F_nacimiento">Fecha de nacimiento</label>
                                            <input type="date" id="F_nacimiento" name="F_nacimiento" class="form-control" />
                                            <span class="text-danger fw-normal" style=" display: none;">Fecha no válido.</span>

                                        </div>
                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="sangre">Tipo de sangre</label>
                                            <input type="text" id="T_sangre" name="T_sangre" class="form-control" />
                                            <span class="text-danger fw-normal" style=" display: none;">Tipo no válido.</span>

                                        </div>
                                    </div>
                                </div>
                                <h4 class="text-center pt-3">Domicilio</h4>
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="codigo">Estado:</label>
                                            <input class="form-control" type="text" id="estado" name="estado">
                                            <span class="text-danger fw-normal" style=" display: none;">Estado no válido.</span>

                                        </div>

                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="sex">Ciudad:</label>
                                            <input class="form-control" type="text" id="ciudad" name="ciudad">
                                            <span class="text-danger fw-normal" style=" display: none;">Ciudad no válida.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="F_nacimiento">Calle</label>
                                            <input type="date" id="calle" name="calle" class="form-control" />
                                            <span class="text-danger fw-normal" style=" display: none;">Calle no válida.</span>

                                        </div>
                                        <div class="form-group col-md-3 col-sm-8 mb-2">
                                            <label for="sangre">Num </label>
                                            <input type="text" id="num" name="num" class="form-control" />
                                            <span class="text-danger fw-normal" style=" display: none;">Número no válido.</span>
                                        </div>
                                        <div class="form-group col-md-3 col-sm-8 mb-2">
                                            <label for="sangre">Num. Int </label>
                                            <input type="text" id="num_int" name="num_int" class="form-control" />
                                            <span class="text-danger fw-normal" style=" display: none;">Número no válido.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="tel">Teléfono: </label>
                                            <input type="text" id="tel" name="tel" class="form-control" maxlength="10" />
                                            <span class="text-danger fw-normal" style=" display: none;">Teléfono no válido.</span>

                                        </div>
                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="nss">NSS:</label>
                                            <input class="form-control" type="text" id="nss" name="nss">
                                            <span class="text-danger fw-normal" style=" display: none;">NSS no válida.</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="E_civil">Estado civil:</label>
                                            <input class="form-control" type="text" id="E_civil" name="E_civil">
                                            <span class="text-danger fw-normal" style=" display: none;">Estado civil no válida.</span>

                                        </div>

                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="religion">Religión:</label>
                                            <input class="form-control" type="text" id="religion" name="religion">
                                            <span class="text-danger fw-normal" style=" display: none;">Religión no válida.</span>


                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-2 mb-4">
                                    <div class="form-group col-md-6 col-sm-12 mb-2">
                                        <label for="puesto">Carrera/Puesto:</label>
                                        <input class="form-control" type="text" id="Puesto" name="puesto">
                                        <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>

                                    </div>
                                </div>
                                <h4 class="text-center pt-3">Contacto de emergencia</h4>
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="codigo">Nombre:</label>
                                            <input class="form-control" type="text" id="nombre_e" name="nombre_e">
                                            <span class="text-danger fw-normal" style=" display: none;">Nombre no válido.</span>

                                        </div>

                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="sex">Telefono:</label>
                                            <input class="form-control" type="text" id="telefono" name="telefono" pattern="[0-9]{10}" maxlength="10">
                                            <span class="text-danger fw-normal" style=" display: none;">Teléfono no válida.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-end text-end">
                            <div class="col-6">
                                <button type="button" class="btn btn-primary" id="personal-data">Siguiente</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Datos AHF  -->
    <div class="row pb-3 mt-4 job-data d-none">
        <div class="row pt-1">
            <div class="col-12 content-custom">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h5>Tipo</h5>
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-md-8 col-sm-12 mb-4">
                                            <select class="form-control" name="tipo_AHF" id="tipo_AHF">
                                                <option value="" disabled selected>Seleccione una opción</option>
                                            </select>
                                            <span class="text-danger fw-normal" style=" display: none;">Tipo no válido.</span>
                                        </div>
                                        <h5>Enfermedad</h5>
                                        <div class="form-group">
                                            <div class="row pt-2">
                                                <div class="form-group col-md-8 col-sm-12 mb-2">
                                                    <select class="form-control" name="enfermedad" id="enfermedad">
                                                        <option value="" disabled selected>Seleccione una opción</option>
                                                    </select>
                                                    <span class="text-danger fw-normal" style=" display: none;">Enfermedad no válido.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- FIN contenedor 1  -->
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h5>Enfermedades seleccionadas</h5>
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <div class="container">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Fin de contenedor 2 -->
                            <!-- Fin de contenedor 3 -->
                        </div>
                        <div class="row mt-3 justify-content-end text-end">
                            <div class="col-6">
                                <button class="btn button-previos" id="personal-data"> Atras</button>
                                <button class="btn button-next" id="personal-data"> Siguiente</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Datos APNP  -->
    <div class="row pb-3 mt-4 job-data d-none">
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
                                                <option value="" disabled selected>Seleccione una opción</option>
                                            </select>
                                            <span class="text-danger fw-normal" style=" display: none;">Toxicomanias no válido.</span>
                                        </div>
                                        <h5>Alimentación</h5>
                                        <div class="form-group">
                                            <div class="row pt-2">
                                                <div class="form-group col-md-8 col-sm-12 mb-2">
                                                    <textarea class="form-control" aria-label="With textarea"></textarea>
                                                    <span class="text-danger fw-normal" style=" display: none;">Campo no válido.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- FIN contenedor 1  -->
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h5>Toxicomanias</h5>
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="ccantidad_toxi">Cantidad:</label>
                                            <input class="form-control" type="text" id="cantidad_toxi" name="cantidad_toxi">
                                            <span class="text-danger fw-normal" style=" display: none;">Cantidad no válido.</span>

                                        </div>

                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="desde_toxi">Desde cuando:</label>
                                            <input class="form-control" type="text" id="desde_toxi" name="desde_toxi">
                                            <span class="text-danger fw-normal" style=" display: none;">Dato no válida.</span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Fin de contenedor 2 -->
                            <!-- Fin de contenedor 3 -->
                        </div>
                        <div class="row mt-3 justify-content-end text-end">
                            <div class="col-6">
                                <button class="btn button-previos" id="personal-data"> Atras</button>
                                <button class="btn button-next" id="personal-data"> Siguiente</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario para los datos APP  -->
    <div class="row pb-3 mt-4 job-data d-none">
        <div class="row pt-1">
            <div class="col-12 content-custom">

                <div class="row">
                    <div class="col-12">
                        <div class="row">

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h5>Hospitalizaciones recientes</h5>
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <label for="Hospitalizaciones">Selecciona:</label>
                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="respuesta_H" id="si_H" value="si">
                                                <label class="form-check-label" for="si_H">Sí</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="respuesta_H" id="no_H" value="no">
                                                <label class="form-check-label" for="no_H">No</label>
                                            </div>
                                            <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="fecha_H">Fecha:</label>
                                            <input class="form-control" type="date" name="fecha_H" id="fecha_H">
                                            <span class="text-danger fw-normal" style=" display: none;">Fecha no válida.</span>

                                        </div>
                                        <div class="form-group col-12">
                                            <label for="motivo_H">Motivo</label>
                                            <input class="form-control" type="text" name="motivo_H" id="motivo_H">
                                            <span class="text-danger fw-normal" style=" display: none;">Motivo no válido.</span>

                                        </div>
                                        <h5>Cirugías</h5>
                                        <div class="form-group">
                                            <div class="row pt-2">
                                                <label for="Cirugias">Selecciona:</label>
                                                <div class="form-group col-md-6 col-sm-12 mb-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="respuesta_C" id="si_C" value="si">
                                                        <label class="form-check-label" for="si_C">Sí</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="respuesta_C" id="no_C" value="no">
                                                        <label class="form-check-label" for="no_C">No</label>
                                                    </div>
                                                    <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12 mb-2">
                                                    <label for="fecha_C">Fecha:</label>
                                                    <input class="form-control" type="date" name="fecha_C" id="fecha_C">
                                                    <span class="text-danger fw-normal" style=" display: none;">Fecha no válida.</span>

                                                </div>
                                                <div class="form-group col-12">
                                                    <label for="motivo_C">Motivo</label>
                                                    <input class="form-control" type="text" name="motivo_C" id="motivo_C">
                                                    <span class="text-danger fw-normal" style=" display: none;">Motivo no válido.</span>

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
                                                <input class="form-check-input" type="radio" name="respuesta_TF" id="si_TF" value="si">
                                                <label class="form-check-label" for="si_TF">Sí</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="respuesta_TF" id="no_TF" value="no">
                                                <label class="form-check-label" for="no_TF">No</label>
                                            </div>
                                            <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="fecha_TF">Fecha:</label>
                                            <input class="form-control" type="date" name="fecha_TF" id="fecha_TF">
                                            <span class="text-danger fw-normal" style=" display: none;">Fecha no válida.</span>

                                        </div>
                                        <div class="form-group col-12">
                                            <label for="motivo_TF">Motivo</label>
                                            <input class="form-control" type="text" name="motivo_TF" id="motivo_TF">
                                            <span class="text-danger fw-normal" style=" display: none;">Motivo no válido.</span>

                                        </div>
                                        <h5>Traumatismos</h5>
                                        <div class="form-group">
                                            <div class="row pt-2">
                                                <label for="Traumatismos">Selecciona:</label>
                                                <div class="form-group col-md-6 col-sm-12 mb-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="respuesta_TU" id="si_TU" value="si">
                                                        <label class="form-check-label" for="si_TU">Sí</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="respuesta_TU" id="no_TU" value="no">
                                                        <label class="form-check-label" for="no_TU">No</label>
                                                    </div>
                                                    <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12 mb-2">
                                                    <label for="fecha_TU">Fecha:</label>
                                                    <input class="form-control" type="date" name="fecha_TU" id="fecha_TU">
                                                    <span class="text-danger fw-normal" style=" display: none;">Fecha no válida.</span>

                                                </div>
                                                <div class="form-group col-12">
                                                    <label for="motivo_C">Motivo</label>
                                                    <input class="form-control" type="text" name="motivo_TU" id="motivo_TU">
                                                    <span class="text-danger fw-normal" style=" display: none;">Motivo no válido.</span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Fin de contenedor 2 -->
                            <!-- Fin de contenedor 3 -->
                        </div>
                        <div class="row mt-3 justify-content-end text-end">
                            <div class="col-6">
                                <button class="btn button-previos" id="personal-atras"> Atras</button>
                                <button class="btn fst-italic animated-icon button-save" id="confirm-register">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection


@section('scripts')
@vite(['resources/js/loading-screen.js','resources/js/SideBar.js'])

@endsection