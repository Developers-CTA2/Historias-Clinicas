   {{-- Moddal para editar el nombre de una alergia   --}}
        <div class="modal fade" id="Edit-addiction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                        <div  class="alert alert-danger alert-dismissible fade show pb-0 errorAlert" role="alert"
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
                                    <label for="A_nombre">Nombre</label>
                                    <input type="text" class="form-control" id="A_nombre" name="A_nombre">
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

                        <x-button-custom class="btn-blue-sec" text="Guarar cambios" id="E_addiction">
                            <x-slot name="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="currentColor" d="M12.079 2.25c-4.794 0-8.734 3.663-9.118 8.333H2a.75.75 0 0 0-.528 1.283l1.68 1.666a.75.75 0 0 0 1.056 0l1.68-1.666a.75.75 0 0 0-.528-1.283h-.893c.38-3.831 3.638-6.833 7.612-6.833a7.66 7.66 0 0 1 6.537 3.643a.75.75 0 1 0 1.277-.786A9.16 9.16 0 0 0 12.08 2.25"/><path fill="currentColor" d="M20.841 10.467a.75.75 0 0 0-1.054 0L18.1 12.133a.75.75 0 0 0 .527 1.284h.899c-.381 3.83-3.651 6.833-7.644 6.833a7.7 7.7 0 0 1-6.565-3.644a.75.75 0 1 0-1.276.788a9.2 9.2 0 0 0 7.84 4.356c4.809 0 8.766-3.66 9.151-8.333H22a.75.75 0 0 0 .527-1.284z" opacity=".5"/></svg>
                            </x-slot>
                        </x-button-custom>

                    </div>
                </div>
            </div>
        </div>