@extends('layouts.auth')

@section('content')

    <div class="content-custom-login">
        <div class="d-flex justify-content-center h-custom-logo">
            <img class="animate__animated animate__fadeIn" src="{{asset('images/clinic track-logo.webp')}}" alt="logo" />
        </div>
        <div class="hr-custom my-2"></div>
        <h2 class="fw-bold mt-3 text-center">Iniciar sesión</h2>
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

        {{-- Form --}}
        <form class="mt-3" action="{{ route('login') }}" method="POST">
            @csrf
                <div class="mb-3">
                    <label for="user_name" class="form-label fw-bold">Usuario</label>
                    <input type="text" class="form-control form-control-custom py-2" id="user_name" placeholder="Ingresa el usuario"
                        aria-describedby="user_name" name="user_name" oninput="this.value = this.value.toUpperCase()">
                </div>

                <div>
                    <label for="password" class="form-label fw-bold">Contraseña</label>
                    <div class="position-relative">
                        <input type="password" class="form-control form-control-custom py-2" id="password" name="password" placeholder="***********" />
                        <span class="eye-button" id="showHidePassword">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="#999999" d="M4 12.001c.003-.016.017-.104.095-.277c.086-.191.225-.431.424-.708c.398-.553.993-1.192 1.745-1.798C7.777 7.996 9.812 7 12 7c2.188 0 4.223.996 5.736 2.216c.752.606 1.347 1.245 1.745 1.798c.2.277.338.517.424.708c.078.173.092.261.095.277V12c-.003.016-.017.104-.095.277a4.251 4.251 0 0 1-.424.708c-.398.553-.993 1.192-1.745 1.798C16.224 16.004 14.189 17 12 17c-2.188 0-4.223-.996-5.736-2.216c-.752-.606-1.347-1.245-1.745-1.798a4.226 4.226 0 0 1-.424-.708A1.115 1.115 0 0 1 4 12.001M12 5C9.217 5 6.752 6.254 5.009 7.659c-.877.706-1.6 1.474-2.113 2.187a6.157 6.157 0 0 0-.625 1.055C2.123 11.23 2 11.611 2 12c0 .388.123.771.27 1.099c.155.342.37.7.626 1.055c.513.713 1.236 1.48 2.113 2.187C6.752 17.746 9.217 19 12 19c2.783 0 5.248-1.254 6.991-2.659c.877-.706 1.6-1.474 2.113-2.187c.257-.356.471-.713.625-1.055c.148-.328.271-.71.271-1.099c0-.388-.123-.771-.27-1.099a6.197 6.197 0 0 0-.626-1.055c-.513-.713-1.236-1.48-2.113-2.187C17.248 6.254 14.783 5 12 5m-1 7a1 1 0 1 1 2 0a1 1 0 0 1-2 0m1-3a3 3 0 1 0 0 6a3 3 0 0 0 0-6"/></g></svg>
                        </span>
                    </div>
                </div>
                <div class="mt-4">
                    <button class="btn w-100 btn-color-login py-2">Ingresar</button>
                </div>         
        </form>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/auth.js')
@endsection