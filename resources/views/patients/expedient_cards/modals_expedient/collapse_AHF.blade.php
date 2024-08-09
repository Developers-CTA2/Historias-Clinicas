<!--- Modal para editar el nombre de una enfermedad que pertenece a los antecedentes heredofamiliares  -->

{{-- <div class="modal fade" id="edit_AHF" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Antecedentes heredo-familiares</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <div class="d-flex row">
                        <p class="mb-0">Selecciona la enfermedad correcta</p>
                        <p class="fw-normal Old_disease text-muted fs-3 text-center">Selecciona la enfermedad correcta
                        </p>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="New_disease">Nombre de la enfermedad</label>

                                <select class="form-control" name="New_disease" id="New_disease">
                                    <option value="" disabled selected>Selecciona una opción</option>
                                    @foreach ($esp_ahf as $enfermedad)
                                        <option value="{{ $enfermedad->id_tipo_ahf }}">{{ $enfermedad->nombre }}
                                        </option>
                                    @endforeach
                                </select>

                                <span class="text-danger fw-normal" style=" display: none;">Dato
                                    no válido.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-red" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn-blue">Guardar</button>
            </div>
        </div>
    </div>
</div> --}}


<div class="col pt-1 Section-Collapse">
    <div class="collapse" id="Diseases">
        <div class="card card-body">
            <p class="text-center Type-accion p-0 m-0"> Antecedentes herdo-familiares</p>
            <div class="d-flex row">
                {{-- <p class="mb-0">Selecciona la enfermedad correcta</p> --}}
                <p class="fw-normal Old_disease text-muted fs-4 text-center">Selecciona la enfermedad correcta
                </p>
            </div>
            <div class="p-0 mb-2">
                <label for="New_disease">Nombre de la enfermedad</label>
                <select class="form-control" name="New_disease" id="New_disease">
                    <option value="" disabled selected>Selecciona una opción</option>
                    @foreach ($esp_ahf as $enfermedad)
                        <option value="{{ $enfermedad->id_especifica_ahf }}">{{ $enfermedad->nombre }}
                        </option>
                    @endforeach
                </select>

                <span class="text-danger fw-normal" style=" display: none;">Dato
                    no válido.</span>
            </div>

            <div class="d-flex justify-content-center pt-2 gap-2">
                <button class="btn-red cerrar fst-normal tooltip-container" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M3.47 3.47a.75.75 0 0 1 1.06 0L8 6.94l3.47-3.47a.75.75 0 1 1 1.06 1.06L9.06 8l3.47 3.47a.75.75 0 1 1-1.06 1.06L8 9.06l-3.47 3.47a.75.75 0 0 1-1.06-1.06L6.94 8L3.47 4.53a.75.75 0 0 1 0-1.06"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Cancelar
                                    <span class="tooltip-text">Cancelar edición.</span>
                                </button>
            
                <button type="button" class="btn-blue Save-changes fst-normal tooltip-container" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 32 32">
                                                                <path
                                                                    d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z" />
                                                            </svg>Guardar
                                                                <span class="tooltip-text2">Guardar cambios.</span></button>
            </div>
        </div>
    </div>
</div>





<!-- Ventana modal, por defecto no visiblel -->
<div id="edit_AHF" class="modal">
    <div class="contenido-modal">
        <div class="d-flex justify-content-between border p-2">

            <button type="button" class="btn-close  cerrar"></button>
        </div>

        <div class="col-12 pb-2">


            <div class="form-group">
                <div class="row">
                    <div class="form-group col-12">
                        <label for="New_disease">Nombre de la enfermedad</label>


                    </div>
                </div>
            </div>


        </div>

        <div class="d-flex justify-content-end border p-2 gap-2">
            <button type="button" class="btn-red cerrar">Cancelar</button>
            <button type="button" class="btn-blue">Guardar</button>
        </div>

        {{-- <span class="cerrar">&times;</span>
        <h2>Ventana modal</h2>
        <p>Esto es el texto de la ventana</p> --}}
    </div>
</div>
