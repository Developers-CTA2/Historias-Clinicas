<!-- Modal para agregar un registro de Hospitalizacion, cirugias, transfuciones o  traumatismos -->
<div class="modal fade" id="add-APP" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <h5 class="modal-title" id="staticBackdropLabel">Modificar expediente</h5>
                <button type="button" class="btn-custom-close" data-bs-dismiss="modal" aria-label="Close"><svg
                        xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                        <path fill="#ffffff"
                            d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
                    </svg></button>
            </div>
            <div class="modal-body">
                <div>
                    {{-- Alerta de edicion  --}}
                    <x-alert-manage containerClass="Modal-Alert" textClass="Modal-Alert-Text">
                    </x-alert-manage>
                </div>

                <h5 class="text-center Title-accion p-0">Acción</h5>
                <p class="text-center text-accion">Descripción</p>

                <div class="col-12 px-2">
                    <div class="row d-flex justify-content-start">
                        <label for="New-Data">Fecha <span class="red-color"> *</span></label>
                        <input class="form-control" type="date" id="New-Data" />
                        <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>
                    </div>

                    <div class="row d-flex justify-content-start mt-2">
                        <label for="text_Description">Descripción <span class="red-color"> *</span></label>
                        <textarea class="form-control" id="text_Description" rows="2"></textarea>
                        <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>
                    </div>
                </div>
            </div>

            <div class="modal-footer">

                <x-button-custom type="button"
                    class="btn-red justify-content-center justify-content-lg-start btn-refresh" text="Cerrar"
                    tooltipText="Cancelar acción" data-bs-dismiss="modal">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M3.47 3.47a.75.75 0 0 1 1.06 0L8 6.94l3.47-3.47a.75.75 0 1 1 1.06 1.06L9.06 8l3.47 3.47a.75.75 0 1 1-1.06 1.06L8 9.06l-3.47 3.47a.75.75 0 0 1-1.06-1.06L6.94 8L3.47 4.53a.75.75 0 0 1 0-1.06"
                                clip-rule="evenodd" />
                        </svg>
                    </x-slot>
                </x-button-custom>
                <x-button-custom type="button" class="btn-blue-sec justify-content-center justify-content-lg-start"
                    text="Guardar" tooltipText="Guardar cambios." id="saveAPP">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                             <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                 stroke-width="1.5"
                                 d="M16.25 21v-4.765a1.59 1.59 0 0 0-1.594-1.588H9.344a1.59 1.59 0 0 0-1.594 1.588V21m8.5-17.715v2.362a1.59 1.59 0 0 1-1.594 1.588H9.344A1.59 1.59 0 0 1 7.75 5.647V3m8.5.285A3.2 3.2 0 0 0 14.93 3H7.75m8.5.285c.344.156.661.374.934.645l2.382 2.375A3.17 3.17 0 0 1 20.5 8.55v9.272A3.18 3.18 0 0 1 17.313 21H6.688A3.18 3.18 0 0 1 3.5 17.823V6.176A3.18 3.18 0 0 1 6.688 3H7.75" />
                         </svg>
                    </x-slot>
                </x-button-custom>
            </div>
        </div>
    </div>
</div>
