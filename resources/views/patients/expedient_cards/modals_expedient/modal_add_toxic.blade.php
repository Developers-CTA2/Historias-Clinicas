<!-- Modal -->
<div class="modal fade" id="add-toxic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar toxicomanía</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="p-0 m-0 Add_drug d-none animate__animated animate__fadeInUp">
                        <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between p-0 m-0"
                            role="alert">
                            <p class="p-2 mb-0 me-3 alert-add-Drug">
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-12 p-2">
                    <div class="row d-flex justify-content-start">
                        <label for="new_toxic">Nombre de la toxicomanía <span class="red-color"> *</span></label>
                        <select class="form-control" name="new_toxic" id="new_toxic">
                            <option value="" disabled selected>Selecciona una opción</option>
                            @foreach ($Toxicomanias as $Toxicomania)
                                <option value="{{ $Toxicomania->id }}">{{ $Toxicomania->nombre }}
                                </option>
                            @endforeach
                        </select>

                        <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>
                    </div>


                    <div class="col-12 mt-3">
                        {{-- Section for dates and quantity smoking --}}
                        <section id="optionSmoking" class="md-w-custom d-none animate__animated animate__fadeInUp">

                            <div class="form-group mb-3">
                                <label for="desdeCuandoFuma" class="pb-1">Desde cuando (años) <span class="red-color">
                                        *</span></label>
                                <input class="form-control" type="number" id="desdeCuandoFuma" min="1" />
                                <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>
                            </div>

                            <div class="form-group mb-2">
                                <label for="cantidadCigarros" class="pb-1">Cantidad de cigarros por día <span
                                        class="red-color">
                                        *</span></label>
                                <input class="form-control" type="number" id="cantidadCigarros" min="1" />
                                <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>
                            </div>

                            <div class="form-group container-bg-custom text-center sm-h rounded-2">
                                <h5 class="fw-bold pt-2">Riesgo de EPOC</h5>
                                <p id="riegoEPOC"><span class="badge badge-custom-success">Nulo</span></p>
                            </div>
                        </section>

                        <section id="optionOthersDrugAddiction"
                            class="md-w-custom d-none animate__animated animate__fadeInUp">
                            <div class="form-group mb-4">
                                <label for="desdeCuandoOtros" class="pb-1">Desde
                                    cuando
                                    (años) <span class="red-color">
                                        *</span></label>
                                <input class="form-control" type="number" id="desdeCuandoOtros" />
                                <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>
                            </div>

                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Especifica la toxicomanía en específico" id="descripcionOtros"></textarea>
                                <label for="descripcionOtros" class="text-dark">Descripción <span class="red-color">
                                        *</span></label>
                                <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>
                            </div>
                        </section>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-red fst-normal tooltip-container p-1" type="button" data-bs-dismiss="modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M3.47 3.47a.75.75 0 0 1 1.06 0L8 6.94l3.47-3.47a.75.75 0 1 1 1.06 1.06L9.06 8l3.47 3.47a.75.75 0 1 1-1.06 1.06L8 9.06l-3.47 3.47a.75.75 0 0 1-1.06-1.06L6.94 8L3.47 4.53a.75.75 0 0 1 0-1.06"
                            clip-rule="evenodd" />
                    </svg>
                    Cancelar
                    <span class="tooltip-text">Cancelar acción.</span>
                </button>
                {{-- <button type="button" class="btn btn-secondary" >Close</button> --}}
                <button class="btn-blue-sec fst-normal tooltip-container p-1" type="button" id="saveDrugs">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20">
                        <path d="m15.3 5.3l-6.8 6.8l-2.8-2.8l-1.4 1.4l4.2 4.2l8.2-8.2z" />
                    </svg>
                    Guardar
                    <span class="tooltip-text">Guardar datos.</span>
                </button>
                {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
            </div>
        </div>
    </div>
</div>
