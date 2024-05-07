@extends('layouts.auth')

@section('viteConfig')
    @vite(['resources/sass/login.scss'])
@endsection

@section('content')

    {{-- col-xl-6 col-md-6 col-sm-8 --}}

    <div class="card card-bg mt-3 mb-0">
        <div class="card-body justify-content-center ">
            <div class="text-center">
                <h1 class="text-center fw-bold title-custom">

                    {{-- <img class="img-login " src="{{ asset('images/medicos.png') }}" /> --}}
                    <p class="font-logo">Consultorio CUAltos</p>
                </h1>
                <p>Bienvenido de nuevo</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>¡Ups! Algo salió mal.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif



            <form class="mx-2" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="user_name" class="form-label label">Usuario</label>
                    <input type="text" class="form-control form-control-custom py-2" id="user_name"
                        aria-describedby="user_name" name="user_name" oninput="this.value = this.value.toUpperCase()">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label label">Contraseña</label>
                    <input type="password" class="form-control form-control-custom py-2" id="password" name="password">
                </div>
                <div class="d-flex justify-content-center pt-4 mb-1">
                    <button type="submit" class="btn btn-primary-custom px-5 py-2 w-100 w-md-0">Ingresar</button>
                </div>
            </form>
        </div>
        <div class="col-12 text-center pb-0 mb-0">
            <p><a href="" tabindex="0" class="reference-link">Agendar una cita</a></p>
        </div>
    </div>


@endsection