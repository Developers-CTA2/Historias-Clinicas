@extends('admin.layouts.main')

@section('title', 'Inicio')

@section('viteConfig')
    @vite('resources/sass/home.scss')
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-12">
                <h4 class="fw-bold"> Bienvenido de nuevo</h4>
            </div>
        </div>

        <div class="row ">



            <div class="col-12">

                <x-filter-home idYear="yearDiseaseChart" idMonth="monthDiseaseChart" :months="$months" :years="$years" class="col-lg-8" />

                <x-card-custom>
                    <x-slot name="title">Consultas realizadas por enfermedades</x-slot>
                    <div class="container position-relative">
                        <canvas id="lineCharDiseases" style="width: 100%;"></canvas>

                        <div class="skeleton-charts d-none">
                            <div class="skeleton-bar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-chart" viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="1.3"
                                        d="M6.209 12.324H4.401c-.579 0-1.048.47-1.048 1.048v6.83c0 .578.47 1.048 1.048 1.048H6.21c.58 0 1.049-.47 1.049-1.049v-6.829a1.05 1.05 0 0 0-1.049-1.049m6.694-9.573h-1.808c-.58 0-1.049.47-1.049 1.049V20.2c0 .58.47 1.049 1.05 1.049h1.807c.58 0 1.049-.47 1.049-1.049V3.8c0-.58-.47-1.049-1.05-1.049m6.696 5.176H17.79c-.58 0-1.049.47-1.049 1.05V20.2c0 .58.47 1.049 1.049 1.049h1.808a1.05 1.05 0 0 0 1.049-1.049V8.976c0-.58-.47-1.049-1.05-1.049" />
                                </svg>
                            </div>
                            <div class="skeleton-footer">
                                <p>Lo sentimos, ocurrió un error inesperado. Intenta nuevamente más tarde.</p>
                            </div>
                        </div>
                    </div>

                </x-card-custom>
            </div>

            <div class="col-lg-6 col-12">

                <x-filter-home idYear="yearSexChart" idMonth="monthSexChart" :months="$months" :years="$years" class="mt-2" />

                <x-card-custom>
                    <x-slot name="title">Consultas clasificadas por sexo</x-slot>

                    <div class="container position-relative">
                        <canvas id="barCharSex" style="width: 100%;"></canvas>
                        <div class="skeleton-charts d-none">
                            <div class="skeleton-bar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-chart" viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="1.3"
                                        d="M6.209 12.324H4.401c-.579 0-1.048.47-1.048 1.048v6.83c0 .578.47 1.048 1.048 1.048H6.21c.58 0 1.049-.47 1.049-1.049v-6.829a1.05 1.05 0 0 0-1.049-1.049m6.694-9.573h-1.808c-.58 0-1.049.47-1.049 1.049V20.2c0 .58.47 1.049 1.05 1.049h1.807c.58 0 1.049-.47 1.049-1.049V3.8c0-.58-.47-1.049-1.05-1.049m6.696 5.176H17.79c-.58 0-1.049.47-1.049 1.05V20.2c0 .58.47 1.049 1.049 1.049h1.808a1.05 1.05 0 0 0 1.049-1.049V8.976c0-.58-.47-1.049-1.05-1.049" />
                                </svg>
                            </div>
                            <div class="skeleton-footer">
                                <p>Lo sentimos, ocurrió un error inesperado. Intenta nuevamente más tarde.</p>
                            </div>
                        </div>
                    </div>

                </x-card-custom>
            </div>

            <div class="col-12 col-lg-6">

                <x-filter-home idYear="yearTypePersonChart" idMonth="monthTypePersonChart" :months="$months" :years="$years" class="mt-2" />

                <x-card-custom>
                    <x-slot name="title">Consultas clasificadas tipo de persona</x-slot>

                    <div class="container position-relative">
                        <canvas id="barCharTypePerson" style="width: 100%;"></canvas>

                        <div class="skeleton-charts d-none">
                            <div class="skeleton-bar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-chart" viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="1.3"
                                        d="M6.209 12.324H4.401c-.579 0-1.048.47-1.048 1.048v6.83c0 .578.47 1.048 1.048 1.048H6.21c.58 0 1.049-.47 1.049-1.049v-6.829a1.05 1.05 0 0 0-1.049-1.049m6.694-9.573h-1.808c-.58 0-1.049.47-1.049 1.049V20.2c0 .58.47 1.049 1.05 1.049h1.807c.58 0 1.049-.47 1.049-1.049V3.8c0-.58-.47-1.049-1.05-1.049m6.696 5.176H17.79c-.58 0-1.049.47-1.049 1.05V20.2c0 .58.47 1.049 1.049 1.049h1.808a1.05 1.05 0 0 0 1.049-1.049V8.976c0-.58-.47-1.049-1.05-1.049" />
                                </svg>
                            </div>
                            <div class="skeleton-footer">
                                <p>Lo sentimos, ocurrió un error inesperado. Intenta nuevamente más tarde.</p>
                            </div>
                        </div>
                    </div>


                </x-card-custom>
            </div>






        </div>


    </div>


@endsection

@section('scripts')
    @vite(['resources/js/home/home.js'])
@endsection
