<!-- Modal -->
<div class="modal fade" id="add-APP" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar dato al expediente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    tooltipText="Recargar página." data-bs-dismiss="modal">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M3.47 3.47a.75.75 0 0 1 1.06 0L8 6.94l3.47-3.47a.75.75 0 1 1 1.06 1.06L9.06 8l3.47 3.47a.75.75 0 1 1-1.06 1.06L8 9.06l-3.47 3.47a.75.75 0 0 1-1.06-1.06L6.94 8L3.47 4.53a.75.75 0 0 1 0-1.06"
                                clip-rule="evenodd" />
                        </svg>
                    </x-slot>
                </x-button-custom>

                {{-- <button class="btn-red fst-normal tooltip-container p-1" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M3.47 3.47a.75.75 0 0 1 1.06 0L8 6.94l3.47-3.47a.75.75 0 1 1 1.06 1.06L9.06 8l3.47 3.47a.75.75 0 1 1-1.06 1.06L8 9.06l-3.47 3.47a.75.75 0 0 1-1.06-1.06L6.94 8L3.47 4.53a.75.75 0 0 1 0-1.06"
                            clip-rule="evenodd" />
                    </svg>
                    Cancelar
                    <span class="tooltip-text">Cancelar acción.</span>
                </button> --}}


                {{-- <button type="button" class="btn btn-secondary" >Close</button> --}}
                <x-button-custom type="button"
                    class="btn-blue-sec justify-content-center justify-content-lg-start" text="Guardar"
                    tooltipText="Guardar cambios." id="saveAPP">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20">
                            <path d="m15.3 5.3l-6.8 6.8l-2.8-2.8l-1.4 1.4l4.2 4.2l8.2-8.2z" />
                        </svg>
                    </x-slot>
                </x-button-custom>


                {{-- <button class="btn-blue-sec fst-normal tooltip-container p-1" type="button" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20">
                        <path d="m15.3 5.3l-6.8 6.8l-2.8-2.8l-1.4 1.4l4.2 4.2l8.2-8.2z" />
                    </svg>
                    Guardar
                    <span class="tooltip-text">Guardar datos.</span>
                </button> --}}
                {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
            </div>
        </div>
    </div>
</div>
