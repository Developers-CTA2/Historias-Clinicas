{{-- Collapse para edicion y agregar un nuevo antecedente heredo-familiar --}}

<div class="col pt-1 Section-Collapse">
    <div class="collapse" id="Diseases_APP">
        <div class="card card-body">
            <p class="text-center Type-accion p-0 m-0"> Enfermedad</p>
            <div class="d-flex row">
                <p class="fw-normal Old_disease text-muted fs-6 text-center">Selecciona una enfermedad
                </p>
            </div>
            <div class="p-0 mb-1">
                <label for="New_disease">Nombre de la enfermedad</label>
                <select class="form-control" name="New_disease" id="New_disease">
                    <option value="" disabled selected>Selecciona una opción</option>
                    @foreach ($Ant_pp as $enfermedad)
                        <option value="{{ $enfermedad->id_especifica_ahf }}">{{ $enfermedad->nombre }}
                        </option>
                    @endforeach
                </select>

                <span class="text-danger fw-normal" style=" display: none;">Dato
                    no válido.</span>
            </div>

            <div class="d-flex justify-content-center pt-2 gap-2">
                {{-- <button class="btn-red cerrar fst-normal tooltip-container" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M3.47 3.47a.75.75 0 0 1 1.06 0L8 6.94l3.47-3.47a.75.75 0 1 1 1.06 1.06L9.06 8l3.47 3.47a.75.75 0 1 1-1.06 1.06L8 9.06l-3.47 3.47a.75.75 0 0 1-1.06-1.06L6.94 8L3.47 4.53a.75.75 0 0 1 0-1.06"
                            clip-rule="evenodd" />
                    </svg>
                    Cancelar
                    <span class="tooltip-text">Cancelar edición.</span>
                </button>

                <button type="button" class="btn-blue Save-changes fst-normal tooltip-container">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32">
                        <path
                            d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z" />
                    </svg>Guardar
                    <span class="tooltip-text2">Guardar cambios.</span></button> --}}

                     <x-button-custom type="button"
                    class="btn-red justify-content-center justify-content-lg-start cerrar" text="Cancelar"
                    tooltipText="Cancelar acción">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M3.47 3.47a.75.75 0 0 1 1.06 0L8 6.94l3.47-3.47a.75.75 0 1 1 1.06 1.06L9.06 8l3.47 3.47a.75.75 0 1 1-1.06 1.06L8 9.06l-3.47 3.47a.75.75 0 0 1-1.06-1.06L6.94 8L3.47 4.53a.75.75 0 0 1 0-1.06"
                            clip-rule="evenodd" />
                    </svg>
                    </x-slot>
                </x-button-custom>
 
                     <x-button-custom type="button"
                    class="btn-blue justify-content-center justify-content-lg-start Save-changes" text="Guardar"
                    tooltipText="Guardar dato">
                    <x-slot name="icon">
                       <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32">
                        <path
                            d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z" />
                    </svg>
                    </x-slot>
                </x-button-custom>
            </div>
        </div>
    </div>
</div>
