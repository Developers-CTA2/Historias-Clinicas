@extends('admin.layouts.main')

@section('title', 'Registrar Historial de Nutrición')

@section('viteConfig')
    @vite(['resources/sass/form-style.scss', 'resources/sass/main.scss', 'resources/sass/new-consultation.scss'])
@endsection

@section('content')

    <div class="container max-w-custom" id="containerPersonSelect">
        <h4 class="fw-bold">Registrar Historial de Nutrición</h4>

        <form id="historialNutricionForm" action="{{ route('historial.nutricion.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id_persona" value="{{ $person->id_persona }}">

            <div class="row">
                <div class="col-12 col-lg-9">
                    <x-card-custom>
                        <x-slot name="title">Datos de la consulta</x-slot>
                        <div class="row">

                            <div class="col-12 col-lg-6">
                                <h5 class="fw-bold mb-2 text-muted">Fecha de identificación</h5>
                                <p class="m-0"><span class="fw-bold me-2 text-muted">Código :
                                    </span>{{ $person->codigo ?? 'No tiene código' }}</p>
                                <p class="m-0"><span class="fw-bold me-2 text-muted">Nombre :
                                    </span>{{ $person->nombre }}</p>
                                <p class="m-0"><span class="fw-bold me-2 text-muted">Edad :
                                    </span>{{ $person->edad }}
                                    años</p>
                            </div>
                            <div class="col-12 col-lg-6">
                                <h5 class="fw-bold mb-2 text-muted">Atendido por</h5>
                                <p class="m-0"><span class="fw-bold me-2 text-muted">Nombre :
                                    </span>{{ auth()->user()->name }}</p>
                                <p class="m-0"><span class="fw-bold me-2 text-muted">Cédula :
                                    </span>{{ auth()->user()->cedula ?? 'No tiene' }}</p>
                                <p class="m-0"><span class="fw-bold me-2 text-muted">Fecha :
                                    </span>{{ $dateNow }}
                                </p>
                            </div>
                        </div>

                    </x-card-custom>
                </div>


                <div class="col-12 col-lg-3 mb-3 mb-lg-0">
                    <div class="d-flex flex-column justify-content-start">
                        <button type="submit"
                            class="fst-normal tooltip-container py-2 px-3 btn-blue-sec mb-3" id="saveConsultation">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" class="pe-2"
                                viewBox="0 0 2048 2048">
                                <path
                                    d="M1728 640q66 0 124 25t101 69t69 102t26 124q0 57-19 109t-53 93t-81 71t-103 41v102q0 89-22 173t-62 160t-98 137t-129 107t-155 70t-174 25q-91 0-174-25t-154-70t-129-107t-98-137t-63-159t-22-174v-229q-123-11-218-59T133 962T34 781T0 558V0h320q26 0 45 19t19 45t-19 45t-45 19H128v430q0 106 29 192t87 147t140 94t192 33q101 0 184-31t141-89t91-140t32-185V128H832q-26 0-45-19t-19-45t19-45t45-19h320v558q0 120-34 223t-99 181t-160 126t-219 59v229q0 107 38 205t107 174t162 120t205 45q111 0 204-45t162-120t107-173t39-206v-102q-56-12-103-41t-81-70t-53-94t-19-109q0-66 25-124t68-101t102-69t125-26m0 512q40 0 75-15t61-41t41-61t15-75t-15-75t-41-61t-61-41t-75-15t-75 15t-61 41t-41 61t-15 75t15 75t41 61t61 41t75 15" />
                            </svg>
                            Finalizar historial
                            <span class="tooltip-text">Guardar la consulta.</span>
                        </button>

                        <button class="fst-normal tooltip-container py-2 px-3 btn-red" id="cancelConsultation">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" />
                            </svg>
                            Cancelar
                            <span class="tooltip-text">Cancelar la consulta.</span>
                        </button>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    {{-- Indicadores Dietéticos --}}
                    <x-card-custom>
                        <x-slot name="title">Indicadores Dietéticos</x-slot>

                        <div class="mb-3">
                            <label for="comidas_al_dia" class="pb-2">Comidas al día</label>
                            <input type="number" name="comidas_al_dia" id="comidas_al_dia" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="qien_prepara_comida" class="pb-2">¿Quién prepara la comida?</label>
                            <input type="text" name="qien_prepara_comida" id="qien_prepara_comida" class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="apetito" class="pb-2">Apetito</label>
                            <select name="apetito" id="apetito" class="form-control" required>
                                <option value="Bueno">Bueno</option>
                                <option value="Regular">Regular</option>
                                <option value="Malo">Malo</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="alimentos_no_preferidos" class="pb-2">Alimentos no preferidos</label>
                            <input type="text" name="alimentos_no_preferidos" id="alimentos_no_preferidos"
                                class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="suplementos" class="pb-2">Suplementos</label>
                            <input type="text" name="suplementos" id="suplementos" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="grasas_consumidas" class="pb-2">Grasas consumidas</label>
                            <input type="text" name="grasas_consumidas" id="grasas_consumidas" class="form-control">
                        </div>
                    </x-card-custom>


                </div>

                <div class="col-12 col-lg-4">
                    {{-- Estilo de Vida --}}
                    <x-card-custom>
                        <x-slot name="title">Estilo de Vida</x-slot>

                        <div class="mb-3">
                            <label for="actividad" class="pb-2">Nivel de actividad</label>
                            <select name="actividad" id="actividad" class="form-control" required>
                                <option value="Sedentaria">Sedentaria</option>
                                <option value="Muy ligera">Muy ligera</option>
                                <option value="Ligera">Ligera</option>
                                <option value="Moderada">Moderada</option>
                                <option value="Pesada">Pesada</option>
                                <option value="Excepcional">Excepcional</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tipo_ejercicio" class="pb-2">Tipo de ejercicio</label>
                            <input type="text" name="tipo_ejercicio" id="tipo_ejercicio" class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="frecuencia_ejercicio" class="pb-2">Frecuencia del ejercicio</label>
                            <input type="text" name="frecuencia_ejercicio" id="frecuencia_ejercicio"
                                class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="duracion_ejercicio" class="pb-2">Duración del ejercicio</label>
                            <input type="text" name="duracion_ejercicio" id="duracion_ejercicio" class="form-control"
                                required>
                        </div>
                    </x-card-custom>
                </div>

            </div>
        </form>
    </div>

@endsection

@section('scripts')
    @vite('resources/js/nutrition.js')
@endsection
