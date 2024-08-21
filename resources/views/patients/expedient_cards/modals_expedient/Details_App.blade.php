@extends('admin.layouts.main')

@section('title', 'Detalles')

@section('viteConfig')
    @vite(['resources/sass/form-style.scss', 'resources/sass/expedient.scss'])
    @role('Administrador')
        <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}">
     @endrole
@endsection

@section('content')
 
hola mundo

    {{-- @role('Administrador')
        @section('scripts')
            <script src="{{ asset('js/select2.min.js') }}"></script>
            @vite(['resources/js/patients/expedient/edit_personal_data.js', 'resources/js/patients/expedient/edit_AHF.js', 'resources/js/patients/expedient/edit_APNP.js','resources/js/patients/expedient/edit_APP.js'])
        @endsection
    @endrole --}}

@endsection
