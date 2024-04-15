@extends('admin.layouts.main')

@section('title', 'Agregar')

@section('viteConfig')
@vite(['resources/sass/sideBar.scss','resources/sass/loadingScreen.scss', 'resources/sass/StyleForm.scss','resources/sass/colorButtons.scss', 'resources/js/app.js'])
@endsection

<!-- Esto no se que hace pero lo puse jsjsjsj -->
@section('breadCrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="item-custom-link" href="{{ route('home') }}">Pacientes</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dar de alta</li>
    </ol>
</nav>
@endsection

@section('titleView','Dar de alta a un paciente')



@section('content')
<div class="container ">

    <!-- <div class="progress mb-2">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
    </div> -->

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
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="F_nacimiento">Fecha de nacimiento</label>
                                            <input type="date" id="F_nacimiento" class="form-control" />
                                            <span class="text-danger fw-normal" style=" display: none;">Fecha no válido.</span>

                                        </div>
                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="sangre">Tipo de sangre</label>
                                            <input type="text" id="T_sangre" class="form-control" />
                                            <span class="text-danger fw-normal" style=" display: none;">Tipo no válido.</span>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="tel">Teléfono de emergencia: </label>
                                            <input type="text" id="tel" class="form-control" maxlength="10" />
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
                                <div class="row pt-2">
                                    <div class="form-group col-md-6 col-sm-12 mb-2">
                                        <label for="puesto">Carrera/Puesto:</label>
                                        <input class="form-control" type="text" id="Puesto" name="puesto">
                                        <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-end text-end">
                            <div class="col-6">
                                <button class="btn fst-italic  animated-icon button-next" id="personal-data"> Siguiente <i class="ps-2 fa-solid fa-arrow-right"></i></button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario para los datos del nombramiento principal  -->
    <div class="row bg-color-form pb-3 mt-4 job-data d-none">
        <h5 class="text-center pt-3">Datos administrativos nombramiento principal</h5>
        <div class="row pt-1">
            <div class="col-12 content-custom">

                <div class="row">
                    <div class="col-12">
                        <div class="row">

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-12">
                                            <label for="nombramientos">Nombramiento <span class="red-Color">*</span> </label>
                                            <select class="form-control" name="nombramientos" id="nombramientos">
                                                <option value="" disabled selected>Selecciona una opción</option>
                                            </select>
                                            <span class="text-danger fw-normal" style=" display: none;">Nombramiento no válido.</span>
                                        </div>
                                        <div class="form-group col-12 pt-2">
                                            <label for="categoria" style="display: block;">Categorias <span class="red-Color">*</span></label>
                                            <select disabled="disabled" class="form-control form-disabled" name="categorias" id="categorias">
                                                <option value="" disabled selected>Selecciona una opción</option>

                                            </select>
                                            <span class="text-danger fw-normal" style=" display: none;">Categoría no válida.</span>

                                        </div>

                                        <!-- Este campo estará oculto a no ser que el, nombramiento si tenga deisticiosn adiciinal -->
                                        <div class="form-group col-12 d-none campo-distincion">
                                            <label for="Distincion_Adicional">Distincion adicional:</label>
                                            <select class="form-control form-disabled" name="Distincion_Adicional" id="Distincion_Adicional">
                                                <option value="" disabled selected>Selecciona una opción</option>
                                            </select>
                                            <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>

                                        </div>

                                        <div class="form-group col-12">
                                            <label for="dep">Departamento /Área de Adscripción <span class="red-Color">*</span></label>
                                            <input class="form-control form-disabled" type="text" name="dep" id="dep" disabled>
                                            <span class="text-danger fw-normal" style=" display: none;">Departamento no válido.</span>

                                        </div>
                                    </div>
                                </div>
                            </div> <!-- FIN contenedor 1  -->


                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="row pt-2">
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="hours">Horas de trabajo <span class="red-Color opc">*</span> </label>
                                                    <select disabled class="form-control form-disabled" name="hours" id="hours">
                                                        <option value="" disabled selected>Seleccione una opción</option>
                                                        <option value="1">20</option>
                                                        <option value="2">24</option>
                                                        <option value="3">36</option>
                                                        <option value="4">40</option>
                                                        <option value="5">48</option>
                                                        <option value="6">No aplica</option>

                                                    </select>
                                                    <span class="text-danger fw-normal" style=" display: none;">Horas no válidas.</span>

                                                </div>

                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="shift">Turno <span class="red-Color opc">*</span></label>
                                                    <select disabled class="form-control form-disabled" name="shift" id="shift">
                                                        <option value="" disabled selected>Seleccione una opción</option>
                                                        <option value="1">Matutino</option>
                                                        <option value="2">Vespertino</option>
                                                        <option value="3">Nocturno</option>
                                                        <option value="4">Mixto</option>
                                                        <option value="5">No aplica</option>

                                                    </select>
                                                    <span class="text-danger fw-normal" style=" display: none;">Turno no válido.</span>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row pt-2">
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="hor_oficial">Horario oficial: <span class="red-Color opc">*</span> </label>
                                                    <select disabled class="form-control form-disabled" name="hor_oficial" id="hor_oficial">
                                                        <option value="" disabled selected>Seleccione una opción</option>
                                                        <option value="1">Lunes a viernes</option>
                                                        <option value="2">Lunes a sabado</option>
                                                        <option value="3">No aplica</option>
                                                    </select>
                                                    <span class="text-danger fw-normal" style=" display: none;">Horario no válido.</span>

                                                </div>

                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="hor_actual">Horario actual <span class="red-Color opc">*</span></label>
                                                    <!-- <select disabled class="form-control form-disabled" name="hor_actual" id="hor_actual">
                                                        <option value="" disabled selected>Seleccione una opción</option>
                                                        <option value="1">Lunes a viernes</option>
                                                        <option value="2">Lunes a sabado</option>
                                                        <option value="3">No aplica</option>

                                                    </select> -->
                                                    <input class="form-control form-disabled" type="text" name="hor_actual" id="hor_actual" disabled placeholder="Lunes - Jueves">

                                                    <span class="text-danger fw-normal" style=" display: none;">Horario no válido.</span>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row pt-2">
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="horas_oficial">Horario oficial: <span class="red-Color opc">*</span> </label>
                                                    <!-- <select disabled class="form-control form-disabled" name="hor_oficial" id="hor_oficial">
                                                        <option value="" disabled selected>Seleccione una opción</option>
                                                        <option value="1">Lunes a viernes</option>
                                                        <option value="2">Lunes a sabado</option>
                                                        <option value="3">No aplica</option>
                                                    </select> -->
                                                    <input class="form-control form-disabled" type="text" name="horas_oficial" id="horas_oficial" disabled placeholder="08:00 - 14:00">

                                                    <span class="text-danger fw-normal" style=" display: none;">Horario no válido.</span>

                                                </div>

                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="horas_actual">Horario actual <span class="red-Color opc">*</span></label>
                                                    <!-- <select disabled class="form-control form-disabled" name="hor_actual" id="hor_actual">
                                                        <option value="" disabled selected>Seleccione una opción</option>
                                                        <option value="1">Lunes a viernes</option>
                                                        <option value="2">Lunes a sabado</option>
                                                        <option value="3">No aplica</option>

                                                    </select> -->
                                                    <input class="form-control form-disabled" type="text" name="horas_actual" id="horas_actual" disabled placeholder="09:00 - 15:00">

                                                    <span class="text-danger fw-normal" style=" display: none;">Horario no válido.</span>

                                                </div>
                                            </div>
                                        </div>




                                        <div class="form-group">
                                            <div class="row pt-2">
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="contrato">Tipo de contrato <span class="red-Color">*</span></label>
                                                    <select disabled class="form-control form-disabled" name="contrato" id="contrato">
                                                        <option value="" disabled selected>Seleccione una opción</option>
                                                        <option value="1">Temporal</option>
                                                        <option value="2">Definitivo</option>
                                                    </select>
                                                    <span class="text-danger fw-normal" style=" display: none;">Tipo no válido.</span>

                                                </div>

                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="fecha_termino" style="display: block;">Fecha de termino <span class="red-Color">*</span></label>
                                                    <input disabled class="form-control form-disabled" type="date" id="fecha_termino" name="fecha_termino">
                                                    <span class="text-danger fw-normal" style=" display: none;">Fecha no válida.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Fin de contenedor 2 -->
                            <!-- Fin de contenedor 3 -->
                        </div>
                    </div>
                </div>

                <div class="col-12 ">
                    <div class="form-group pt-3  justify-content-end text-end gap-2">
                        <!-- <button class="btn mx-2 fst-normal px-3 fw-bold" id="cancelReport" style="background-color: rgba(21,100, 137,0.15);">Cancelar</button> -->

                        <a href="{{ route('personal') }}" class="btn fst-italic  animated-icon button-cancel" id="cancelReport"> <i class="pe-2 fa-solid fa-xmark"></i> Cancelar</a>
                        <button class="btn fst-italic animated-icon button-save" id="confirm-register"> <i class="fa-solid fa-check"></i> Guardar</button>

                    </div>
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
<!-- <script type="module" src="{{ asset('js/Personas.js') }}"></script> -->
<!-- Cargar archivo de js -->
@vite(['resources/js/loading-screen.js','resources/js/SideBar.js'])

@endsection