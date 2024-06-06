 {{-- Modal para la edicion de los datos del usuario --}}
        <div class="modal fade " id="EditData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog  modal-md">
                <div class="modal-content">
                    {{-- Header de color azul --}}
                    <div class="modal-header bg-blue">
                        <h5 class="modal-title" id="staticBackdropLabel">Editar datos del usuario</h5>
                        <button type="button" class="btn-custom-close" data-bs-dismiss="modal" aria-label="Close"><svg
                                xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                <path fill="#ffffff"
                                    d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
                            </svg></button>
                    </div>
                    <div class="modal-body">
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
                        <div class="row d-flex mx-2">
                            <p class="text-center"> Corrige los datos érroneos o que hayan cambiado.</p>


                            <div id="errorAlert" class="alert alert-danger alert-dismissible fade show pb-0"
                                role="alert" style="display: none;">
                                <strong>¡Ups! Algo salió mal.</strong>
                                <ul id="errorList"></ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Cerrar"></button>

                            </div>


                            <div class="col-lg-6 col-md-6 col-sm-12 mt-0">
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-12">
                                            <label for="m-email">Correo </label>
                                            <input class="form-control form-disabled" type="text" name="m-email"
                                                id="m-email" value="{{ $usuario->email }}">
                                            <span class="text-danger fw-normal" style=" display: none;">Correo no
                                                válido.</span>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="m-cedula">Cedula </label>
                                            <input class="form-control form-disabled" type="text" name="m-cedula"
                                                id="m-cedula" value="{{ $usuario->cedula ?? '' }}" maxlength="8">
                                            <span class="text-danger fw-normal" style=" display: none;">Cedula no
                                                válido.</span>
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- FIN contenedor 1  -->
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-12">
                                            <label for="user-type">Tipo de usuario </label>
                                            @php
                                                $Admin = $roleName == 'Administrador' ? 'selected' : '';
                                                $prestMed = $roleName === 'Prestador de medicina' ? 'selected' : '';
                                                $prestNut = $roleName === 'Prestador de nutrición' ? 'selected' : '';
                                            @endphp

                                            <select class="form-control" id="user-type" name="user-type">
                                                <option value="1" {{ $Admin }}>Doctor</option>
                                                <option value="2" {{ $prestMed }}>Prestador de medicina</option>
                                                <option value="3" {{ $prestNut }}>Prestador de nutrición</option>
                                            </select>

                                            <span class="text-danger fw-normal" style=" display: none;">Rol no
                                                válido.</span>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="m-estado">Estado </label>
                                            @php
                                                $StatusActivo = $usuario->estado == 'Activo' ? 'selected' : '';
                                                $StatusInactivo = $usuario->estado == 'Inactivo' ? 'selected' : '';
                                            @endphp


                                            <label for="m-estado">Estado</label>
                                            <select class="form-control" id="m-estado" name="m-estado">
                                                <option value="1" {{ $StatusActivo }}>Activo</option>
                                                <option value="2" {{ $StatusInactivo }}>Inactivo</option>
                                            </select>

                                            <span class="text-danger fw-normal" style=" display: none;">Estado no
                                                válido.</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-red py-1" data-bs-dismiss="modal">Cerrar</button>
                        {{-- Agregar fill="currentColor"para aplicar la animacion --}}
                        <button class="btn-blue-sec fst-normal py-1" type="button" id="EditUser">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                <path fill="currentColor" d="m15.3 5.3l-6.8 6.8l-2.8-2.8l-1.4 1.4l4.2 4.2l8.2-8.2z" />
                            </svg>
                            Editar
                        </button>
                    </div>
                </div>
            </div>
        </div>