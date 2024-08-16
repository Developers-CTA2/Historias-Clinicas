{{-- Ginecologia y obstetricia --}}

<div class="row form-step d-none animate__animated animate__fadeInUp bg-content-custom shadow-custom p-3">
    <div class="col-12">
        <h5 class="text-center">Ginecología y Obstetricia</h5>
        <div class="hr-custom"></div>
    </div>
    <div class="col-12 col-xl-9 mt-3">
        <div class="row">
            <div class="col-12 col-lg-6 col-xl-5">
                <div class="form-group mt-2 group-gyo " id="enfermedad-container">
                
                    <x-label-with-tooltip labelFor="menarca" titleLabel="Menarca (Edad)" required="true"
                        message="Debes ingresar la edad de la primera menstruación de la mujer, ejemplo: 12" />

                    <input class="form-control" type="number" name="menarca" id="menarca"
                         placeholder="12">
                    <span class="text-danger fw-normal d-none"></span>
                </div>
                <div class="form-group mt-2 group-gyo" id="enfermedad-container">
                    <label for="enfermedad" class="pb-1">Fecha de última menstruación <span class="required-point">*</span></label>
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
                    <label class="pb-1 text-center">Ciclos <span class="required-point">*</span></label>
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
                        <label>Dias de sangrado <span class="required-point">*</span></label>
                        <input class="form-control " type="number" name="diasSangrado"
                            id="diasSangrado" placeholder="10">
                        <span class="text-danger fw-normal d-none"></span>
                    </div>
                    <span class="x-custom">X</span>
                    <div class="form-group w-100 text-center group-gyo">
                        <label>Dias de ciclos <span class="required-point">*</span></label>
                        <input class="form-control w-100" type="number" name="diasCiclo"
                            id="diasCiclo" placeholder="4">
                        <span class="text-danger fw-normal d-none"></span>
                    </div>
                </section>

            </div>
            <div class="col-12 col-lg-6 col-xl-7 mt-4 mt-lg-0">
                <section class="d-flex gap-3">
                    <div class="form-group w-100 mt-2 group-gyo">

                        <x-label-with-tooltip labelFor="citologia" titleLabel="Fecha de citología (año)" required="true"
                            message="Debes ingresar el año de la última citología de la mujer, ejemplo: 2023" />
                    
                        <input class="form-control" type="number" name="fechaCitologia"
                            max="4" id="fechaCitologia" placeholder="2024">
                        <span class="text-danger fw-normal d-none"></span>
                    </div>

                    <div class="form-group w-100 mt-2 group-gyo">
                        <x-label-with-tooltip labelFor="mastografia" titleLabel="Mastografía (año)" required="true"
                            message="Debes ingresar el año de la última mastografía de la mujer, ejemplo: 2023" />

                        <input class="form-control" type="number" name="mastografia" max="4" placeholder="2024"
                            id="mastografia">
                        <span class="text-danger fw-normal d-none"></span>
                    </div>
                </section>


                <div class="form-floating mt-4 group-gyo">
                    <textarea class="form-control h-custom-metodo" id="metodoDescripcion"></textarea>
                    <label for="metodoDescripcion">Método <span class="required-point">*</span></label>
                    <span class="text-danger fw-normal d-none"></span>
                </div>




            </div>



        </div>
    </div>
    <div class="col-12 col-lg-6 col-xl-3 mt-5 mt-5 mt-lg-4">
        <div class="form-group mt-2 group-gyo">
            <x-label-with-tooltip labelFor="inicioVidaSexual" titleLabel="Inicio de vida sexual (Edad)"
                required="true" message="Debes ingresar la edad de inicio de vida sexual de la mujer, ejemplo: 20" />

            <input class="form-control" type="number" name="inicioVidaSexual" id="inicioVidaSexual"
                min="1" max="2" placeholder="20">
            <span class="text-danger fw-normal d-none"></span>
        </div>

        <div class="form-group mt-2 group-gyo">
            <label for="numPartos" class="pb-1">Partos </label>
            <input class="form-control" type="number" name="numPartos" id="numPartos"
                min="1" max="2" placeholder="0">
            <span class="text-danger fw-normal d-none"></span>
        </div>

        <div class="form-group mt-2 group-gyo">
            <label for="numAbortos" class="pb-1">Abortos </label>
            <input class="form-control" type="number" name="numAbortos" id="numAbortos"
                min="1" max="2" placeholder="0">
            <span class="text-danger fw-normal d-none"></span>
        </div>

        <div class="form-group mt-2 group-gyo">
            <label for="numCesareas" class="pb-1">Cesareas </label>
            <input class="form-control" type="number" name="numCesareas" id="numCesareas"
                min="1" max="2" placeholder="0">
            <span class="text-danger fw-normal d-none"></span>
        </div>

        <div class="form-group mt-2 group-gyo">
            <label for="numGestas" class="pb-1">Gestas</label>
            <input class="form-control" type="number" name="numGestas" id="numGestas"
                max="2" placeholder="0">
            <span class="text-danger fw-normal d-none"></span>
        </div>
    </div>
</div>