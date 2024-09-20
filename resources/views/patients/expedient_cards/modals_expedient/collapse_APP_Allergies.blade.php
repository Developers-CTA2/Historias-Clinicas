{{-- Collapse para edicion y agregar un nuevo antecedente heredo-familiar --}}

<div class="col pt-1 Section-Collapse">
    <div class="collapse" id="Allergies_APP">
        <div class="card card-body">
            <p class="text-center Type-accion-allergy p-0 m-0"> Alergias </p>
            <div class="d-flex row">
                <p class="fw-normal Old_allergy text-muted fs-6 text-center">Selecciona una Alergía
                </p>
            </div>
            <div class="p-0 mb-1">
                <label for="New_allergy">Nombre de la alergia <span class="red-color"> *</span> </label>
                <select class="form-control" name="New_allergy" id="New_allergy">
                    <option value="" disabled selected>Selecciona una opción</option>
                    @foreach ($SelectAlergias as $Alergia)
                        <option value="{{ $Alergia->id_alergia }}">{{ $Alergia->nombre }}
                        </option>
                    @endforeach
                </select>

                <span class="text-danger fw-normal" style=" display: none;">Dato
                    no válido.</span>
            </div>
            <div class="p-0 mb-1">
                <div class="form-group">
                    <label for="Description">Descripción <span class="red-color"> *</span> </label>
                    <textarea class="form-control" id="Description" rows="2"></textarea>
                    <span class="text-danger fw-normal" style=" display: none;">Dato
                        no válido.</span>
                </div>
            </div>

            <div class="d-flex justify-content-center pt-2 gap-2">
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
                    class="btn-blue-sec justify-content-center justify-content-lg-start save-Allergy" text="Guardar"
                    tooltipText="Guardar cambios">
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
