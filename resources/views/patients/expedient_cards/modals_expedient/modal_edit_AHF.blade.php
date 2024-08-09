<!--- Modal para editar el nombre de una enfermedad que pertenece a los antecedentes heredofamiliares  -->

<div class="modal fade" id="edit_AHF" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                        <p class="fw-normal Old_disease text-muted fs-3 text-center">Selecciona la enfermedad correcta</p>
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
</div>
