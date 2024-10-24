@extends('admin.layouts.main')

@section('title', 'Detalles de usuarios')

@section('viteConfig')
    @vite(['resources/sass/form-style.scss', 'resources/sass/users.scss', 'resources/sass/drag-and-drop-file.scss'])
@endsection

@section('content')
    <div class="container ml-2">
        <!-- Card para mostrar todos los datos  -->
        <div id="detalles-container" data-id="{{ $usuario->id }}"></div>

        <x-card-custom title="Detalles del usuario">
            <div class="row col-12 mx-2 p-1">
                <div class="row col-12 mx-2 p-1">
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                        <div class="form-group col-12 d-flex justify-content-start mt-sm-2">
                            <div class="border rounded p-2 shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                                    <path fill="none" stroke="#0284c7" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M6.578 15.482c-1.415.842-5.125 2.562-2.865 4.715C4.816 21.248 6.045 22 7.59 22h8.818c1.546 0 2.775-.752 3.878-1.803c2.26-2.153-1.45-3.873-2.865-4.715a10.66 10.66 0 0 0-10.844 0M16.5 6.5a4.5 4.5 0 1 1-9 0a4.5 4.5 0 0 1 9 0"
                                        color="#0284c7" />
                                </svg>
                            </div>
                            <div class="ps-2">
                                <p class="fw-bold mb-0">Nombre de usuario</p>
                                <div class="mt-0" id="User_Name">{{ $usuario->name }}</div>
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
                                    <div class="mt-0" id="email">{{ $usuario->email }}</div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group col-12 mt-3">
                            <div class="form-group col-12 d-flex justify-content-start">
                                <div class="border rounded p-2 shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        viewBox="0 0 24 24">
                                        <g fill="none" stroke="#0284c7" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.5" color="#e11d48">
                                            <path
                                                d="M11.53 22h-1.06c-3.992 0-5.989 0-7.23-1.172C2 19.657 2 17.771 2 14v-4c0-3.771 0-5.657 1.24-6.828C4.481 2 6.478 2 10.47 2h1.06c3.993 0 5.989 0 7.23 1.172C20 4.343 20 6.229 20 10v.5M7 7h8m-8 5h5" />
                                            <path
                                                d="M18 20.714V22m0-1.286a3.36 3.36 0 0 1-2.774-1.43M18 20.713a3.36 3.36 0 0 0 2.774-1.43M18 14.285c1.157 0 2.176.568 2.774 1.43M18 14.287a3.36 3.36 0 0 0-2.774 1.43M18 14.287V13m4 1.929l-1.226.788M14 20.07l1.226-.788M14 14.93l1.226.788M22 20.07l-1.226-.788m0-3.566a3.12 3.12 0 0 1 0 3.566m-5.548-3.566a3.12 3.12 0 0 0 0 3.566" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="ps-2">
                                    <p class="fw-bold mb-0">Cédula profesional</p>
                                    <div class="mt-0" id="Cedula">{{ $usuario->cedula ?? '--' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-12 mt-3">
                            <div class="form-group col-12 d-flex justify-content-start">
                                <div class="border rounded p-2 shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        viewBox="0 0 15 15">
                                        <path fill="#0284c7" fill-rule="evenodd"
                                            d="M13.15 7.5c0-2.835-2.21-5.65-5.65-5.65c-2.778 0-4.152 2.056-4.737 3.15H4.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 1 0v1.813C2.705 3.071 4.334.85 7.5.85c4.063 0 6.65 3.335 6.65 6.65s-2.587 6.65-6.65 6.65c-1.944 0-3.562-.77-4.715-1.942a6.8 6.8 0 0 1-1.427-2.167a.5.5 0 1 1 .925-.38c.28.681.692 1.314 1.216 1.846c.972.99 2.336 1.643 4.001 1.643c3.44 0 5.65-2.815 5.65-5.65M7.5 4a.5.5 0 0 1 .5.5v2.793l1.854 1.853a.5.5 0 0 1-.708.708l-2-2A.5.5 0 0 1 7 7.5v-3a.5.5 0 0 1 .5-.5"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ps-2">
                                    <p class="fw-bold mb-0">Número de consultas</p>
                                    <div class="mt-0">{{ $count }} consultas</div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                        <div class="form-group col-12">
                            <div class="form-group col-12 d-flex justify-content-start">
                                <div class="border rounded p-2 shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        viewBox="0 0 24 24">
                                        <g fill="none" stroke="#0284c7" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.5" color="#0284c7">
                                            <path
                                                d="M8.5 18c1.813-1.954 5.167-2.046 7 0m-1.56-6c0 1.105-.871 2-1.947 2c-1.075 0-1.947-.895-1.947-2s.872-2 1.947-2s1.948.895 1.948 2" />
                                            <path
                                                d="M9.5 4.002c-2.644.01-4.059.102-4.975.97C3.5 5.943 3.5 7.506 3.5 10.632v4.737c0 3.126 0 4.69 1.025 5.66c1.025.972 2.675.972 5.975.972h3c3.3 0 4.95 0 5.975-.971c1.025-.972 1.025-2.535 1.025-5.66v-4.738c0-3.126 0-4.689-1.025-5.66c-.916-.868-2.33-.96-4.975-.97" />
                                            <path
                                                d="M9.772 3.632c.096-.415.144-.623.236-.792a1.64 1.64 0 0 1 1.083-.793C11.294 2 11.53 2 12 2s.706 0 .909.047a1.64 1.64 0 0 1 1.083.793c.092.17.14.377.236.792l.083.36c.17.735.255 1.103.127 1.386a1.03 1.03 0 0 1-.407.451C13.75 6 13.332 6 12.498 6h-.996c-.834 0-1.252 0-1.533-.17a1.03 1.03 0 0 1-.407-.452c-.128-.283-.043-.65.127-1.386z" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="ps-2">
                                    <p class="fw-bold mb-0">Código (UdG)</p>
                                    <div class="mt-0" id="User_Name">{{ $usuario->user_name }}</div>
                                </div>
                            </div>

                        </div>


                        <div class="form-group col-12 mt-3">
                            <div class="form-group col-12 d-flex justify-content-start">
                                <div class="border rounded p-2 shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        viewBox="0 0 24 24">
                                        <path fill="#0284c7"
                                            d="M4 18v-.65c0-.34.16-.66.41-.81C6.1 15.53 8.03 15 10 15c.03 0 .05 0 .08.01c.1-.7.3-1.37.59-1.98c-.22-.02-.44-.03-.67-.03c-2.42 0-4.68.67-6.61 1.82c-.88.52-1.39 1.5-1.39 2.53V20h9.26c-.42-.6-.75-1.28-.97-2zm6-6c2.21 0 4-1.79 4-4s-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4m0-6c1.1 0 2 .9 2 2s-.9 2-2 2s-2-.9-2-2s.9-2 2-2m10.75 10c0-.22-.03-.42-.06-.63l1.14-1.01l-1-1.73l-1.45.49q-.48-.405-1.08-.63L18 11h-2l-.3 1.49q-.6.225-1.08.63l-1.45-.49l-1 1.73l1.14 1.01c-.03.21-.06.41-.06.63s.03.42.06.63l-1.14 1.01l1 1.73l1.45-.49q.48.405 1.08.63L16 21h2l.3-1.49q.6-.225 1.08-.63l1.45.49l1-1.73l-1.14-1.01c.03-.21.06-.41.06-.63M17 18c-1.1 0-2-.9-2-2s.9-2 2-2s2 .9 2 2s-.9 2-2 2" />
                                    </svg>
                                </div>
                                <div class="ps-2">
                                    <p class="fw-bold mb-0">Rol/Tipo de usuario</p>
                                    <div class="mt-0" id="User_Role">{{ $roleName }}</div>
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
                                        {{ $created_at }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-12 mt-3">
                            <div class="form-group col-12 d-flex justify-content-start">
                                <div class="border rounded p-2 shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        viewBox="0 0 24 24">
                                        <g fill="none" stroke="#0284c7" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="1.5" color="#0284c7">
                                            <path
                                                d="M13 21.95q-.493.05-1 .05C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10q0 .507-.05 1" />
                                            <path
                                                d="M7.5 17c1.402-1.469 3.521-2.096 5.5-1.806M14.495 9.5c0 1.38-1.12 2.5-2.503 2.5a2.5 2.5 0 0 1-2.504-2.5c0-1.38 1.12-2.5 2.504-2.5a2.5 2.5 0 0 1 2.503 2.5" />
                                            <circle cx="18.5" cy="18.5" r="3.5" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="ps-2">
                                    <p class="fw-bold mb-0">Estado:</p>
                                    <div class="mt-0" id="User_Status">{{ $usuario->estado }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 p-0 mt-4">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between">
                            <div>
                                <x-button-link-custom :route="route('users.file', ['id_user' => $usuario->id])" class="btn-blue-sec" text="Descargar"
                                    tooltipText="Descarga la carta compromiso del usuario">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            viewBox="0 0 15 15">
                                            <path fill="currentColor"
                                                d="M2.5 6.5V6H2v.5zm4 0V6H6v.5zm0 4H6v.5h.5zm7-7h.5v-.207l-.146-.147zm-3-3l.354-.354L10.707 0H10.5zM2.5 7h1V6h-1zm.5 4V8.5H2V11zm0-2.5v-2H2v2zm.5-.5h-1v1h1zm.5-.5a.5.5 0 0 1-.5.5v1A1.5 1.5 0 0 0 5 7.5zM3.5 7a.5.5 0 0 1 .5.5h1A1.5 1.5 0 0 0 3.5 6zM6 6.5v4h1v-4zm.5 4.5h1v-1h-1zM9 9.5v-2H8v2zM7.5 6h-1v1h1zM9 7.5A1.5 1.5 0 0 0 7.5 6v1a.5.5 0 0 1 .5.5zM7.5 11A1.5 1.5 0 0 0 9 9.5H8a.5.5 0 0 1-.5.5zM10 6v5h1V6zm.5 1H13V6h-2.5zm0 2H12V8h-1.5zM2 5V1.5H1V5zm11-1.5V5h1V3.5zM2.5 1h8V0h-8zm7.646-.146l3 3l.708-.708l-3-3zM2 1.5a.5.5 0 0 1 .5-.5V0A1.5 1.5 0 0 0 1 1.5zM1 12v1.5h1V12zm1.5 3h10v-1h-10zM14 13.5V12h-1v1.5zM12.5 15a1.5 1.5 0 0 0 1.5-1.5h-1a.5.5 0 0 1-.5.5zM1 13.5A1.5 1.5 0 0 0 2.5 15v-1a.5.5 0 0 1-.5-.5z" />
                                        </svg>
                                    </x-slot>
                                    </x-button-custom>


                            </div>
                            <div class="d-flex gap-1">
                                <x-button-link-custom :route="route('users.users')" class="btn-red me-3"
                                    tooltipText="Volver a la lista de usuarios" text="Atras">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 1024 1024">
                                            <path d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64" />
                                            <path
                                                d="m237.248 512l265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312z" />
                                        </svg>
                                    </x-slot>

                                </x-button-link-custom>

                                <x-button-custom class="btn-sec" data-bs-toggle="modal" data-bs-target="#EditData"
                                    text="Editar" tooltipText="Editar datos del usuario.">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
                                        </svg>
                                    </x-slot>
                                </x-button-custom>

                            </div>
                        </div>

                    </div>
                </div>


            </div>

            {{-- Modal para editar los datos del usuario --}}
            @include('user.modals.Modal-Edit')
        </x-card-custom>

    @endsection


    @section('scripts')
        @vite('resources/js/users/Users.js')
    @endsection
