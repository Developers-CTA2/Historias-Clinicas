@extends('layouts.auth')

@section('content')
<div class="container-custom-login rounded-4">
    <div class="black-screen-custom">

    </div>
    <div class="row height-custom up-container-custom">

        <div class="col-12 col-md-6 py-3 px-4">
            <div class="container-custom-image rounded-3">

            </div>
        </div>

        <div class="col-12 col-md-6 height-custom">
            <div class="row d-flex justify-content-center align-content-center height-custom pt-lg-5">
                <div class="col-12 col-md-11 col-lg-10 col-xl-9 col-xxl-7">
                    <div class="col-12 px-5 pt-5 pt-lg-0 pb-2  text-center text-lg-start">
                        <h1 class="fw-bold title-custom">Bienvenido</h1>
                        <p class="text-sm">Ingresa el usuario y contraseña para acceder</p>
                    </div>

                    <!-- Mostrar los errores -->
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


                    <form class="px-md-5" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="user_name" class="form-label">Usuario</label>
                            <input type="text" class="form-control form-control-custom py-2" id="user_name" aria-describedby="user_name" name="user_name" oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control form-control-custom py-2" id="password" name="password">
                        </div>
                        <div class="d-flex justify-content-center pt-4">
                            <button type="submit" class="btn btn-primary-custom px-5 py-2 w-100 w-md-0">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection