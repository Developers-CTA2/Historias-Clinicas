@extends('admin.layouts.main')

@section('title', 'Inicio')

@section('viteConfig')
@vite(['resources/sass/sideBar.scss', 'resources/sass/home.scss', 'resources/js/app.js'])
@endsection

@section('titleView','Inicio')


@section('breadCrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Inicio</li>
    </ol>
</nav>
   
@endsection

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-12 text-center border-bottom mt-0">
            <h4 class="fst-italic"> Bienvenido de nuevo</h4>
        </div>
    </div>
</div>


@endsection