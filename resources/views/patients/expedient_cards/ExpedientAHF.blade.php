<x-card-custom title="Antecedentes heredo-familiares">
    <div class="row">
    
        {{-- Boton para habilitar la edicion  --}}
        @role('Administrador')
            <div class="d-flex justify-content-between">
                {{-- <div>
                            <div class="p-0 m-0  AHF-data d-none animate__animated animate__fadeInUp">
                                <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between p-0 m-0"
                                    role="alert">
                                    <p class="p-2 mb-0 me-3 alert-AHF">
                                    </p>
    
                                </div>
                            </div>
                        </div> --}}
                {{-- Alerta de edicion  --}}
                <x-alert-manage containerClass="AHF-data" textClass="alert-AHF">
                </x-alert-manage>
    
                <div class="toggle tooltip-container">
                    <input type="checkbox" id="Edit-AHF">
                    <label for="Edit-AHF" class="label-check"></label>
                    <span class="tooltip-text">Habilitar edición.</span>
                </div>
            </div>
            {{-- Cargar collapse solo en caso de ser el usuario admin --}}
            @include('patients.expedient_cards.modals_expedient.collapse_AHF')
        @endrole
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
                                                <div class="d-flex gap-2 AHF-data d-none ">
                                                    {{-- Icono que muestra que este dato fue editado --}}
                                                    <div class="d-flex justify-content-center d-none icon-container"
                                                        data-icon="{{ $enfermedad->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                            height="18" viewBox="0 0 64 64">
                                                            <path fill="#ffdd15"
                                                                d="M63.37 53.52C53.982 36.37 44.59 19.22 35.2 2.07a3.687 3.687 0 0 0-6.522 0C19.289 19.22 9.892 36.37.508 53.52c-1.453 2.649.399 6.083 3.258 6.083h56.35c1.584 0 2.648-.853 3.203-2.01c.698-1.102.885-2.565.055-4.075" />
                                                            <path fill="#1f2e35"
                                                                d="m28.917 34.477l-.889-13.262c-.166-2.583-.246-4.439-.246-5.565c0-1.534.4-2.727 1.202-3.588c.805-.856 1.863-1.286 3.175-1.286c1.583 0 2.646.551 3.178 1.646c.537 1.102.809 2.684.809 4.751c0 1.215-.066 2.453-.198 3.708l-1.19 13.649c-.129 1.626-.404 2.872-.827 3.739c-.426.871-1.128 1.301-2.109 1.301c-.992 0-1.69-.419-2.072-1.257c-.393-.841-.668-2.12-.833-3.836m3.072 18.217c-1.125 0-2.106-.362-2.947-1.093c-.841-.728-1.26-1.748-1.26-3.058c0-1.143.4-2.12 1.202-2.921c.805-.806 1.786-1.206 2.951-1.206s2.153.4 2.977 1.206c.815.801 1.234 1.778 1.234 2.921c0 1.29-.419 2.308-1.246 3.044a4.245 4.245 0 0 1-2.911 1.107" />
                                                        </svg>
                                                    </div>
    
                                                    <x-button-custom type="button"
                                                        class="btn-red justify-content-center justify-content-lg-start Del-AHF"
                                                        padding="px-1 py-1" :onlyIcon="true"
                                                        data-ahf="{{ $enfermedad->id }}" tooltipText="Eliminar enfermedad">
                                                        <x-slot name="icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 24 24">
                                                                <path
                                                                    d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5t.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5t-.288.713T19 6v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zm-7 11q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8t-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8t-.712.288T13 9v7q0 .425.288.713T14 17M7 6v13z" />
                                                            </svg>
                                                        </x-slot>
                                                    </x-button-custom>
    
    
                                                    {{-- <button class="btn-red fst-normal tooltip-container Del-AHF"
                                                                data-ahf="{{ $enfermedad->id }}">
    
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                    height="20" viewBox="0 0 24 24">
                                                                    <path
                                                                        d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5t.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5t-.288.713T19 6v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zm-7 11q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8t-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8t-.712.288T13 9v7q0 .425.288.713T14 17M7 6v13z" />
                                                                </svg>
                                                                <span class="tooltip-text2">Eliminar enfermedad.</span>
                                                            </button> --}}
    
    
                                                    {{-- <button
                                                                class="btn-blue-sec fst-normal tooltip-container edit-AHF"
                                                                data-id_reg="{{ $enfermedad->id }}"
                                                                data-id_ahf="{{ $enfermedad->especificar_ahf->id_especifica_ahf }}"
                                                                data-name="{{ $enfermedad->especificar_ahf->nombre }}"
                                                                data-bs-toggle="collapse" data-bs-target="#Diseases"
                                                                aria-expanded="false" aria-controls="Diseases">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                    height="20" viewBox="0 0 32 32">
                                                                    <path
                                                                        d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z" />
                                                                </svg>
                                                                <span class="tooltip-text2">Editar registro.</span>
                                                            </button> --}}
                                                    <x-button-custom type="button"
                                                        class="btn-blue-sec justify-content-center justify-content-lg-start edit-AHF"
                                                        padding="px-1 py-1" :onlyIcon="true"
                                                        data-id_reg="{{ $enfermedad->id }}"
                                                        data-id_ahf="{{ $enfermedad->especificar_ahf->id_especifica_ahf }}"
                                                        data-name="{{ $enfermedad->especificar_ahf->nombre }}"
                                                        data-bs-toggle="collapse" data-bs-target="#Diseases"
                                                        aria-expanded="false" aria-controls="Diseases"
                                                        tooltipText="Editar registro">
                                                        <x-slot name="icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 32 32">
                                                                <path
                                                                    d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z" />
                                                            </svg>
                                                        </x-slot>
                                                    </x-button-custom>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
    
    
                        </div>
                        @role('Administrador')
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="d-flex justify-content-center gap-3">
    
                                        <div class="AHF-data d-none ">
                                            <x-button-custom type="button"
                                                class="btn-sec  justify-content-center justify-content-lg-start add-Disease"
                                                data-bs-toggle="collapse" data-bs-target="#Diseases" aria-expanded="false"
                                                aria-controls="Diseases" text="Agregar" tooltipText="Agregar una enfermedad">
                                                <x-slot name="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m5 11h-4v4h-2v-4H7v-2h4V7h2v4h4z" />
                                                    </svg>
                                                </x-slot>
                                            </x-button-custom>
                                        </div>
                                        <div class="d-none animate__animated animate__fadeInUp btn-refresh">
                                            <x-button-custom type="button"
                                                class="btn-sec justify-content-center justify-content-lg-start" text="Recargar"
                                                tooltipText="Recargar página." onclick="location.reload();">
                                                <x-slot name="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M10 3v2a5 5 0 0 0-3.54 8.54l-1.41 1.41A7 7 0 0 1 10 3m4.95 2.05A7 7 0 0 1 10 17v-2a5 5 0 0 0 3.54-8.54zM10 20l-4-4l4-4zm0-12V0l4 4z" />
                                                    </svg>
                                                </x-slot>
                                            </x-button-custom>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-card-custom>

