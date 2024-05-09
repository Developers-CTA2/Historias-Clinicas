@extends('admin.layouts.main')

@section('title', 'Inicio')

@section('viteConfig')
@vite(['resources/sass/sideBar.scss', 'resources/sass/home.scss', 'resources/js/app.js'])
@endsection


{{-- @section('titleView','Estadistica') --}}


@section('breadCrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Revisa la ultima información</li>
    </ol>
</nav>
   
@endsection

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-12 text-center border-bottom mt-0">
            <h4 class="fst-italic"> Bienvenido de nuevo</h4>
            <p>Revisa la ultima informacion</p>
        </div>
    </div>
</div>
<br><br><br>
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

Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia voluptas placeat laboriosam repellendus unde eum aperiam voluptates asperiores saepe id assumenda doloremque cumque reprehenderit, temporibus, nulla inventore nemo, harum odit!
@endsection