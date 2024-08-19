@extends('admin.layouts.main')

@section('title', 'Expediente')

@section('viteConfig')
    @vite(['resources/sass/form-style.scss', 'resources/sass/expedient.scss'])
    @role('Administrador')
        <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}">
        {{-- <script src="{{ asset('js/select2.min.js') }}"></script> --}}
    @endrole
@endsection

@section('content')

    <div class="container">
        <div class="mb-3 mx-0">
            @include('patients.expedient_cards.expedientButtons')
        </div>
        {{-- Datos personales  --}}
        <div class="mb-3">
            @include('patients.expedient_cards.PersonalData')
        
            {{-- Antecedentes heredofamiliares --}}
        </div>
        <div class="mb-3">
            @include('patients.expedient_cards.ExpedientAHF')
        </div>
        {{-- Personales No patologicos aqui esta el margin --}}
        <div class="mb-3">
            @include('patients.expedient_cards.ExpedientAPNP')
        </div>
        {{-- Personales No patologicos  --}}
        <div class="mb-3">
            @include('patients.expedient_cards.ExpedientAPP')
        </div>
        {{-- Ocultar en nutricion  --}}
        @if ($Personal->sexo == 'Femenino')
            <div class="mb-3">
                @include('patients.expedient_cards.ExpedientGYO')
            </div>
        @endif
    </div>


    @role('Administrador')
        @section('scripts')
            <script src="{{ asset('js/select2.min.js') }}"></script>
            @vite(['resources/js/patients/expedient/edit_personal_data.js', 'resources/js/patients/expedient/edit_AHF.js', 'resources/js/patients/expedient/edit_APNP.js'])
        @endsection
    @endrole

@endsection
