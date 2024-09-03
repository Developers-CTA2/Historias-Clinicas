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
            <span class="d-none" id="actualDate"> {{  date("Y-m-d"); }}</span>
            <span class="d-none" id="idRegister"> {{   $gyo->id   }}</span>
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

            <div class="col-lg-6 col-md-6 col-sm-12 ps-3">
                <div class="row">
                    <div class="form-group col-6 col-sm-12 pt-2">
                        <p class="fw-bold mb-0">Menarca: </p>
                        <div class="mt-0 Old-Data"> <span id="menarca">{{ $gyo->menarca ?? '--' }}</span> años</div>

                        <div class="mt-2 mb-1 input-Gyo d-none animate__animated animate__fadeInUp">
                            <label for="new_menarca">Menarca: <span class="red-color"> *</span></label>
                            <input class="form-control form-disabled" type="number" name="new_menarca" id="new_menarca"
                                value="{{ $gyo->menarca }}">
                            <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>
                        </div>
                    </div>


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
                                    válida.</span>
                            </div>

                        </div>

                        <div class="form-group col-md-6 col-sm-12 pt-2 div-cedula">
                            <p class="fw-bold mb-0">S. de gestación:</p>
                            <div class="mt-0  Old-Data" id="s_gest">
                                {{ $gyo->s_gestacion }}
                            </div>
                            <div class="mt-2 mb-1 input-Gyo d-none animate__animated animate__fadeInUp">
                                <label for="new_s_gest">S. de gestación: <span class="red-color">
                                        *</span></label>
                                <input class="form-control form-disabled" type="number" name="new_s_gest" id="new_s_gest"
                                    value="{{ $gyo->s_gestacion }}">
                                <span class="text-danger fw-normal" style=" display: none;">Dato no
                                    válida.</span>
                            </div>
                        </div>
                    </div>
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
                                <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-sm-12 pt-2 div-cedula">
                            @php
                                $string = $gyo->dias_x_dias;
                                $cadena = explode(',', $string);
                            @endphp

                            <p class="fw-bold mb-0">Días X días: </p>
                            <div class="mt-0  Old-Data"> {{ ($cadena[0] ?? '--') . ' X ' . ($cadena[1] ?? '--') }}
                                <span class="d-none" id="dias_1"> {{ $cadena[0] }} </span>
                                <span class="d-none" id="dias_2"> {{ $cadena[1] }} </span>
                            </div>

                            <div class="row mt-2 mb-1 input-Gyo d-none animate__animated animate__fadeInUp">
                                <label for="new_dias_1">Días X días <span class="red-color"> *</span></label>
                                <div class="d-flex gap-3">
                                    <input class="form-control form-disabled" type="number" name="new_dias_1"
                                        id="new_dias_1" value="{{ $cadena[0] }}">
                                    <span class="pt-2"><strong> X </strong></span>
                                    <input class="form-control form-disabled" type="number" name="new_dias_2"
                                        id="new_dias_2" value="{{ $cadena[1] }}">
                                </div>
                            </div>
                        </div>
                    </div>

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
                                <span class="text-danger fw-normal" style=" display: none;">Dato no
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
                                <span class="text-danger fw-normal" style=" display: none;">Dato no
                                    válida.</span>
                            </div>

                        </div>
                    </div>

                </div>

            </div> {{-- Contenedor del lado izquierdo  --}}

            <div class="col-lg-6 col-md-6 col-sm-12 ps-3 mb-2">
                <div class="row">
                    <div class="form-group col-12 pt-2">
                        <p class="fw-bold mb-0">M. de planificación: </p>
                        <div class="mt-0 Old-Data" id="met"> {{ $gyo->metodo ?? '--' }} </div>

                        <div class="mt-2 mb-1 input-Gyo d-none animate__animated animate__fadeInUp">
                            <label for="new_met">M. de planificación: <span class="red-color">*</span></label>
                            <textarea class="form-control" id="new_met" rows="2"> {{$gyo->metodo }}</textarea>
                            <span class="text-danger fw-normal" style=" display: none;">Dato no válido.</span>
                        </div>

                    </div>
                    <div class="form-group col-6 pt-2">
                        <p class="fw-bold mb-0">Inicio de vida sexual:</p>
                        <div class="mt-0 Old-Data" id="inicio"> {{ $gyo->ivs ?? '--' }} </div>

                        <div class="mt-2 mb-1  input-Gyo d-none animate__animated animate__fadeInUp">
                            <label for="new_inicio">Inicio de vida sexual: <span class="red-color">
                                    *</span></label>
                            <input class="form-control form-disabled" type="number" name="new_inicio"
                                id="new_inicio" value="{{ $gyo->ivs }}">
                            <span class="text-danger fw-normal" style=" display: none;">Dato no
                                válida.</span>
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
                                válida.</span>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6 pt-2">
                        <p class="fw-bold mb-0">Gestas:</p>
                        <div class="mt-0 Old-Data" id="gestas"> {{ $gyo->gestas ?? '--' }} </div>

                        <div class="mt-2 mb-1  input-Gyo d-none animate__animated animate__fadeInUp">
                            <label for="new_gestas">Gestas: <span class="red-color">
                                    *</span></label>
                            <input class="form-control form-disabled" type="number" name="new_gestas"
                                id="new_gestas" value="{{ $gyo->gestas }}">
                            <span class="text-danger fw-normal" style=" display: none;">Dato no
                                válida.</span>
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
                                válida.</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6 pt-2">
                        <p class="fw-bold mb-0">cesáreas:</p>
                        <div class="mt-0 Old-Data" id="cesareas"> {{ $gyo->cesareas ?? '--' }} </div>
                        <div class="mt-2 mb-1 input-Gyo d-none animate__animated animate__fadeInUp">
                            <label for="new_cesareas">cesáreas: <span class="red-color">
                                    *</span></label>
                            <input class="form-control form-disabled" type="number" name="new_cesareas"
                                id="new_cesareas" value="{{ $gyo->cesareas }}">
                            <span class="text-danger fw-normal" style=" display: none;">Dato no
                                válida.</span>
                        </div>
                    </div>

                    <div class="form-group col-6 pt-2 div-cedula">
                        <p class="fw-bold mb-0">abortos:</p>
                        <div class="mt-0 Old-Data" id="abortos"> {{ $gyo->abortos ?? '--' }}</div>
                        <div class="mt-2 mb-1 input-Gyo d-none animate__animated animate__fadeInUp">
                            <label for="new_abortos">abortos: <span class="red-color">
                                    *</span></label>
                            <input class="form-control form-disabled" type="number" name="new_abortos"
                                id="new_abortos" value="{{ $gyo->abortos }}">
                            <span class="text-danger fw-normal" style=" display: none;">Dato no
                                válida.</span>
                        </div>

                    </div>
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
                                id="Save_Gyo" tooltipText="Guardar cambios.">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 20 20">
                                        <path d="m15.3 5.3l-6.8 6.8l-2.8-2.8l-1.4 1.4l4.2 4.2l8.2-8.2z" />
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
