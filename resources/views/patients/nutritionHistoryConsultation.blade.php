@extends('admin.layouts.main')

@section('title', 'Historial de consultas')

@section('viteConfig')
    @vite(['resources/sass/form-style.scss', 'resources/sass/main.scss', 'resources/sass/history-consultation.scss'])
@endsection


@section('content')



    {{-- Select type Person --}}
    <div class="container max-w-custom mb-4">

        <div class="row">
            <div class="col-12 d-flex flex-column flex-lg-row justify-content-lg-between">
                <h4 class="fw-bold">Hisotial de consultas</h4>
                <x-button-link-custom :route="route('nutrition.consultation.create', ['id_persona' => $idPersona])" class="btn-blue justify-content-center"
                    text="Agregar consulta" tooltipText="Agregar una nueva consulta al paciente">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            viewBox="0 0 24 24">
                            <path d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                        </svg>
                    </x-slot>
                </x-button-link-custom>
            </div>
        </div>

        <div class="row mt-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <p class="text-end px-3"><span class="fw-bold">Cantidad de consultas</span> : {{$totalConsultas}}</p>
                                    <input type="hidden" id="idPersona" value="{{$idPersona}}">
                                    <input type="hidden" id="totalConsultas" value="{{$totalConsultas}}">
                                    <ul class="timeline" id="containerListNutritionConsultation"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('scripts')
    @vite('resources/js/patients/nutritionHistoryConsultation.js')

@endsection
