<div class="card">
    <div class="card-header text-center bg-blue">
        Ginecología y obstetricia
    </div>
    <div class="card-body">
        @php
            use Carbon\Carbon;
        @endphp
        <div class="row col-12">
            @role('Administrador')
                @php
                    date_default_timezone_set('UTC');
                @endphp
                <span class="d-none" id="actualDate"> {{ date('Y-m-d') }}</span>
                <span class="d-none" id="idRegister"> {{ $gyo->id }}</span>
                <div class="d-flex justify-content-between">
                    <div>
                        {{-- Alerta de edicion  --}}
                        <x-alert-manage containerClass="Gyo" textClass="Gyo-Text">
                        </x-alert-manage>
                    </div>
                    <div class="toggle tooltip-container">
                        <input type="checkbox" id="Edit-Gyo">
                        <label for="Edit-Gyo" class="label-check"></label>
                        <span class="tooltip-text">Habilitar edición.</span>
                    </div>
                </div>
            @endrole

            <div class="col-lg-6 col-md-6 col-sm-12 ps-3 mt-2">
                <div class="row ms-1">
                    <h5 class="aling-items-center ps-0">
                        <span class="pe-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 14 14">
                                <path fill="#db2777" fill-rule="evenodd"
                                    d="M7 1.5A3.25 3.25 0 1 0 7 8a3.25 3.25 0 0 0 0-6.5m4.75 3.25a4.75 4.75 0 0 1-4 4.691v1.309h.75a.75.75 0 0 1 0 1.5h-.75v1a.75.75 0 0 1-1.5 0v-1H5.5a.75.75 0 0 1 0-1.5h.75V9.441a4.751 4.751 0 1 1 5.5-4.691"
                                    clip-rule="evenodd" />
                            </svg> </span> Ginecología
                    </h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-start pt-0">
                            <div class="form-group col-6 col-sm-12 pt-2">
                                <p class="fw-bold mb-0">Menarca: </p>
                                <div class="mt-0 Old-Data"> <span id="menarca">{{ $gyo->menarca ?? '--' }}</span> años
                                </div>

                                <div class="mt-2 mb-1 input-Gyo d-none animate__animated animate__fadeInUp">
                                    <label for="new_menarca">Menarca: <span class="red-color"> *</span></label>
                                    <input class="form-control form-disabled" type="number" name="new_menarca"
                                        id="new_menarca" value="{{ $gyo->menarca }}">
                                    <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item pt-0">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12 pt-2">
                                    <p class="fw-bold mb-0">F. última menstruación:</p>
                                    @if (empty($gyo->fecha_um))
                                        --
                                    @else
                                        <div class="mt-0 Old-Data">
                                            {{ Carbon::parse($gyo->fecha_um)->locale('es')->isoFormat('LL') }}</div>
                                    @endif
                                    <div class="d-none" id="last_m"> {{ $gyo->fecha_um }}</div>

                                    <div class="mt-2 mb-1  input-Gyo d-none animate__animated animate__fadeInUp">
                                        <label for="new_last_m">F. última menstruación: <span class="red-color">
                                                *</span></label>
                                        <input class="form-control form-disabled" type="date" name="new_last_m"
                                            id="new_last_m" value="{{ $gyo->fecha_um }}">
                                        <span class="text-danger fw-normal" style=" display: none;">Dato no
                                            válido.</span>
                                    </div>

                                </div>

                                <div class="form-group col-md-6 col-sm-12 pt-2 div-cedula">
                            
                                    <p class="fw-bold mb-0">S. de gestación: </p>
                                    <div class="mt-0 Old-Data"> <span id="s_gest">{{ $gyo->s_gestacion ?? '--' }}</span>
                                        semanas
                                    </div>
                                    <div class="mt-2 mb-1 input-Gyo d-none animate__animated animate__fadeInUp">
                                        <label for="new_s_gest">S. de gestación: <span class="red-color">
                                                *</span></label>
                                        <input class="form-control form-disabled" type="number" name="new_s_gest"
                                            id="new_s_gest" value="{{ $gyo->s_gestacion }}">
                                        <span class="text-danger fw-normal" style=" display: none;">Dato no
                                            válido.</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item pt-0">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12 pt-2">
                                    <p class="fw-bold mb-0">Ciclos:</p>
                                    <div class="mt-0  Old-Data" id="ciclos"> {{ $gyo->ciclos ?? '--' }} </div>

                                    <div class="mt-2 mb-1 input-Gyo d-none animate__animated animate__fadeInUp">

                                        <label for="new_ciclos">Ciclos: <span class="red-color"> *</span></label>
                                        @php

                                            $opc1 = $gyo->ciclos == 'Regular' ? 'selected' : '';
                                            $opc2 = $gyo->ciclos === 'Irregular' ? 'selected' : '';

                                        @endphp
                                        <select class="form-control" id="new_ciclos" name="new_ciclos">
                                            <option value="Regular" {{ $opc1 }}>Regular</option>
                                            <option value="Irregular" {{ $opc2 }}> Irregular </option>
                                        </select>
                                        <span class="text-danger fw-normal" style=" display: none;">Dato no
                                            válido.</span>
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-sm-12 pt-2 div-cedula">
                                    @php
                                        $string = $gyo->dias_x_dias;
                                        $cadena = explode(',', $string);
                                    @endphp

                                    <p class="fw-bold mb-0">Días X días: </p>
                                    <div class="mt-0  Old-Data">
                                        {{ ($cadena[0] ?? '--') . ' X ' . ($cadena[1] ?? '--') }}
                                        <span class="d-none" id="dias_1"> {{ $cadena[0] }} </span>
                                        <span class="d-none" id="dias_2"> {{ $cadena[1] }} </span>
                                    </div>

                                    <div class="row mt-2 mb-1 input-Gyo d-none animate__animated animate__fadeInUp">
                                        <label for="new_dias_1">Días X días <span class="red-color"> *</span></label>
                                        <div class="d-flex gap-3">
                                            <input class="form-control form-disabled" type="number"
                                                name="new_dias_1" id="new_dias_1" value="{{ $cadena[0] }}">
                                            <span class="pt-2"><strong> X </strong></span>
                                            <input class="form-control form-disabled" type="number"
                                                name="new_dias_2" id="new_dias_2" value="{{ $cadena[1] }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item pt-0">
                            <div class="row">
                                <div class="form-group col-6 pt-2">
                                    <p class="fw-bold mb-0">Inicio de vida sexual:</p>
                                      <div class="mt-0 Old-Data"> <span id="inicio">{{ $gyo->ivs ?? '--' }}</span> años
                                </div>
                                    {{-- <div class="mt-0 Old-Data" id="inicio"> {{ $gyo->ivs ?? '--' }} </div> --}}

                                    <div class="mt-2 mb-1  input-Gyo d-none animate__animated animate__fadeInUp">
                                        <label for="new_inicio">Inicio de vida sexual: <span class="red-color">
                                                *</span></label>
                                        <input class="form-control form-disabled" type="number" name="new_inicio"
                                            id="new_inicio" value="{{ $gyo->ivs }}">
                                        <span class="text-danger fw-normal" style=" display: none;">Dato no
                                            válido.</span>
                                    </div>
                                </div>

                                <div class="form-group col-6 pt-2 div-cedula">
                                    <p class="fw-bold mb-0">Num. parejas:</p>
                                    <div class="mt-0 Old-Data" id="parejas"> {{ $gyo->parejas_s ?? '--' }}</div>

                                    <div class="mt-2 mb-1 input-Gyo d-none animate__animated animate__fadeInUp">
                                        <label for="new_parejas">Num. parejas: <span class="red-color">
                                                *</span></label>
                                        <input class="form-control form-disabled" type="number" name="new_parejas"
                                            id="new_parejas" value="{{ $gyo->parejas_s }}">
                                        <span class="text-danger fw-normal" style=" display: none;">Dato no
                                            válido.</span>
                                    </div>

                                </div>
                            </div>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-start pt-0">
                            <div class="form-group col-12 pt-2">
                                <p class="fw-bold mb-0">M. de planificación: </p>
                                <div class="mt-0 Old-Data" id="met"> {{ $gyo->metodo ?? '--' }} </div>

                                <div class="mt-2 mb-1 input-Gyo d-none animate__animated animate__fadeInUp">
                                    <label for="new_met">M. de planificación: <span
                                            class="red-color">*</span></label>
                                    <textarea class="form-control" id="new_met" rows="2"> {{ $gyo->metodo }}</textarea>
                                    <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>
                                </div>

                            </div>
                        </li>
                    </ul>
                </div>
            </div> {{-- Contenedor del lado izquierdo  --}}

            <div class="col-lg-6 col-md-6 col-sm-12 ps-3 mb-2 mt-2">
                <div class="row">
                    <h5 class="aling-items-center ps-0">
                        <span class="pe-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 512 512">
                                <path fill="#06285c"
                                    d="M224 144a64 64 0 1 0-64-64a64.07 64.07 0 0 0 64 64m0-96a32 32 0 1 1-32 32a32.036 32.036 0 0 1 32-32m129.959 203.37c-15.021-16.9-35.063-27.659-62.61-33.506L266.551 160h-88.428L152 342.863V400h56v96h96v-96h80v-48c0-44.972-9.826-77.888-30.041-100.63M352 368h-80v96h-32v-96h-56v-22.863L205.877 192h39.572l23.291 54.344l8.629 1.438c24.5 4.083 41.233 11.979 52.672 24.848C344.817 289.253 352 315.215 352 352Z" />
                            </svg>
                        </span> Obstetricia
                    </h5>
                    <ul class="list-group">

                        <li class="list-group-item pt-0">
                            <div class="row">
                                 <div class="form-group col-6 pt-2">
                                    <p class="fw-bold mb-0">abortos:</p>
                                    <div class="mt-0 Old-Data" id="abortos"> {{ $gyo->abortos ?? '--' }}</div>
                                    <div class="mt-2 mb-1 input-Gyo d-none animate__animated animate__fadeInUp">
                                        <label for="new_abortos">Abortos: <span class="red-color">
                                                *</span></label>
                                        <input class="form-control form-disabled" type="number" name="new_abortos"
                                            id="new_abortos" value="{{ $gyo->abortos }}">
                                        <span class="text-danger fw-normal" style=" display: none;">Dato no
                                            válido.</span>
                                    </div>

                                </div>

                                <div class="form-group col-6 pt-2 div-cedula">
                                    <p class="fw-bold mb-0">Partos:</p>
                                    <div class="mt-0 Old-Data" id="partos"> {{ $gyo->partos ?? '--' }}</div>

                                    <div class="mt-2 mb-1 input-Gyo d-none animate__animated animate__fadeInUp">
                                        <label for="new_partos">Partos: <span class="red-color">
                                                *</span></label>
                                        <input class="form-control form-disabled" type="number" name="new_partos"
                                            id="new_partos" value="{{ $gyo->partos }}">
                                        <span class="text-danger fw-normal" style=" display: none;">Dato no
                                            válido.</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item pt-0">
                            <div class="row">
                                <div class="form-group col-6 pt-2">
                                    <p class="fw-bold mb-0">cesáreas:</p>
                                    <div class="mt-0 Old-Data" id="cesareas"> {{ $gyo->cesareas ?? '--' }} </div>
                                    <div class="mt-2 mb-1 input-Gyo d-none animate__animated animate__fadeInUp">
                                        <label for="new_cesareas">Cesáreas: <span class="red-color">
                                                *</span></label>
                                        <input class="form-control form-disabled" type="number" name="new_cesareas"
                                            id="new_cesareas" value="{{ $gyo->cesareas }}">
                                        <span class="text-danger fw-normal" style=" display: none;">Dato no
                                            válido.</span>
                                    </div>
                                </div>

                               

                                <div class="form-group col-6 pt-2">
                                    <p class="fw-bold mb-0">Gestas:</p>
                                    <div class="mt-0 Old-Data" id="gestas"> {{ $gyo->gestas ?? '--' }} </div>

                                    <div class="mt-2 mb-1  input-Gyo d-none animate__animated animate__fadeInUp">
                                        <label for="new_gestas">Gestas: </label>
                                        <input class="form-control form-disabled" disabled type="number" name="new_gestas"
                                            id="new_gestas" value="{{ $gyo->gestas }}">
                                        <span class="text-danger fw-normal" style=" display: none;">Dato no
                                            válido.</span>
                                    </div>
                                </div>

                            </div>
                        </li>
                    </ul>
                    <h5 class="aling-items-center mt-3 ps-0">
                        <span class="pe-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 16 16">
                                <path fill="#059669" fill-rule="evenodd"
                                    d="M8 3.5a1 1 0 1 0 0-2a1 1 0 0 0 0 2M8 0a2.5 2.5 0 0 1 2.45 2H13a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h2.55A2.5 2.5 0 0 1 8 0M7 5h3.5V3.5h2v11h-9v-11h2V5zm3.53 3.28a.75.75 0 1 0-1.06-1.06L7.5 9.19l-.47-.47a.75.75 0 0 0-1.06 1.06l1 1a.75.75 0 0 0 1.06 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span> Exámenes
                    </h5>

                    <ul class="list-group">
                        <li class="list-group-item pt-0">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12 pt-2">
                                    <p class="fw-bold mb-0">F. citología (año):</p>
                                    <div class="mt-0 Old-Data" id="last_c">
                                        {{ $gyo->fecha_citologia ?? '--' }}
                                    </div>
                                    <div class="mt-2 mb-1  input-Gyo d-none animate__animated animate__fadeInUp">
                                        <label for="new_last_c">F. citología: <span class="red-color">
                                                *</span></label>
                                        <input class="form-control form-disabled" type="number" name="new_last_c"
                                            id="new_last_c" value="{{ $gyo->fecha_citologia }}">
                                        <span class="text-danger fw-normal" style=" display: none;">Fecha no
                                            válida.</span>
                                    </div>


                                </div>

                                <div class="form-group col-md-6 col-sm-12 pt-2 div-cedula">
                                    <p class="fw-bold mb-0">F. mastografía (año):</p>

                                    <div class="mt-0 Old-Data" id="mast">
                                        {{ $gyo->mastografia ?? '--' }}</div>

                                    <div class="mt-2 mb-1 input-Gyo d-none animate__animated animate__fadeInUp">
                                        <label for="new_mast">F. mastografía: <span class="red-color">
                                                *</span></label>
                                        <input class="form-control form-disabled" type="number" name="new_mast"
                                            id="new_mast" value="{{ $gyo->mastografia }}">
                                        <span class="text-danger fw-normal" style=" display: none;">Fecha no
                                            válida.</span>
                                    </div>

                                </div>
                            </div>
                        </li>
                    </ul>

                </div>

            </div>
            @role('Administrador')
                <div class="col-12 mt-3 input-Gyo d-none animate__animated animate__fadeInUp">
                    <div class="row">
                        <div class="d-flex justify-content-end gap-2">
                            <x-button-custom type="button"
                                class="btn-red  justify-content-center justify-content-lg-start" text="Cancelar"
                                id="cancel_Gyo" tooltipText="Cancelar edición.">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M3.47 3.47a.75.75 0 0 1 1.06 0L8 6.94l3.47-3.47a.75.75 0 1 1 1.06 1.06L9.06 8l3.47 3.47a.75.75 0 1 1-1.06 1.06L8 9.06l-3.47 3.47a.75.75 0 0 1-1.06-1.06L6.94 8L3.47 4.53a.75.75 0 0 1 0-1.06"
                                            clip-rule="evenodd" />
                                    </svg>
                                </x-slot>
                            </x-button-custom>


                            <x-button-custom type="button"
                                class="btn-blue-sec justify-content-center justify-content-lg-start" text="Guardar"
                                id="Save_Gyo" tooltipText="Guardar cambios">
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
        </div>
    @endrole

</div>
</div>
{{-- Modal para editar los datos del usuario --}}
</div>
