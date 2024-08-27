<!-- Datos Antecendentes Hederofamiliares  -->
<div class="row p-2 p-sm-3 ahf-data d-none form-step animate__animated animate__fadeInUp bg-content-custom shadow-custom">
    <div class="col-12 pt-1">
        <div class="col-12 content-custom ">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="row d-flex justify-content-center">
                                <h5 class="md-w-custom text-center text-lg-start">Lista de enfermedades
                                </h5>
                            </div>
                            <div class="hr-custom"></div>
                            <div class="form-group mb-4 mb-md-5">
                                <div class="row pt-2 d-flex justify-content-center">

                                    <div class="form-group md-w-custom mt-2"
                                        id="enfermedad-container">
                                        <x-label-with-tooltip labelFor="enfermedad" titleLabel="Enfermedad" :required=false message="Seleccione la lista de enfermedades que tiene tu familia" />

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
                        <div class="col-lg-6 col-sm-12 mt-lg-0 mt-md-4 mt-3">
                            <h5 class="text-center">Enfermedades seleccionadas</h5>
                            <div class="hr-custom"></div>
                            <div
                                class="row d-flex justify-content-center justify-content-lg-start mt-3 mx-2">
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