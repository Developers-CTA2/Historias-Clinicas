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



                 {{-- Alerta de edicion  --}}
                 <x-alert-manage containerClass="Alerta_user" textClass="Alerta_user_text">
                 </x-alert-manage>

                 <div class="row d-flex mx-2 mt-1">
                     <p class="text-center"> Corrige los datos érroneos o que hayan cambiado.</p>


                     <div class="alert alert-danger alert-dismissible fade show pb-0 errorAlert" role="alert"
                         style="display: none;">
                         <strong>¡Ups! Algo salió mal.</strong>
                         <ul class="errorList"></ul>
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>

                     </div>


                     <div class="col-lg-6 col-md-6 col-sm-12 mt-0">
                         <div class="form-group">
                             <div class="row pt-2">
                                 <div class="form-group col-12 mb-2">
                                     <label for="m-email">Correo <span class="red-color"> *</span></label>
                                     <input class="form-control form-disabled" type="text" name="m-email"
                                         id="m-email" value="{{ $usuario->email }}">
                                     <span class="text-danger fw-normal" style=" display: none;">Correo no
                                         válido.</span>
                                 </div>

                                 <div class="form-group col-12">
                                     @php
                                         $StatusActivo = $usuario->estado == 'Activo' ? 'selected' : '';
                                         $StatusInactivo = $usuario->estado == 'Inactivo' ? 'selected' : '';
                                     @endphp


                                     <label for="m-estado">Estado <span class="red-color"> *</span></label>
                                     <select class="form-control" id="m-estado" name="m-estado">
                                         <option value="1" {{ $StatusActivo }}>Activo</option>
                                         <option value="2" {{ $StatusInactivo }}>Inactivo</option>
                                     </select>

                                     <span class="text-danger fw-normal" style=" display: none;">Estado no
                                         válido.</span>
                                 </div>


                             </div>
                         </div>
                     </div> <!-- FIN contenedor 1  -->
                     <div class="col-lg-6 col-md-6 col-sm-12">
                         <div class="form-group">
                             <div class="row pt-2">
                                 <div class="form-group col-12 mb-2">
                                     <label for="user-type">Tipo de usuario <span class="red-color"> *</span></label>
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
                                 <div class="form-group col-12 div-cedula">
                                     <label for="m-cedula">Cédula profesional <span class="red-color div-ced">
                                             *</span></label>
                                     @if ($roleName == 'Administrador')
                                         <input class="form-control form-disabled" type="text" name="m-cedula"
                                             id="m-cedula" value="{{ $usuario->cedula }}" maxlength="10" >
                                     @else
                                      <input class="form-control form-disabled" type="text" name="m-cedula"
                                             id="m-cedula" value="{{ $usuario->cedula }}" maxlength="10"  disabled="disabled">
                                     @endif
                                     <span class="text-danger fw-normal" style=" display: none;">Cédula no
                                         válido.</span>
                                 </div>

                                 {{-- <div class="form-group col-12 div-cedula">
                                     <label for="Usercedula">Cédula profesional <span
                                             class="red-color div-ced">*</span></label>
                                     @if ($roleName == 'Administrador')
                                         <input class="form-control form-disabled mb-2" type="text" name="Usercedula"
                                             id="Usercedula" maxlength="10">
                                     @else
                                         <input class="form-control form-disabled mb-2" type="text" name="Usercedula"
                                             id="Usercedula" maxlength="10" disabled="disabled">
                                     @endif
                                     <span class="text-danger fw-normal" style="display: none;">Cédula no válido.</span>
                                 </div> --}}








                             </div>
                         </div>
                     </div>



                 </div>
             </div>
             <div class="modal-footer">

                 <x-button-custom class="btn-red cerrar-btn" data-bs-dismiss="modal" text="Cerrar"
                     tooltipText="Cancelar acción">
                     <x-slot name="icon">
                         <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                             <path fill="currentColor"
                                 d="m6.4 18.308l-.708-.708l5.6-5.6l-5.6-5.6l.708-.708l5.6 5.6l5.6-5.6l.708.708l-5.6 5.6l5.6 5.6l-.708.708l-5.6-5.6z" />
                         </svg>
                     </x-slot>
                 </x-button-custom>

                 <x-button-custom class="btn-blue-sec" text="Guardar" id="EditUser" tooltipText="Guardar cambios">
                     <x-slot name="icon">
                         <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                             <path fill="none" stroke="currentColor" stroke-linecap="round"
                                 stroke-linejoin="round" stroke-width="1.5"
                                 d="M16.25 21v-4.765a1.59 1.59 0 0 0-1.594-1.588H9.344a1.59 1.59 0 0 0-1.594 1.588V21m8.5-17.715v2.362a1.59 1.59 0 0 1-1.594 1.588H9.344A1.59 1.59 0 0 1 7.75 5.647V3m8.5.285A3.2 3.2 0 0 0 14.93 3H7.75m8.5.285c.344.156.661.374.934.645l2.382 2.375A3.17 3.17 0 0 1 20.5 8.55v9.272A3.18 3.18 0 0 1 17.313 21H6.688A3.18 3.18 0 0 1 3.5 17.823V6.176A3.18 3.18 0 0 1 6.688 3H7.75" />
                         </svg>
                     </x-slot>
                 </x-button-custom>
             </div>
         </div>
     </div>
 </div>
