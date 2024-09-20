@extends('admin.layouts.main')

@section('title', 'Perfil')

@section('viteConfig')
    @vite(['resources/sass/form-style.scss'])
@endsection


@section('content')
    <div class="container ml-2">
        @php
            use Carbon\Carbon;
        @endphp
        <div class="card">
            <div class="card-header text-center">
                Mi perfil
            </div>
            <div class="card-body">
                <div class="row col-12">

                    <div class="row col-12 mx-2 p-1">
                        <p class="text-center p-0">Detalles de mi cuenta</p>

                        <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                            <div class="form-group col-12 d-flex justify-content-start mt-sm-2">
                                <div class="border rounded p-2 shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        viewBox="0 0 24 24">
                                        <path fill="none" stroke="#0284c7" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M6.578 15.482c-1.415.842-5.125 2.562-2.865 4.715C4.816 21.248 6.045 22 7.59 22h8.818c1.546 0 2.775-.752 3.878-1.803c2.26-2.153-1.45-3.873-2.865-4.715a10.66 10.66 0 0 0-10.844 0M16.5 6.5a4.5 4.5 0 1 1-9 0a4.5 4.5 0 0 1 9 0"
                                            color="#0284c7" />
                                    </svg>
                                </div>
                                <div class="ps-2">
                                    <p class="fw-bold mb-0">Nombre de usuario</p>
                                    <div class="mt-0"> {{ auth()->user()->name }} </div>
                                </div>
                            </div>

                            <div class="form-group col-12 mt-3">
                                <div class="form-group col-12 d-flex justify-content-start">
                                    <div class="border rounded p-2 shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                            viewBox="0 0 24 24">
                                            <path fill="#0284c7"
                                                d="m16.484 11.976l6.151-5.344v10.627zm-7.926.905l2.16 1.875c.339.288.781.462 1.264.462h.017h-.001h.014c.484 0 .926-.175 1.269-.465l-.003.002l2.16-1.875l6.566 5.639H1.995zM1.986 5.365h20.03l-9.621 8.356a.6.6 0 0 1-.38.132h-.014h.001h-.014a.6.6 0 0 1-.381-.133l.001.001zm-.621 1.266l6.15 5.344l-6.15 5.28zm21.6-2.441c-.24-.12-.522-.19-.821-.19H1.859a1.9 1.9 0 0 0-.835.197l.011-.005A1.86 1.86 0 0 0 0 5.855v12.172a1.86 1.86 0 0 0 1.858 1.858h20.283a1.86 1.86 0 0 0 1.858-1.858V5.855c0-.727-.419-1.357-1.029-1.66l-.011-.005z" />
                                        </svg>
                                    </div>
                                    <div class="ps-2">
                                        <p class="fw-bold mb-0">Correo electrónico</p>
                                        <div class="mt-0"> {{ auth()->user()->email }} </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group col-12 mt-3">
                                <div class="form-group col-12 d-flex justify-content-start">
                                    <div class="border rounded p-2 shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                            viewBox="0 0 24 24">
                                            <g fill="none" stroke="#0284c7" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5" color="#e11d48">
                                                <path
                                                    d="M11.53 22h-1.06c-3.992 0-5.989 0-7.23-1.172C2 19.657 2 17.771 2 14v-4c0-3.771 0-5.657 1.24-6.828C4.481 2 6.478 2 10.47 2h1.06c3.993 0 5.989 0 7.23 1.172C20 4.343 20 6.229 20 10v.5M7 7h8m-8 5h5" />
                                                <path
                                                    d="M18 20.714V22m0-1.286a3.36 3.36 0 0 1-2.774-1.43M18 20.713a3.36 3.36 0 0 0 2.774-1.43M18 14.285c1.157 0 2.176.568 2.774 1.43M18 14.287a3.36 3.36 0 0 0-2.774 1.43M18 14.287V13m4 1.929l-1.226.788M14 20.07l1.226-.788M14 14.93l1.226.788M22 20.07l-1.226-.788m0-3.566a3.12 3.12 0 0 1 0 3.566m-5.548-3.566a3.12 3.12 0 0 0 0 3.566" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="ps-2">
                                        <p class="fw-bold mb-0">Cédula profesional</p>
                                        <div class="mt-0"> {{ auth()->user()->cedula ?? '--' }} </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                            <div class="form-group col-12">
                                <div class="form-group col-12 d-flex justify-content-start">
                                    <div class="border rounded p-2 shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                            viewBox="0 0 256 256">
                                            <path fill="#0284c7"
                                                d="M213 174.26a12 12 0 0 0-16.76 2.74q-1.47 2.06-3.05 4a76 76 0 0 0-30-28.37a48 48 0 1 0-70.28.08a76.8 76.8 0 0 0-30.06 28.25a83.6 83.6 0 0 1-18.3-43.55a12 12 0 0 0 16-17.88l-20-20a12 12 0 0 0-17 0l-20 20a12 12 0 0 0 16.83 17.1a107.88 107.88 0 0 0 37.72 73.61a12.3 12.3 0 0 0 1.88 1.57a107.82 107.82 0 0 0 136.47-.26a13 13 0 0 0 1.28-1.06a107.7 107.7 0 0 0 18-19.46a12 12 0 0 0-2.73-16.77M128 96a24 24 0 1 1-24 24a24 24 0 0 1 24-24m0 116a83.5 83.5 0 0 1-46.94-14.37a52 52 0 0 1 93.88 0A84.07 84.07 0 0 1 128 212m124.49-75.51l-20 20a12 12 0 0 1-17 0l-20-20a12 12 0 0 1 16-17.88A84 84 0 0 0 59.74 79a12 12 0 1 1-19.48-14a108 108 0 0 1 195.4 54.4a12 12 0 0 1 16.83 17.1Z" />
                                        </svg>
                                    </div>
                                    <div class="ps-2">
                                        <p class="fw-bold mb-0">Código (UdG)</p>
                                        <div class="mt-0"> {{ auth()->user()->user_name }} </div>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group col-12 mt-3">
                                <div class="form-group col-12 d-flex justify-content-start">
                                    <div class="border rounded p-2 shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                            viewBox="0 0 24 24">
                                            <path fill="#0284c7"
                                                d="M23 19a4 4 0 0 1-4 4h-2v-2h2a2 2 0 0 0 0-4h-2v-2h2a4 4 0 0 1 4 4M9 19a4 4 0 0 1 4-4h2v2h-2a2 2 0 0 0 0 4h2v2h-2a4 4 0 0 1-4-4" />
                                            <path fill="#0284c7"
                                                d="M14 18h4v2h-4zM9 5a3 3 0 1 0 3 3a3.01 3.01 0 0 0-3-3m0 4a1 1 0 1 1 1-1a1.003 1.003 0 0 1-1 1m-3.69 6A7 7 0 0 1 9 13.88a6 6 0 0 1 .778.064A5.97 5.97 0 0 1 13 13h.254A9.4 9.4 0 0 0 9 11.89c-2.03 0-6 1.07-6 3.58V17h4.349a6 6 0 0 1 1.188-2Z" />
                                            <path fill="#0284c7"
                                                d="M16 2h-4.18a2.988 2.988 0 0 0-5.64 0H2a2.006 2.006 0 0 0-2 2v14a2.006 2.006 0 0 0 2 2h5.141a3.6 3.6 0 0 1 0-2H2V4h14v9h2V4a2.006 2.006 0 0 0-2-2M9 3.25a.756.756 0 0 1-.75-.75a.75.75 0 0 1 1.5 0a.756.756 0 0 1-.75.75" />
                                        </svg>
                                    </div>
                                    <div class="ps-2">
                                        <p class="fw-bold mb-0">Tipo de usuario</p>
                                        <div class="mt-0"> {{ $role }} </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group col-12 mt-3">
                                <div class="form-group col-12 d-flex justify-content-start">
                                    <div class="border rounded p-2 shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                            viewBox="0 0 24 24">
                                            <g fill="none" stroke="#0284c7" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2">
                                                <rect width="20" height="18" x="2" y="4" rx="4" />
                                                <path d="M8 2v4m8-4v4M2 10h20" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="ps-2">
                                        <p class="fw-bold mb-0">Fecha de ingreso</p>
                                        <div class="mt-0">
                                            {{ Carbon::parse(auth()->user()->created_at)->locale('es')->isoFormat('LL') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Contenedor para cambiar contraseña  --}}
                    <div id="cont-change" class="d-none animate__animated animate__fadeInUp animate__backOutDown mt-3 ">
                        <div class="row col-12 mx-2 border border rounded shadow ps-3 pe-2 pb-4 py-3">
                            <h5 class="text-center pt-1">Actualizar mi contraseña</h5>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <section class="step1">

                                    <h5 class="mb-2 mt-1 aling-items-center">
                                        <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                height="20" viewBox="0 0 48 48">
                                                <path fill="#8BC34A"
                                                    d="m24 3l4.7 3.6l5.8-.8l2.2 5.5l5.5 2.2l-.8 5.8L45 24l-3.6 4.7l.8 5.8l-5.5 2.2l-2.2 5.5l-5.8-.8L24 45l-4.7-3.6l-5.8.8l-2.2-5.5l-5.5-2.2l.8-5.8L3 24l3.6-4.7l-.8-5.8l5.5-2.2l2.2-5.5l5.8.8z" />
                                                <path fill="#CCFF90"
                                                    d="M34.6 14.6L21 28.2l-5.6-5.6l-2.8 2.8l8.4 8.4l16.4-16.4z" />
                                            </svg>
                                        </span> Verifica tu identidad
                                    </h5>

                                    {{-- formulario --}}
                                    <p class="fs-6 text-muted"> Confirma que realmente eres <i>
                                            {{ auth()->user()->name }},</i> escribe tu contraseña actual. </p>

                                    <div class="form-group col-10">

                                        {{-- Alerta de errores --}}
                                        <x-alert-manage containerClass="step1-Alert" textClass="step1-text">
                                        </x-alert-manage>
                                        <label for="Pass">Contraseña <span class="red-color">*</span> </label>
                                        <input class="form-control form-disabled" type="password" name="Pass"
                                            id="Pass" maxlength="13">
                                        <span class="text-danger fw-normal" style=" display: none;">Contraseña no
                                            válida.</span>

                                        <div class="d-flex justify-content-center mt-3 gap-2">
                                            <x-button-custom type="button"
                                                class="btn-red justify-content-center justify-content-lg-start cancel-pass"
                                                text="Cancelar" tooltipText="Cancelar acción.">
                                                <x-slot name="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 2048 2048">
                                                        <path
                                                            d="m1115 1024l690 691l-90 90l-691-690l-691 690l-90-90l690-691l-690-691l90-90l691 690l691-690l90 90z" />
                                                    </svg>
                                                </x-slot>
                                            </x-button-custom>

                                            <x-button-custom type="button"
                                                class="btn-sec justify-content-center justify-content-lg-start"
                                                id="Verify-pass" text="Verificar" tooltipText="Verificar contraseña.">
                                                <x-slot name="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M3 17h18q.425 0 .713.288T22 18t-.288.713T21 19H3q-.425 0-.712-.288T2 18t.288-.712T3 17m1-5.55l-.475.85q-.15.275-.45.35t-.575-.075t-.35-.45t.075-.575l.475-.85h-.95q-.325 0-.537-.212T1 9.95t.213-.537t.537-.213h.95l-.475-.8q-.15-.275-.075-.575t.35-.45t.575-.075t.45.35l.475.8l.475-.8q.15-.275.45-.35t.575.075t.35.45t-.075.575l-.475.8h.95q.325 0 .538.213T7 9.95t-.213.538t-.537.212H5.3l.475.85q.15.275.075.575t-.35.45t-.575.075t-.45-.35zm8 0l-.475.85q-.15.275-.45.35t-.575-.075t-.35-.45t.075-.575l.475-.85h-.95q-.325 0-.537-.212T9 9.95t.213-.537t.537-.213h.95l-.475-.8q-.15-.275-.075-.575t.35-.45t.575-.075t.45.35l.475.8l.475-.8q.15-.275.45-.35t.575.075t.35.45t-.075.575l-.475.8h.95q.325 0 .537.213T15 9.95t-.213.538t-.537.212h-.95l.475.85q.15.275.075.575t-.35.45t-.575.075t-.45-.35zm8 0l-.475.85q-.15.275-.45.35t-.575-.075t-.35-.45t.075-.575l.475-.85h-.95q-.325 0-.537-.212T17 9.95t.213-.537t.537-.213h.95l-.475-.8q-.15-.275-.075-.575t.35-.45t.575-.075t.45.35l.475.8l.475-.8q.15-.275.45-.35t.575.075t.35.45t-.075.575l-.475.8h.95q.325 0 .538.213T23 9.95t-.213.538t-.537.212h-.95l.475.85q.15.275.075.575t-.35.45t-.575.075t-.45-.35z" />
                                                    </svg>
                                                </x-slot>
                                            </x-button-custom>
                                        </div>
                                    </div>
                                </section>

                                <section
                                    class="step2 d-none animate__animated animate__fadeInUp animate__backOutDown mt-2 cont-info">
                                    <div class="step2  mt-2 p-2">
                                        <h5 class="mb-3 mt-1 aling-items-center">
                                            <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" viewBox="0 0 48 48">
                                                    <circle cx="24" cy="24" r="21" fill="#2196F3" />
                                                    <path fill="#fff" d="M22 22h4v11h-4z" />
                                                    <circle cx="24" cy="16.5" r="2.5" fill="#fff" />
                                                </svg>
                                            </span> Estructura de la contraseña
                                        </h5>

                                        <div class="list-group text-muted">
                                            <li class="list-group-item">Mínimo 4 carácteres y máximo 13.</li>
                                            <li class="list-group-item">Al menos una letra minúscula.</li>
                                            <li class="list-group-item">Al menos una letra mayúscula.</li>
                                            <li class="list-group-item">Al menos un carácter especial como @, #, $, %, &,+, o =.</li>
                                        </div>

                                    </div>
                                </section>
                            </div>
                            {{-- Contenedor del lado derecho   --}}
                            <div class="col-lg-6 col-md-6 col-sm-12 mt-sm-3">
                                {{-- Imagne del candado --}}
                                <section class="step1 cont-info">


                                    <div class="col-12 d-flex justify-content-center">
                                        <svg class="Shadown-Icon" xmlns="http://www.w3.org/2000/svg" width="150"
                                            height="150" viewBox="0 0 32 32">
                                            <path fill="#0284c7"
                                                d="M16 16a7 7 0 1 0 0-14a7 7 0 0 0 0 14m-8.5 2A3.5 3.5 0 0 0 4 21.5v.5c0 2.393 1.523 4.417 3.685 5.793C9.859 29.177 12.802 30 16 30c2.718 0 5.25-.594 7.285-1.622v-5.067A5.78 5.78 0 0 1 20.735 18zm17.07 9.626v-5.06a4.5 4.5 0 1 1 3.215.248V23l1.474 1.474a.643.643 0 0 1 0 .91l-1.474 1.473l1.493 1.493a.643.643 0 0 1 .019.89l-2.344 2.55a.643.643 0 0 1-.928.02l-1.266-1.266a.64.64 0 0 1-.188-.454zm3.055-10.25a1.125 1.125 0 1 0-2.25 0a1.125 1.125 0 0 0 2.25 0" />
                                        </svg>
                                    </div>



                                </section>
                                {{-- Formulario para la nueva contraseña --}}
                                <section class="step2 d-none  animate__animated animate__fadeInUp animate__backOutDown">
                                    <div>
                                        {{-- Alerta para los errores  --}}
                                        <x-alert-manage containerClass="step2-Alert" textClass="step2-text">
                                        </x-alert-manage>



                                        <p class="text-center p-0">Ingresa la contraseña nueva</p>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label for="New_Pass">Contraseña <span class="red-color">*</span>
                                                </label>

                                                <input class="form-control" type="password" name="New_Pass"
                                                    id="New_Pass" value="" maxlength="13">

                                                <span class="text-danger fw-normal" style=" display: none;">Contraseña no
                                                    válido.</span>

                                            </div>

                                            <div class="form-group col-md-6 col-sm-12">
                                                <label for="Confirm">Confirmar contraseña <span
                                                        class="red-color">*</span></label>

                                                <input class="form-control" type="password" name="Confirm"
                                                    id="Confirm" value="" maxlength="13">
                                                <span class="text-danger fw-normal" style=" display: none;">Contraseña no
                                                    válido.</span>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center mt-3 gap-2 ">
                                        <x-button-custom type="button"
                                            class="btn-red justify-content-center justify-content-lg-start cancel-pass"
                                            text="Cancelar" tooltipText="Cancelar acción.">
                                            <x-slot name="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 2048 2048">
                                                    <path
                                                        d="m1115 1024l690 691l-90 90l-691-690l-691 690l-90-90l690-691l-690-691l90-90l691 690l691-690l90 90z" />
                                                </svg>
                                            </x-slot>
                                        </x-button-custom>

                                        <x-button-custom type="button"
                                            class="btn-blue-sec justify-content-center justify-content-lg-start"
                                            id="save" text="Guardar" tooltipText="Guardar cambios.">
                                            <x-slot name="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 32 32">
                                                    <path
                                                        d="M2 26h28v2H2zM25.4 9c.8-.8.8-2 0-2.8l-3.6-3.6c-.8-.8-2-.8-2.8 0l-15 15V24h6.4zm-5-5L24 7.6l-3 3L17.4 7zM6 22v-3.6l10-10l3.6 3.6l-10 10z" />
                                                </svg>
                                            </x-slot>
                                        </x-button-custom>

                                    </div>

                                </section>
                            </div>
                        </div>

                    </div>

                    <div class="col-12 p-0 mt-2">
                        <div class="row mt-1">
                            <div class="d-flex justify-content-end">
                                <div class="mx-2">
                                    <x-button-link-custom :route="route('home')" class="btn-red " text="Inicio"
                                        tooltipText="Ir al inicio.">
                                        <x-slot name="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M20 10a1 1 0 1 0-2 0zM6 10a1 1 0 0 0-2 0zm14.293 2.707a1 1 0 0 0 1.414-1.414zM12 3l.707-.707a1 1 0 0 0-1.414 0zm-9.707 8.293a1 1 0 1 0 1.414 1.414zM7 22h10v-2H7zm13-3v-9h-2v9zM6 19v-9H4v9zm15.707-7.707l-9-9l-1.414 1.414l9 9zm-10.414-9l-9 9l1.414 1.414l9-9zM17 22a3 3 0 0 0 3-3h-2a1 1 0 0 1-1 1zM7 20a1 1 0 0 1-1-1H4a3 3 0 0 0 3 3z" />
                                            </svg>
                                        </x-slot>
                                    </x-button-link-custom>

                                </div>
                                <div class="mx-2">
                                    {{-- <button class="btn-blue-sec fst-normal tooltip-container p-1" >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 32 32">
                                            <path
                                                d="M21 2a8.998 8.998 0 0 0-8.612 11.612L2 24v6h6l10.388-10.388A9 9 0 1 0 21 2m0 16a7 7 0 0 1-2.032-.302l-1.147-.348l-.847.847l-3.181 3.181L12.414 20L11 21.414l1.379 1.379l-1.586 1.586L9.414 23L8 24.414l1.379 1.379L7.172 28H4v-3.172l9.802-9.802l.848-.847l-.348-1.147A7 7 0 1 1 21 18" />
                                            <circle cx="22" cy="10" r="2" />
                                        </svg>
                                        Contraseña
                                        <span class="tooltip-text">Cambiar contraseña.</span>
                                    </button> --}}

                                    <x-button-custom type="button"
                                        class="btn-blue-sec justify-content-center justify-content-lg-start"
                                        id="Change-pass" text="Contraseña" tooltipText="Cambiar contraseña.">
                                        <x-slot name="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 32 32">
                                                <path
                                                    d="M21 2a8.998 8.998 0 0 0-8.612 11.612L2 24v6h6l10.388-10.388A9 9 0 1 0 21 2m0 16a7 7 0 0 1-2.032-.302l-1.147-.348l-.847.847l-3.181 3.181L12.414 20L11 21.414l1.379 1.379l-1.586 1.586L9.414 23L8 24.414l1.379 1.379L7.172 28H4v-3.172l9.802-9.802l.848-.847l-.348-1.147A7 7 0 1 1 21 18" />
                                                <circle cx="22" cy="10" r="2" />
                                            </svg>
                                        </x-slot>
                                    </x-button-custom>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    @endsection

    @section('scripts')
        @vite('resources/js/perfil/perfil.js')
    @endsection
