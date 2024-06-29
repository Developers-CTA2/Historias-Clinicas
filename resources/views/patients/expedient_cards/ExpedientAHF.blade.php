<div class="card">
    <div class="card-header text-center bg-blue">
        Antecedentes heredo-familiares
    </div>
    <div class="card-body">
        <div class="row col-12">
            {{-- Contenedor de las enfermedades --}}
            <div class="col-12">
                <div class="form-group">
                    <div class="row">
                        <h5 class="m-0 mt-1 aling-items-center mb-2">
                            <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 32 32">
                                    <path fill="#059669"
                                        d="M20 30h-3a2 2 0 0 1-2-2v-5h2v5h3v-5h2v-4a1 1 0 0 0-1-1h-8.72l-2-6H4a1 1 0 0 0-1 1v6h2v9h4v-7h2v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-7a2 2 0 0 1-2-2v-6a3.003 3.003 0 0 1 3-3h6.28a2 2 0 0 1 1.897 1.367L13.72 16H21a3.003 3.003 0 0 1 3 3v4a2 2 0 0 1-2 2v3a2 2 0 0 1-2 2m8 0h-2V19h3v-6a1 1 0 0 0-1-1h-4v-2h4a3.003 3.003 0 0 1 3 3v6a2 2 0 0 1-2 2h-1zM7 9a4 4 0 1 1 4-4a4.005 4.005 0 0 1-4 4m0-6a2 2 0 1 0 2 2a2 2 0 0 0-2-2m18 6a4 4 0 1 1 4-4a4.005 4.005 0 0 1-4 4m0-6a2 2 0 1 0 2 2a2 2 0 0 0-2-2" />
                                    <path fill="#059669"
                                        d="M18.5 15a3.5 3.5 0 1 1 3.5-3.5a3.504 3.504 0 0 1-3.5 3.5m0-5a1.5 1.5 0 1 0 1.5 1.5a1.5 1.5 0 0 0-1.5-1.5" />
                                </svg>
                            </span> Enfermedades
                        </h5>

                        <div class="form-group">
                            <div class="row">
                                <div class="cont-list">
                                    <ul class="list-group">
                                        @if (!$ahf || $ahf->isEmpty())
                                            <li class="list-group-item text-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 20 20">
                                                    <path fill="#e11d48" fill-rule="evenodd"
                                                        d="M10 18a8 8 0 1 0 0-16a8 8 0 0 0 0 16M8.707 7.293a1 1 0 0 0-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 1 0 1.414 1.414L10 11.414l1.293 1.293a1 1 0 0 0 1.414-1.414L11.414 10l1.293-1.293a1 1 0 0 0-1.414-1.414L10 8.586z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Sin registros
                                            </li>
                                        @else
                                            @foreach ($ahf as $enfermedad)
                                                <li class="list-group-item d-flex justify-content-between">
                                                    {{ $enfermedad->especificar_ahf->nombre }}
                                                    <div class="d-flex gap-2">

                                                        <button class="btn-red fst-normal tooltip-container">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 24 24">
                                                                <path
                                                                    d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5t.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5t-.288.713T19 6v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zm-7 11q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8t-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8t-.712.288T13 9v7q0 .425.288.713T14 17M7 6v13z" />
                                                            </svg>
                                                            <span class="tooltip-text">Eliminar enfermedad.</span>
                                                        </button>


                                                        <button class="btn-blue-sec fst-normal tooltip-container">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 32 32">
                                                                <path
                                                                    d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z" />
                                                            </svg>
                                                            <span class="tooltip-text">Editar registro.</span>
                                                        </button>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>


                            </div>
                            <div class="col-12 mt-2">
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
                                            <button href="" class="btn-sec fst-normal tooltip-container"
                                                type="button" data-bs-toggle="modal" data-bs-target="#EditData">
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
                </div>
            </div>
            {{-- Modal para editar los datos del usuario --}}
        </div>
    </div>
</div>
