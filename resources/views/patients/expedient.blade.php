@extends('admin.layouts.main')

@section('title', 'Expediente')

@section('viteConfig')
    @vite('resources/sass/expedient.scss')
    @role('Administrador')
        <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}">
    @endrole
@endsection

@section('content')
    <x-button-up-screen />

    <div class="container">
        <div class="mb-3 mx-0">
            {{-- Botones que cambian segun el perfil del usuario --}}
            @include('patients.expedient_cards.expedientButtons')
        </div>
        {{-- Datos personales  --}}
        <div class="mb-3">
            @include('patients.expedient_cards.PersonalData')
        </div>
        <div class="row d-flex">
            <div class="mb-3 col-lg-6 col-12">
                  {{-- Medidas corporales--}}
                @include('patients.expedient_cards.ExpedientBody')
            </div>
            <div class="mb-3 col-lg-6 col-12">
                {{-- Antecedentes heredofamiliares --}}
                @include('patients.expedient_cards.ExpedientAHF')
            </div>
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

            
    @vite('resources/js/patients/expedient/buttonUp.js', )
    {{-- Opciones del administrador  --}}
    @role('Administrador')
        @section('scripts')
            <script src="{{ asset('js/select2.min.js') }}"></script>
            @vite(['resources/js/patients/expedient/edit_personal_data.js', 'resources/js/patients/expedient/edit_AHF.js', 'resources/js/patients/expedient/edit_APNP.js', 'resources/js/patients/expedient/edit_Gyo.js'])
        @endsection
    @endrole

@endsection
