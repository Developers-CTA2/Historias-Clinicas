@extends('admin.layouts.main')

@section('title', 'Agregar nuevo paciente')

@section('viteConfig')
@vite(['resources/sass/sideBar.scss','resources/sass/loadingScreen.scss', 'resources/sass/StyleForm.scss','resources/sass/colorButtons.scss', 'resources/sass/bar.scss','resources/js/app.js'])
@endsection

<!-- Esto no se que hace pero lo puse jsjsjsj -->
@section('breadCrumb')
<nav aria-label="breadcrumb" class="d-flex justify-content-between align-items-center">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a class="item-custom-link" href="{{ route('home') }}">Pacientes</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Dar de alta</li>
    </ol>
    <span class="text-end">{{ now()->setTimezone('America/Mexico_City')->format('d F Y') }}</span>
</nav>
@endsection

@section('content')
    <div class="container">
        <h1>Expediente</h1>
        
        
    </div>
@endsection