@extends('admin.layouts.main')

@section('title', 'Registrar Historial de Nutrición')

@section('viteConfig')
    @vite(['resources/sass/form-style.scss', 'resources/sass/main.scss', 'resources/sass/new-consultation.scss'])
@endsection

@section('content')

    <div class="container max-w-custom" id="containerPersonSelect">
        <h4 class="fw-bold">Registrar Historial de Nutrición</h4>

        <form id="historialNutricionForm" action="{{ route('complete.nutrition.history.store',['id_persona'=> $person->id_persona]) }}" method="POST">
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

                        <x-button-custom type="submit" class="btn-blue-sec justify-content-center mb-2" text="Finalizar historial" id="saveConsultation" tooltipText="Guardar el historial del paciente.">
                            <x-slot name="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256"><path fill="currentColor" d="M216 72h-84.69L104 44.69A15.86 15.86 0 0 0 92.69 40H40a16 16 0 0 0-16 16v144.62A15.4 15.4 0 0 0 39.38 216h177.51A15.13 15.13 0 0 0 232 200.89V88a16 16 0 0 0-16-16M40 56h52.69l16 16H40Zm176 144H40V88h176Z"/></svg>
                            </x-slot>
                        </x-button-custom>


                        <x-button-custom  class="btn-red justify-content-center" text="Cancelar"  tooltipText="No completar el historial" id="cancelConsultation">
                            <x-slot name="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" />
                                </svg>
                            </x-slot>
                        </x-button-custom>

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
    @vite('resources/js/completeHistoryNutrition.js')
@endsection
