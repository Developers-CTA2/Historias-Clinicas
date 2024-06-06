   {{-- Moddal para agregar un registro de una alergia al sistema --}}
   <div class="modal fade" id="Add-addiction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
       aria-labelledby="staticBackdropLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header bg-blue">
                   <h5 class="modal-title" id="staticBackdropLabel">Agregar una toxicomnía</h5>
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
                   <div id="errorAlert" class="alert alert-danger alert-dismissible fade show pb-0" role="alert"
                       style="display: none;">
                       <strong>¡Ups! Algo salió mal.</strong>
                       <ul id="errorList"></ul>
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                   </div>
                   <div class="row col-12 pt-1">
                       <p class="text-center mb-0">Ingresa los datos solicitados.</p>
                   </div>
                   <div class="row mt-0 pt-0">
                       <div class="col-12 px-3 ">
                           <div class="form-group pt-2">
                               <label for="New_nombre">Nombre</label>
                               <input type="text" class="form-control" id="New_nombre" name="New_nombre">
                               <span class="text-danger fw-normal" style=" display: none;">Nombre no válido.</span>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn-red py-1" data-bs-dismiss="modal">Cerrar</button>
                   <button class="btn-blue-sec fst-normal py-1" type="button" id="Add_addiction">
                       <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                           <path fill="currentColor" d="m15.3 5.3l-6.8 6.8l-2.8-2.8l-1.4 1.4l4.2 4.2l8.2-8.2z" />
                       </svg>
                       Guardar
                   </button>
               </div>
           </div>
       </div>
   </div>
