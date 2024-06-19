<div class="card">
    <div class="card-header text-center bg-blue">
        Ginecologia y obstetricia
    </div>
    <div class="card-body">
        @php
            use Carbon\Carbon;
        @endphp
        <div class="row col-12">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group px-2">
                    <div class="row">

                        <div class="form-group col-12 pt-2">
                            <p class="fw-bold mb-0">Menarca</p>
                            <div class="mt-0"> {{ $gyo->menarca ?? '--' }} </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6 pt-2">
                                <p class="fw-bold mb-0">F. ultima menstruación:</p>
                                @if (empty($gyo->fecha_um))
                                    --
                                @else
                                    <div class="mt-0">
                                        {{ Carbon::parse($gyo->fecha_um)->locale('es')->isoFormat('LL') }}</div>
                                @endif

                            </div>

                            <div class="form-group col-5 pt-2 div-cedula">
                                <p class="fw-bold mb-0">S. de gestación:</p>
                                @if (empty($gyo->s_gestacion))
                                    --
                                @else
                                    <div class="mt-0">
                                        {{ Carbon::parse($gyo->s_gestacion)->locale('es')->isoFormat('LL') }}</div>
                                @endif

                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6 pt-2">
                                <p class="fw-bold mb-0">Ciclos:</p>
                                <div class="mt-0"> {{ $gyo->ciclos ?? '--' }} </div>
                            </div>

                            <div class="form-group col-5 pt-2 div-cedula">
                                <p class="fw-bold mb-0">Días X días</p>
                                <div class="mt-0 d-none"> {{ $gyo->dias_x_dias ?? '--' }} </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6 pt-2">
                                <p class="fw-bold mb-0">F. citología:</p>
                                @if (empty($gyo->fecha_citologia))
                                    --
                                @else
                                    <div class="mt-0">
                                        {{ Carbon::parse($gyo->fecha_citologia)->locale('es')->isoFormat('LL') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-5 pt-2 div-cedula">
                                <p class="fw-bold mb-0">F. matografía:</p>
                                @if (empty($gyo->mastografia))
                                    --
                                @else
                                    <div class="mt-0">
                                        {{ Carbon::parse($gyo->mastografia)->locale('es')->isoFormat('LL') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-12 pt-2">
                            <p class="fw-bold mb-0">M. de planificación</p>
                            <div class="mt-0"> {{ $gyo->metodo ?? '--' }} </div>
                        </div>
                    </div>
                </div>
            </div> {{-- Contenedor deñ lado izquierdo  --}}

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <div class="row">
                        <div class="row mb-3">
                            <div class="form-group col-6 pt-2">
                                <p class="fw-bold mb-0">Inicio de vida sexual:</p>
                                <div class="mt-0"> {{ $gyo->ivs ?? '--' }} </div>
                            </div>
                            <div class="form-group col-5 pt-2 div-cedula">
                                <p class="fw-bold mb-0">N. parejas:</p>
                                <div class="mt-0"> {{ $gyo->parejas_s ?? '--' }}</div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="form-group col-6 pt-2">
                                <p class="fw-bold mb-0">Gestas:</p>
                                <div class="mt-0"> {{ $gyo->gestas ?? '--' }} </div>
                            </div>
                            <div class="form-group col-5 pt-2 div-cedula">
                                <p class="fw-bold mb-0">Partos:</p>
                                <div class="mt-0"> {{ $gyo->partos ?? '--' }}</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="form-group col-6 pt-2">
                                <p class="fw-bold mb-0">cesareas:</p>
                                <div class="mt-0"> {{ $gyo->cesareas ?? '--' }} </div>
                            </div>
                            <div class="form-group col-5 pt-2 div-cedula">
                                <p class="fw-bold mb-0">abortos:</p>
                                <div class="mt-0"> {{ $gyo->abortos ?? '--' }}</div>
                            </div>
                        </div>
                    </div>
                </div> <!-- FIN contenedor 1  -->   
            </div>

            {{-- Botones  --}}
                <div class="col-12 p-0 mt-2">
                    <div class="row">
                        <div class="d-flex justify-content-end">
                            <div class="">
                                <button href="" class="btn-sec fst-normal tooltip-container" type="button"
                                    data-bs-toggle="modal" data-bs-target="#EditData">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
                                    </svg>
                                    Editar
                                    <span class="tooltip-text">Editar datos.</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
        </div>
    </div>
    {{-- Modal para editar los datos del usuario --}}
</div>
