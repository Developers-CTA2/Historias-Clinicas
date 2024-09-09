
        {{-- Modal pra agregra una nueva enfermedad especifica  --}}
        <div class="modal fade" id="Add-specific" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-blue">
                        <h5 class="modal-title" id="staticBackdropLabel">Agregar enfermedad específica</h5>
                        <button type="button" class="btn-custom-close" data-bs-dismiss="modal" aria-label="Close"><svg
                                xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                <path fill="#ffffff"
                                    d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
                            </svg></button>
                    </div>
                    <div class="modal-body">

                        {{-- Alerta de los datos no han cambiado --}}
                        <div id="Alerta_add" class="p-0 m-0 d-none">
                            <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between p-0 m-0"
                                role="alert">
                                <p class="p-2 mb-1"> <strong>Ooops! </strong> Parece que no se ha realizado ningun cambio.
                                </p>
                                <button class="btn fst-italic animated-icon button-cancel  rigth-0"
                                    data-bs-dismiss="alert">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                        
                        {{-- Errores de laravel  --}}
                        <div i class="alert alert-danger alert-dismissible fade show pb-0 errorAlert" role="alert"
                            style="display: none;">
                            <strong>¡Ups! Algo salió mal.</strong>
                            <ul class="errorList"></ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Cerrar"></button>

                        </div>

                        <div class="row col-12 pt-1">
                            <p class="text-center mb-0">Selecciona un tipo, después ecribe el nombre.</p>
                        </div>

                        <div class="row mt-0 pt-0">
                            <div class="col-12 px-3 ">
                                <div class="form-group pt-2">

                                    <div class="m-2 ">
                                        <label for="S_type">Selecciona un tipo</label>
                                        <select class="form-control" name="S_type" id="S_type">
                                            <option value="" deisabled selected>Selecciona una opción</option>
                                            @foreach ($Types as $Type)
                                                <option value="{{ $Type->id_tipo_ahf }}">{{ $Type->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger fw-normal" id="error-message"
                                            style="display: none;">Tipo
                                            no válido.</span>
                                    </div>
                                </div>

                                <div class="form-group pt-2">
                                    <label for="New_nombre">Nombre de la enfermedad</label>
                                    <input type="text" class="form-control" id="New_nombre" name="New_nombre">
                                    <span class="text-danger fw-normal" style=" display: none;">Nombre no válido.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <x-button-custom class="btn-red" data-bs-dismiss="modal" text="Cancelar">
                            <x-slot name="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 32 32"><path fill="currentColor" d="M17.414 16L24 9.414L22.586 8L16 14.586L9.414 8L8 9.414L14.586 16L8 22.586L9.414 24L16 17.414L22.586 24L24 22.586z"/></svg>
                            </x-slot>

                        </x-button-custom>

                        <x-button-custom class="btn-blue-sec" text="Guardar" id="Add_disease">
                            <x-slot name="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20">
                                    <path fill="currentColor" d="m15.3 5.3l-6.8 6.8l-2.8-2.8l-1.4 1.4l4.2 4.2l8.2-8.2z" />
                                </svg>
                            </x-slot>
                        </x-button-custom>
                        
                    </div>
                </div>
            </div>
        </div>