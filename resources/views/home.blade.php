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

        <div class="d-flex justify-content-center m-2">
            <div class="row cont-principal col-12 m-0  gap-2">
                <P class="text-center mt-0 p-0"> Consultas</P>
                {{-- Primer card del home --}}
                <div class="col-md-6 col-sm-12 col-xl-3 border rounded-end shadow p-2">
                    <p class="text-center title-home m-0">Consultas de hoy</p>
                    <div class="row p-0 m-0">
                        <div class="d-flex justify-content-between py-1">
                            <div class="col-auto d-flex justify-content-center align-items-center">
                                <span class="rounded-icon icon-blue">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12 1.25a.75.75 0 0 1 .75.75v.251a3.75 3.75 0 0 1 3.7 3.418c.014.166.014.354.014.629V7.52c0 3.87-2.944 7.05-6.714 7.427V17A4.25 4.25 0 0 0 14 21.25h.882a3.37 3.37 0 0 0 2.924-1.694A3.752 3.752 0 0 1 19 12.25a3.75 3.75 0 0 1 .387 7.48a4.869 4.869 0 0 1-4.505 3.02H14A5.75 5.75 0 0 1 8.25 17v-2.05a7.751 7.751 0 0 1-7-7.715v-.937c0-.275 0-.463.015-.628A3.75 3.75 0 0 1 4.67 2.265a6.88 6.88 0 0 1 .58-.015V2a.75.75 0 1 1 1.5 0v2a.75.75 0 0 1-1.5 0v-.25c-.263 0-.366.001-.448.009a2.25 2.25 0 0 0-2.043 2.043c-.008.09-.009.206-.009.535v.898A6.25 6.25 0 0 0 9 13.485a5.964 5.964 0 0 0 5.964-5.964V6.337c0-.329 0-.445-.008-.535a2.25 2.25 0 0 0-2.206-2.05V4a.75.75 0 0 1-1.5 0V2a.75.75 0 0 1 .75-.75M16.75 16a2.25 2.25 0 1 1 4.5 0a2.25 2.25 0 0 1-4.5 0"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col px-2">
                                <p class="m-0">Consultorio</p>
                                <p class="m-0 text-center fw-bolder">Médico</p>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <div>
                                    <h2>12</h2>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between py-1">
                            <div class="col-auto d-flex justify-content-center align-items-center">
                                <span class="rounded-icon icon-green">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        viewBox="0 0 24 24">
                                        <path fill="#000000"
                                            d="M8.397 11.235a.75.75 0 0 0-.294-1.471c-.903.18-1.585.812-1.948 1.659c-.36.838-.413 1.886-.132 3.008a.75.75 0 1 0 1.455-.363c-.22-.878-.148-1.58.055-2.054c.2-.466.518-.71.864-.78M5.471 3.419A5.18 5.18 0 0 0 6.89 7.302a5.12 5.12 0 0 0-3.66 4.216a10.46 10.46 0 0 0 1.37 6.796l.35.59l.043.063l1.416 1.906a3.462 3.462 0 0 0 5.275.336a.437.437 0 0 1 .63 0a3.462 3.462 0 0 0 5.275-.336l1.416-1.907l.042-.063l.351-.59a10.46 10.46 0 0 0 1.373-6.795a5.12 5.12 0 0 0-6.11-4.306l-1.901.394h-.003c.03-.78.152-1.62.391-2.338c.29-.868.692-1.39 1.14-1.576a.75.75 0 1 0-.578-1.385c-1.052.439-1.65 1.48-1.985 2.486l-.046.142a5.2 5.2 0 0 0-.943-1.29a5.18 5.18 0 0 0-3.98-1.51A1.367 1.367 0 0 0 5.47 3.418m1.493.207a3.68 3.68 0 0 1 2.712 1.08a3.68 3.68 0 0 1 1.08 2.712a4 4 0 0 1-.543-.025l-.617-.128a3.7 3.7 0 0 1-1.552-.927a3.68 3.68 0 0 1-1.08-2.712m2.07 5.055l.202.042q.36.102.73.152l.97.2a5.25 5.25 0 0 0 2.13 0l1.902-.394a3.62 3.62 0 0 1 4.32 3.045a8.96 8.96 0 0 1-1.177 5.821l-.331.557l-1.393 1.876a1.962 1.962 0 0 1-2.99.19a1.936 1.936 0 0 0-2.792 0a1.962 1.962 0 0 1-2.99-.19l-1.393-1.876l-.331-.557a8.96 8.96 0 0 1-1.176-5.821A3.62 3.62 0 0 1 9.033 8.68" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col px-2">
                                <p class="m-0">Consultorio</p>
                                <p class="m-0 text-center fw-bolder">Nutrición</p>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <div>
                                    <h2>12</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- segunda card del home --}}
                <div class="col-md-6 col-sm-12 col-xl-3 border rounded-end shadow p-2">
                    <p class="text-center title-home m-0">Consultas de hoy</p>
                    <div class="row p-0 m-0">
                        <div class="d-flex justify-content-between py-1">
                            <div class="col-auto d-flex justify-content-center align-items-center">
                                <span class="rounded-icon icon-blue">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12 1.25a.75.75 0 0 1 .75.75v.251a3.75 3.75 0 0 1 3.7 3.418c.014.166.014.354.014.629V7.52c0 3.87-2.944 7.05-6.714 7.427V17A4.25 4.25 0 0 0 14 21.25h.882a3.37 3.37 0 0 0 2.924-1.694A3.752 3.752 0 0 1 19 12.25a3.75 3.75 0 0 1 .387 7.48a4.869 4.869 0 0 1-4.505 3.02H14A5.75 5.75 0 0 1 8.25 17v-2.05a7.751 7.751 0 0 1-7-7.715v-.937c0-.275 0-.463.015-.628A3.75 3.75 0 0 1 4.67 2.265a6.88 6.88 0 0 1 .58-.015V2a.75.75 0 1 1 1.5 0v2a.75.75 0 0 1-1.5 0v-.25c-.263 0-.366.001-.448.009a2.25 2.25 0 0 0-2.043 2.043c-.008.09-.009.206-.009.535v.898A6.25 6.25 0 0 0 9 13.485a5.964 5.964 0 0 0 5.964-5.964V6.337c0-.329 0-.445-.008-.535a2.25 2.25 0 0 0-2.206-2.05V4a.75.75 0 0 1-1.5 0V2a.75.75 0 0 1 .75-.75M16.75 16a2.25 2.25 0 1 1 4.5 0a2.25 2.25 0 0 1-4.5 0"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col px-2">
                                <p class="m-0">Consultorio</p>
                                <p class="m-0 text-center fw-bolder">Médico</p>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <div>
                                    <h2>12</h2>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between py-1">
                            <div class="col-auto d-flex justify-content-center align-items-center">
                                <span class="rounded-icon icon-green">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        viewBox="0 0 24 24">
                                        <path fill="#000000"
                                            d="M8.397 11.235a.75.75 0 0 0-.294-1.471c-.903.18-1.585.812-1.948 1.659c-.36.838-.413 1.886-.132 3.008a.75.75 0 1 0 1.455-.363c-.22-.878-.148-1.58.055-2.054c.2-.466.518-.71.864-.78M5.471 3.419A5.18 5.18 0 0 0 6.89 7.302a5.12 5.12 0 0 0-3.66 4.216a10.46 10.46 0 0 0 1.37 6.796l.35.59l.043.063l1.416 1.906a3.462 3.462 0 0 0 5.275.336a.437.437 0 0 1 .63 0a3.462 3.462 0 0 0 5.275-.336l1.416-1.907l.042-.063l.351-.59a10.46 10.46 0 0 0 1.373-6.795a5.12 5.12 0 0 0-6.11-4.306l-1.901.394h-.003c.03-.78.152-1.62.391-2.338c.29-.868.692-1.39 1.14-1.576a.75.75 0 1 0-.578-1.385c-1.052.439-1.65 1.48-1.985 2.486l-.046.142a5.2 5.2 0 0 0-.943-1.29a5.18 5.18 0 0 0-3.98-1.51A1.367 1.367 0 0 0 5.47 3.418m1.493.207a3.68 3.68 0 0 1 2.712 1.08a3.68 3.68 0 0 1 1.08 2.712a4 4 0 0 1-.543-.025l-.617-.128a3.7 3.7 0 0 1-1.552-.927a3.68 3.68 0 0 1-1.08-2.712m2.07 5.055l.202.042q.36.102.73.152l.97.2a5.25 5.25 0 0 0 2.13 0l1.902-.394a3.62 3.62 0 0 1 4.32 3.045a8.96 8.96 0 0 1-1.177 5.821l-.331.557l-1.393 1.876a1.962 1.962 0 0 1-2.99.19a1.936 1.936 0 0 0-2.792 0a1.962 1.962 0 0 1-2.99-.19l-1.393-1.876l-.331-.557a8.96 8.96 0 0 1-1.176-5.821A3.62 3.62 0 0 1 9.033 8.68" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col px-2">
                                <p class="m-0">Consultorio</p>
                                <p class="m-0 text-center fw-bolder">Nutrición</p>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <div>
                                    <h2>12</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-3"></div>
                <div class="col-3"></div>
            </div>
        </div>
    </div>


    {{-- <div class="col-12">
    <div class="container">
    <div class="col-12 d-flex justify-content-center">
        <p>
            <div>
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item">
                        <font size=5 color="4f514e">Citas pendientes</font> 
                        <br>
                        <font color="56a72e" size=4>5 Citas</font>
                        <br><br>
                        20 Marzo
                    </li>
                    <li class="list-group-item">
                        <font size=5 color="4f514e">Citas pendientes</font> 
                        <br>
                        <font color="56a72e" size=4>5 Citas</font>
                        <br><br>
                        20 Marzo
                    </li>
                    <li class="list-group-item">
                        <font size=5 color="4f514e">Citas pendientes</font> 
                        <br>
                        <font color="56a72e" size=4>5 Citas</font>
                        <br><br>
                        20 Marzo
                    </li>
                    <li class="list-group-item">
                        <font size=5 color="4f514e">Citas pendientes</font> 
                        <br>
                        <font color="56a72e" size=4>5 Citas</font>
                        <br><br>
                        20 Marzo
                    </li>
                </ul>
            </div>
        </p>
    </div>
    </div>
</div> --}}

@endsection
