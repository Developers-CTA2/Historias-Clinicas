@extends('admin.layouts.main')

@section('title', 'Historial de consultas')

@section('viteConfig')
    @vite(['resources/sass/form-style.scss', 'resources/sass/main.scss', 'resources/sass/history-consultation.scss'])
@endsection


@section('content')



    {{-- Select type Person --}}
    <div class="container max-w-custom mb-4">

        <div class="row">
            <div class="col-12 col-lg-6 col-xxl-4">
                <h4 class="fw-bold">Historial de consultas</h4>
            </div>
            <div class="col-12 col-lg-6 col-xxl-8 d-flex justify-content-start justify-content-lg-end mt-3 mt-lg-0">
                <x-button-link-custom :route="route('admin.medical_record',['id'=>$idPersona])" class="btn-blue-sec" text="Expediente" tooltipText="Navegar al expediente médico" >
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="-4 -2 24 24"><path fill="currentColor" d="M3 0h10a3 3 0 0 1 3 3v14a3 3 0 0 1-3 3H3a3 3 0 0 1-3-3V3a3 3 0 0 1 3-3m0 2a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zm2 1h6a1 1 0 0 1 0 2H5a1 1 0 1 1 0-2m0 12h2a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2m0-4h6a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2m0-4h6a1 1 0 0 1 0 2H5a1 1 0 1 1 0-2"/></svg>
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
                                    <ul class="timeline" id="containerListConsultation"></ul>
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
    @vite('resources/js/patients/historyConsultation.js')

@endsection
