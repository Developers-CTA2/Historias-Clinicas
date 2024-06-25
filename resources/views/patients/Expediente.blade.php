@extends('admin.layouts.main')

@section('title', 'Expediente')

@section('viteConfig')
    @vite('resources/sass/form-style.scss')
@endsection

@section('content')

    <div class="container">
         <div class="mb-3 mx-0">
            @include('patients.epedient_cards.expedientButtons')
        </div> 
        {{-- Datos personales  --}}
        <div class="mb-3">
            @include('patients.epedient_cards.PersonalData')
        </div>
        {{-- Antecedentes heredofamiliares --}}
        <div class="mb-3">
            @include('patients.epedient_cards.ExpedientAHF')
        </div>
        {{-- Personales No patologicos aqui esta el margin --}}
        <div class="mb-3">
            @include('patients.epedient_cards.ExpedientAPNP')
        </div>
        {{-- Personales No patologicos  --}}
        <div class="mb-3">
            @include('patients.epedient_cards.ExpedientAPP')
        </div>
        {{-- Ocultar en nutricion  --}}
        @if($Personal->sexo == "Femenino")
        <div class="mb-3">
            @include('patients.epedient_cards.ExpedientGYO')
        </div>
        @endif
    </div>

@endsection
