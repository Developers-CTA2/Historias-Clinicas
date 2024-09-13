@extends('admin.layouts.main')

@section('title', 'Inicio')

@section('viteConfig')
    @vite('resources/sass/home.scss')
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center border-bottom mt-0">
                <h4 class="fst-italic"> Bienvenido de nuevo</h4>
                <p>Revisa la ultima informacion</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <canvas id="lineCharDiseases" style="width: 100%;"></canvas>
            </div>

            <div class="col-12 col-lg-6">
                <canvas id="barCharSex" style="width: 100%;"></canvas>
            </div>

            {{-- <div class="col-12 col-lg-6">
                <canvas id="barCharSex" style="width: 100%;"></canvas>
            </div> --}}


        </div>

        
    </div>


@endsection

@section('scripts')
    @vite(['resources/js/home/home.js'])
@endsection