@extends('admin.layouts.main')

@section('title', 'Expediente')

@section('viteConfig')
    @vite('resources/sass/form-style.scss')
@endsection

@section('content')

    <div class="container">

        <div class="mb-3">
            @include('patients.epedient_cards.PersonalData')
        </div>
        <div class="mb-3">
            @include('patients.epedient_cards.ExpedientAPNP')
        </div>
        <div class="mb-3">
            @include('patients.epedient_cards.ExpedientAHF')
        </div>
    </div>

@endsection
