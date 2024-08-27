{{-- Antecedentes no patológicos --}}
<div class="row p-2 p-sm-3 apnp-data d-none form-step animate__animated animate__fadeInUp bg-content-custom shadow-custom">
    <div class="container pt-1">
        <div class="col-12 content-custom">
            
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="row d-flex justify-content-center">
                                <h5 class="md-w-custom text-center text-lg-start">Lista de toxicomanias
                                </h5>
                            </div>
                            <div class="hr-custom"></div>
                            <div class="form-group">
                                <div class="row pt-2 d-flex flex-column align-items-center">
                                    <div class="form-group md-w-custom mb-4 mb-lg-2">
                                        <x-label-with-tooltip 
                                            labelFor="toxico"
                                            titleLabel="Toxicomanía" :required=false
                                            message="Seleccione las toxicomanías que tiene el paciente, tales como: tabaco, alcohol y otras" />

                                        <select class="form-control" name="toxico" id="toxico">
                                            <option value="" disabled selected>Seleccione una
                                                opción</option>
                                            @foreach ($toxicomanias as $toxicomania)
                                                <option value="{{ $toxicomania->id }}">
                                                    {{ $toxicomania->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger fw-normal mt-1"></span>
                                    </div>

                                    {{-- Section for dates and quantity smoking --}}
                                    <section id="optionSmoking"
                                        class="md-w-custom d-none animate__animated animate__fadeInUp mt-3">
                                        
                                        <div class="form-group mb-4">
                                            <label for="desdeCuando" class="pb-1">Desde cuando (años) <span class="required-point">*</span></label>
                                            <input class="form-control" type="number"
                                                id="desdeCuandoFuma" />
                                            <span class="text-danger fw-normal"></span>
                                        </div>

                                        <div class="form-group mb-2">
                                            <label for="desdeCuando" class="pb-1">Cantidad de cigarros por día <span class="required-point">*</span></label>
                                            <input class="form-control" type="number"
                                                id="cantidadCigarros" />
                                            <span class="text-danger fw-normal"></span>
                                        </div>

                                        <div
                                            class="form-group container-bg-custom text-center sm-h rounded-2">
                                            <h5 class="fw-bold pt-2">Riesgo de EPOC</h5>
                                            <p id="riegoEPOC"><span class="badge badge-custom-success">Nulo</span></p>
                                        </div>
                                    </section>

                                    <section id="optionOthersDrugAddiction"
                                        class="md-w-custom d-none animate__animated animate__fadeInUp mt-3">
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
                                            <label for="descripcionOtros" class="text-dark">Descripción</label>
                                        </div>
                                        <span class="text-danger fw-normal d-none"></span>
                                    </section>
                                    <section class="md-w-custom mt-1 mt-md-3 d-flex flex-column flex-md-row">
                                        <x-button-custom id="addDrugAddiction" text="Agregar toxicomanía" class="btn-blue-sec" :disabled="true" tooltipText="Agregar la toxicomanía a la lista">
                                            <x-slot name="icon" class="btn-blue-sec">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                style="width: 20px;" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                            </x-slot>
                                        </x-button-custom>
                                    </section>

                                </div>
                            </div>
                        </div> <!-- FIN contenedor 1  -->
                        <div class="col-lg-6 col-sm-12 mt-5 mt-lg-0">
                            <h5 class="text-center">Toxicomanias seleccionadas</h5>
                            <div class="hr-custom"></div>
                            <div
                                class="row d-flex justify-content-center justify-content-lg-start mt-3 mx-2">
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