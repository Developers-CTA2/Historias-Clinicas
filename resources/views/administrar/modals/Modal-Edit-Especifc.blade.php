 <div class="modal fade" id="Details-diseasse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-blue">
                        <h5 class="modal-title" id="staticBackdropLabel">Detalles del registro</h5>
                        <button type="button" class="btn-custom-close" data-bs-dismiss="modal" aria-label="Close"><svg
                                xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                <path fill="#ffffff"
                                    d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
                            </svg></button>
                    </div>
                    
                    <div class="modal-body">
                        {{-- Alerta de los datos no han cambiado --}}
                        <div id="Alerta_err" class="p-0 m-0 d-none">
                            <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between p-0 m-0"
                                role="alert">
                                <p class="p-2 mb-1"> <strong>Ooops! </strong> Parece que no se ha realizado ningun cambio.
                                </p>
                                <button class="btn fst-italic animated-icon button-cancel  rigth-0" data-bs-dismiss="alert">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                        {{-- Errores de laravel  --}}
                        <div class="alert alert-danger alert-dismissible fade show pb-0 errorAlert" role="alert"
                            style="display: none;">
                            <strong>¡Ups! Algo salió mal.</strong>
                            <ul class="errorList"></ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>

                        </div>

                        <div class="row col-12 pt-1">
                            <p class="text-center mb-0">Corrige los datos érroneos.</p>
                        </div>
                        <div class="row mt-0 pt-0">
                            <div class="col-12 px-3 ">
                                <div class="form-group pt-2">

                                    <div class="row Cont-edit">
                                        <div class="form-group col-10">
                                            <label>Tipo de enfermedad</label>
                                            <div id="Type" class="fw-bold"></div>
                                        </div>
                                        <div
                                            class="form-group col-2 d-flex justify-content-center align-items-center tooltip-container">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                                viewBox="0 0 48 48">
                                                <circle cx="24" cy="24" r="21" fill="#2196F3" />
                                                <path fill="#fff" d="M22 22h4v11h-4z" />
                                                <circle cx="24" cy="16.5" r="2.5" fill="#fff" />
                                            </svg>

                                            <span class="tooltip-text">Doble clic <i> aqui </i>para editar datos.</span></button>

                                        </div>
                                    </div>

                                    <div class="Edit-datos-input m-2 d-none">
                                        <label for="E_type">Selecciona un tipo <span class="red-color"> *</span></label>
                                        <select class="form-control" name="E_type" id="E_type">
                                            <option value="0" selected>Selecciona una opción</option>
                                            @foreach ($Types as $Type)
                                                <option value="{{ $Type->id_tipo_ahf }}">{{ $Type->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger fw-normal" id="error-message" style="display: none;">Tipo
                                            no válido.</span>
                                    </div>
                                </div>

                                <div class="form-group pt-2">
                                    <label for="E_nombre">Nombre de la enfermedad  <span class="red-color"> *</span></label>
                                    <input type="text" class="form-control" id="E_nombre" name="E_nombre">
                                    <span class="text-danger fw-normal" style=" display: none;">Nombre no válido.</span>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">

                        <x-button-custom class="btn-red" data-bs-dismiss="modal" text="Cancelar"  tooltipText="Cancelar acción">
                            <x-slot name="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 32 32"><path fill="currentColor" d="M17.414 16L24 9.414L22.586 8L16 14.586L9.414 8L8 9.414L14.586 16L8 22.586L9.414 24L16 17.414L22.586 24L24 22.586z"/></svg>
                            </x-slot>

                        </x-button-custom>

                        <x-button-custom class="btn-blue-sec" text="Guardar" id="E_disease"  tooltipText="Guardar cambios">
                            <x-slot name="icon">
 <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.25 21v-4.765a1.59 1.59 0 0 0-1.594-1.588H9.344a1.59 1.59 0 0 0-1.594 1.588V21m8.5-17.715v2.362a1.59 1.59 0 0 1-1.594 1.588H9.344A1.59 1.59 0 0 1 7.75 5.647V3m8.5.285A3.2 3.2 0 0 0 14.93 3H7.75m8.5.285c.344.156.661.374.934.645l2.382 2.375A3.17 3.17 0 0 1 20.5 8.55v9.272A3.18 3.18 0 0 1 17.313 21H6.688A3.18 3.18 0 0 1 3.5 17.823V6.176A3.18 3.18 0 0 1 6.688 3H7.75"/></svg>                            </x-slot>
                        </x-button-custom>

                    </div>
                </div>
            </div>
        </div>