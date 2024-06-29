@extends('admin.layouts.main')

@section('title', 'Expediente')

@section('viteConfig')
@endsection
@vite(['resources/sass/form-style.scss', 'resources/sass/expedient.scss'])

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
            @vite('resources/js/patients/expedient/edit_personal_data.js')
        @endsection
    @endrole

@endsection
