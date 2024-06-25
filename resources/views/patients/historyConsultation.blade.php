@extends('admin.layouts.main')

@section('title', 'Historial de consultas')

@section('viteConfig')
    @vite(['resources/sass/form-style.scss', 'resources/sass/main.scss', 'resources/sass/history-consultation.scss'])
@endsection


@section('content')



    {{-- Select type Person --}}
    <div class="container max-w-custom mb-4">
        <h4 class="fw-bold">Hisotial de consultas</h4>

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
