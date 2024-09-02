@extends('admin.layouts.main')

@section('title', 'Registrar Consulta de Nutrición')

@section('viteConfig')
    @vite(['resources/sass/form-style.scss', 'resources/sass/main.scss', 'resources/sass/new-consultation.scss'])
@endsection

@section('content')

    <div class="container max-w-custom" id="containerPersonSelect">
        <h4 class="fw-bold my-3">Consulta de Nutrición</h4>
        <form id="nutricionalForm" action="{{ route('nutrition.consultation.store',['id_persona'=> $person->id_persona]) }}" method="POST">
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
                    <div class="d-flex flex-column justify-content-start gap-3">

                        <x-button-custom type="submit" class="btn-blue-sec justify-content-center" text="Finalizar consulta" id="saveConsultation" tooltipText="Guardar la consulta del paciente.">
                            <x-slot name="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                    <path
                                        d="M8.397 11.235a.75.75 0 0 0-.294-1.471c-.903.18-1.585.812-1.948 1.659c-.36.838-.413 1.886-.132 3.008a.75.75 0 1 0 1.455-.363c-.22-.878-.148-1.58.055-2.054c.2-.466.518-.71.864-.78M5.471 3.419A5.18 5.18 0 0 0 6.89 7.302a5.12 5.12 0 0 0-3.66 4.216a10.46 10.46 0 0 0 1.37 6.796l.35.59l.043.063l1.416 1.906a3.462 3.462 0 0 0 5.275.336a.437.437 0 0 1 .63 0a3.462 3.462 0 0 0 5.275-.336l1.416-1.907l.042-.063l.351-.59a10.46 10.46 0 0 0 1.373-6.795a5.12 5.12 0 0 0-6.11-4.306l-1.901.394h-.003c.03-.78.152-1.62.391-2.338c.29-.868.692-1.39 1.14-1.576a.75.75 0 1 0-.578-1.385c-1.052.439-1.65 1.48-1.985 2.486l-.046.142a5.2 5.2 0 0 0-.943-1.29a5.18 5.18 0 0 0-3.98-1.51A1.367 1.367 0 0 0 5.47 3.418m1.493.207a3.68 3.68 0 0 1 2.712 1.08a3.68 3.68 0 0 1 1.08 2.712a4 4 0 0 1-.543-.025l-.617-.128a3.7 3.7 0 0 1-1.552-.927a3.68 3.68 0 0 1-1.08-2.712m2.07 5.055l.202.042q.36.102.73.152l.97.2a5.25 5.25 0 0 0 2.13 0l1.902-.394a3.62 3.62 0 0 1 4.32 3.045a8.96 8.96 0 0 1-1.177 5.821l-.331.557l-1.393 1.876a1.962 1.962 0 0 1-2.99.19a1.936 1.936 0 0 0-2.792 0a1.962 1.962 0 0 1-2.99-.19l-1.393-1.876l-.331-.557a8.96 8.96 0 0 1-1.176-5.821A3.62 3.62 0 0 1 9.033 8.68" />
                                </svg>
                            </x-slot>
                        </x-button-custom>


                        <x-button-custom  class="btn-red justify-content-center" text="Cancelar"  tooltipText="Cancelar la consulta del paciente." id="cancelConsultation">
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
                    {{-- Datos Nutricionales --}}
                    <x-card-custom>
                        <x-slot name="title">Datos Nutricionales</x-slot>

                        <div class="mb-3">
                            <label for="vasos_agua" class="pb-2">Vasos de agua al día</label>
                            <input type="number" name="vasos_agua" id="vasos_agua" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="motivo_consulta" class="pb-2">Motivo de consulta</label>
                            <input type="text" name="motivo_consulta" id="motivo_consulta" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="toma_medicamentos" class="pb-2">¿Toma medicamentos?</label>
                            <input type="text" name="toma_medicamentos" id="toma_medicamentos" class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="diagnostico" class="pb-2">Diagnóstico</label>
                            <textarea name="diagnostico" id="diagnostico" class="form-control"></textarea>
                        </div>
                    </x-card-custom>
                </div>

                <div class="col-12 col-lg-4">
                    {{-- Medidas Corporales --}}
                    <x-card-custom>
                        <x-slot name="title">Medidas Corporales</x-slot>

                        <div class="mb-3">
                            <label for="peso_actual" class="pb-2">Peso actual (kg)</label>
                            <input type="number" step="0.1" name="peso_actual" id="peso_actual" class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="peso_habitual" class="pb-2">Peso habitual (kg)</label>
                            <input type="number" step="0.1" name="peso_habitual" id="peso_habitual"
                                class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="estatura" class="pb-2">Estatura (cm)</label>
                            <input type="number" step="0.1" name="estatura" id="estatura" class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="circunferencia_cintura" class="pb-2">Circunferencia cintura (cm)</label>
                            <input type="number" step="0.1" name="circunferencia_cintura"
                                id="circunferencia_cintura" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="circunferencia_cadera" class="pb-2">Circunferencia cadera (cm)</label>
                            <input type="number" step="0.1" name="circunferencia_cadera" id="circunferencia_cadera"
                                class="form-control" required>
                        </div>
                    </x-card-custom>
                </div>


            </div>
    </div>
    </form>
    </div>

@endsection

@section('scripts')
    {{-- <script src="{{asset('js/quill.js')}}"></script> --}}
    @vite('resources/js/consultationNutrition.js')
@endsection
