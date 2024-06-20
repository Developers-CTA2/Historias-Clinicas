<div class="card">
    <div class="card-header text-center bg-blue">
        Datos personales
    </div>
    <div class="card-body">
        <div class="row col-12">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group px-2">
                    <div class="row">
                        <div class="form-group col-12 pt-2">
                            <p class="fw-bold mb-0">Nombre completo:</p>
                            <div class="mt-0"> {{ $Personal->nombre }}</div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6 pt-2">
                                <p class="fw-bold mb-0">Código:</p>
                                <div class="mt-0"> {{ $Personal->codigo ?? '--' }} </div>

                            </div>

                            <div class="form-group col-5 pt-2 div-cedula">
                                <p class="fw-bold mb-0">Genero:</p>
                                <div class="mt-0"> {{ $Personal->sexo }} </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6 pt-2">
                                <p class="fw-bold mb-0">Teléfono:</p>
                                <div class="mt-0"> {{ $Personal->telefono }} </div>
                            </div>

                            <div class="form-group col-5 pt-2 div-cedula">
                                <p class="fw-bold mb-0">F. nacimiento:</p>
                                @php
                                    use Carbon\Carbon;
                                @endphp
                                <div class="mt-0">
                                    {{ Carbon::parse($Personal->fecha_nacimiento)->locale('es')->isoFormat('LL') }}
                                </div>
                                <div class="mt-0 d-none"> {{ $Personal->fecha_nacimiento }} </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6 pt-2">
                                <p class="fw-bold mb-0">Ocupación:</p>
                                <div class="mt-0"> {{ $Personal->ocupacion }} </div>

                            </div>

                            <div class="form-group col-5 pt-2 div-cedula">
                                <p class="fw-bold mb-0">NSS:</p>
                                <div class="mt-0"> {{ $Personal->nss }} </div>
                            </div>
                        </div>


                        <div class="form-group col-12 pt-2">
                            <p class="fw-bold mb-0">Religion</p>
                            <div class="mt-0"> {{ $Personal->religion }} </div>
                        </div>

                        <h5 class="mt-4 aling-items-center">
                            <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                    viewBox="0 0 24 24">
                                    <path fill="#BE3144"
                                        d="M5 20v-2h1.6L9 10h6l2.4 8H19v2zm3.7-2h6.6l-1.8-6h-3zM11 8V3h2v5zm5.95 2.475L15.525 9.05l3.55-3.525l1.4 1.4zM18 15v-2h5v2zM7.05 10.475l-3.525-3.55l1.4-1.4l3.55 3.525zM1 15v-2h5v2zm11 3" />
                                </svg>
                            </span> Contacto de emergencia
                        </h5>

                        <div class="form-group col-12 pt-2">
                            <p class="fw-bold mb-0">Nombre contacto:</p>
                            <div class="mt-0"> {{ $Personal->contacto_emerge }} </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-group col-6 pt-2">
                                <p class="fw-bold mb-0">Teléfono:</p>
                                <div class="mt-0"> {{ $Personal->telefono_emerge }}</div>
                            </div>
                            <div class="form-group col-5 pt-2 div-cedula">
                                <p class="fw-bold mb-0">Parentesco:</p>
                                <div class="mt-0"> {{ $Personal->telefono_emerge }}</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div> {{-- Contenedor deñ lado izquierdo  --}}

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group px-2">
                    <div class="row">
                        <h5 class="m-0 mt-3 aling-items-center">
                            <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                    viewBox="0 0 16 16">
                                    <g fill="rgb(19, 87, 78)">
                                        <path
                                            d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207l-5 5V13.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 2 13.5V8.207l-.646.647a.5.5 0 1 1-.708-.708z" />
                                        <path
                                            d="M16 12.5a3.5 3.5 0 1 1-7 0a3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1.5a.5.5 0 1 0 1 0V11a.5.5 0 0 0-.5-.5m0 4a.5.5 0 1 0 0-1a.5.5 0 0 0 0 1" />
                                    </g>
                                </svg>
                            </span>
                            Domicilio del paciente
                        </h5>

                        <div class="form-group col-12 pt-2">

                            <div class="row">
                                <div class="form-group col-6 pt-2">
                                    <p class="fw-bold mb-0">Pais</p>
                                    <div class="mt-0"> {{ $domicilio->pais }}</div>
                                </div>
                                <div class="form-group col-5 pt-2 div-cedula">
                                    <p class="fw-bold mb-0">Estado:</p>
                                    <div class="mt-0"> {{ $domicilio->estado ?? '--' }} </div>
                                </div>
                            </div>

                            <div class="form-group col-12 pt-2">
                                <p class="fw-bold mb-0">Ciudad o municipio:</p>
                                <div class="mt-0"> {{ $domicilio->ciudad_municipio ?? '--'}} </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6 pt-2">
                                    <p class="fw-bold mb-0">Colonia</p>
                                    <div class="mt-0"> {{ $domicilio->colonia ?? '--' }}</div>
                                </div>
                                <div class="form-group col-5 pt-2 div-cedula">
                                    <p class="fw-bold mb-0">Código postal:</p>
                                    <div class="mt-0"> {{ $domicilio->cp ?? '--' }} </div>
                                </div>
                            </div>

                            <div class="form-group col-12 pt-2">
                                <p class="fw-bold mb-0">Calle:</p>
                                <div class="mt-0"> {{ $domicilio->calle ?? '--' }} </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6 pt-2">
                                    <p class="fw-bold mb-0">Num. exterior</p>
                                    <div class="mt-0"> {{ $domicilio->num ?? '--' }}</div>
                                </div>
                                <div class="form-group col-5 pt-2 div-cedula">
                                    <p class="fw-bold mb-0">Num. interior:</p>
                                    <div class="mt-0"> {{ $domicilio->num_int ?? '--' }} </div>
                                </div>
                            </div>



                            {{-- <div class="mt-0"> {{ $domicilio->cuidad_municipio }}<div>
                                </div>
                                <div class="form-group col-12 pt-2">
                                    <p class="fw-bold mb-0">Calle:</p>
                                    <div class="mt-0"> {{ $domicilio->calle }} </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6 pt-2">
                                        <p class="fw-bold mb-0">Num. externo:</p>
                                        <div class="mt-0"> {{ $domicilio->num }}</div>
                                    </div>
                                    <div class="form-group col-5 pt-2 div-cedula">
                                        <p class="fw-bold mb-0">Num. interno:</p>
                                        <div class="mt-0"> {{ $domicilio->num_int ?? '--' }} </div>
                                    </div>
                                </div>


                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- Botones  --}}
            <div class="col-12 p-0 mt-2">
                <div class="row">
                    <div class="d-flex justify-content-end">
                        {{-- <div class="mx-2">
                            <a href="" class="btn-red fst-normal tooltip-container">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 1024 1024">
                                    <path d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64" />
                                    <path
                                        d="m237.248 512l265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312z" />
                                </svg>
                                Atras
                                <span class="tooltip-text">Volver a la ventana anterior.</span>
                            </a>
                        </div> --}}
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
