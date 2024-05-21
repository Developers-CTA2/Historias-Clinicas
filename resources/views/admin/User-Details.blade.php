@extends('admin.layouts.main')

@section('title', 'Detalles de usuarios')

@section('viteConfig')
    @vite(['resources/sass/User-Details.scss'])
@endsection

<!-- Esto no se que hace pero lo puse jsjsjsj -->
@section('breadCrumb')
    <nav aria-label="breadcrumb" class="d-flex justify-content-between align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="item-custom-link" href="{{ route('users') }}">Usuarios</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Detalles</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container ml-2">
        <!-- Card para mostrar todos los datos  -->
        <div class="card">
            <div class="card-header text-center">
                Detalles del usuario
            </div>
            <div class="card-body">
                <div class="row col-12">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col-12 pt-2">
                                    <p class="fw-bold mb-0">Nombre:</p>
                                    <div class="mt-0" id="User_Name">{{ $usuario->name }}</div>
                                </div>
                                <div class="form-group col-12 pt-2">
                                    <p class="fw-bold mb-0">Correo:</p>
                                    <div class="mt-0" id="email">{{ $usuario->email }}</div>
                                </div>

                                <div class="form-group col-12 pt-2">
                                    <p class="fw-bold mb-0">Cedula:</p>
                                    <div class="mt-0" id="Cedula">{{ $usuario->cedula ?? '--' }}</div>

                                </div>
                                <div class="form-group col-12 pt-2">
                                    <p class="fw-bold mb-0">Número de consultas:</p>
                                    <div class="mt-0" id="Cedula">{{ $count }} consultas</div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- FIN contenedor 1  -->

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col-12 pt-2">
                                    <p class="fw-bold mb-0">Código:</p>
                                    <div class="mt-0" id="User_Name">{{ $usuario->user_name }}</div>
                                </div>
                                <div class="form-group col-12 pt-2">
                                    <p class="fw-bold mb-0">Rol/Tipo de usuarios:</p>
                                    <div class="mt-0" id="User_Name">{{ $roleName }}</div>
                                </div>
                                <div class="form-group col-12 pt-2">
                                    <p class="fw-bold mb-0">Fecha de ingreso al sistema:</p>
                                    <div class="mt-0" id="User_Name">{{ $usuario->created_at }}</div>
                                </div>
                                <div class="form-group col-12 pt-2">
                                    <p class="fw-bold mb-0">Estado:</p>
                                    <div class="mt-0" id="User_Name">{{ $usuario->estado }}</div>
                                </div>
                            </div><!-- Fin de contenedor 2 -->
                        </div>
                    </div>

                    <div class="col-12 p-0 mt-2">
                        <div class="form-group">
                            <div class="row">
                                <div class="d-flex justify-content-end">
                                    <button href="" class="btn-blue-sec fst-normal tooltip-container" type="button" data-bs-toggle="modal" data-bs-target="#EditData">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
                                        </svg>
                                        Editar
                                        <span class="tooltip-text">Editar datos.</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   

<div class="modal fade " id="EditData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-blue">
        <h5 class="modal-title" id="staticBackdropLabel">Editar datos del usuario</h5>
        <button type="button" class="btn-custom-close" data-bs-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#ffffff" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z"/></svg></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-red py-1" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn-blue-sec py-1">Guardar</button>
      </div>
    </div>
  </div>
</div>

 </div>

@endsection

{{-- 
@section('content')

@endsection --}}
