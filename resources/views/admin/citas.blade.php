@extends('admin.layouts.main')

@section('title', 'Citas del Día')

@section('viteConfig')
@vite(['resources/sass/add-patients.scss', 'resources/sass/form-style.scss', 'resources/sass/main.scss', 'resources/sass/steps-bar.scss'])
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}">
@endsection

@section('content')
<!-- Boton para ingresar una nueva cita -->
<div class="container">
    <div class="row">
        <div class="col">
            <h4 class="mb-0">Citas del: {{ $fecha }}</h4>
        </div>
        <div class="col text-center">
            <abbr title="Agregar una nueva persona al sistema">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCitaModal">
                    <i class="fa-solid fa-plus"></i>
                    Cita
                </button>
            </abbr>
        </div>
        <div class="col">
        </div>
    </div>
</div>

<!-- Mostrar las citas dependiendo a quien corresponda -->
<div class="container max-w-custom" id="containerCita">
    <div class="row d-flex justify-content-center">
        <div class="col-2 d-flex flex-column align-items-center py-3 card-hover" style="width: 4rem;" id="medico">
            <div class="bg-avatar">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                    <path d="M540-80q-108 0-184-76t-76-184v-23q-86-14-143-80.5T80-600v-240h120v-40h80v160h-80v-40h-40v160q0 66 47 113t113 47q66 0 113-47t47-113v-160h-40v40h-80v-160h80v40h120v240q0 90-57 156.5T360-363v23q0 75 52.5 127.5T540-160q75 0 127.5-52.5T720-340v-67q-35-12-57.5-43T640-520q0-50 35-85t85-35q50 0 85 35t35 85q0 39-22.5 70T800-407v67q0 108-76 184T540-80Zm220-400q17 0 28.5-11.5T800-520q0-17-11.5-28.5T760-560q-17 0-28.5 11.5T720-520q0 17 11.5 28.5T760-480Zm0-40Z" />
                </svg>
            </div>
        </div>
        <div class="col-2 d-flex flex-column align-items-center py-3 card-hover" style="width: 4rem;" id="nuticion">
            <div class="bg-avatar">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                    <path d="M480-120q-117 0-198.5-81.5T200-400q0-94 55.5-168.5T401-669q-20-5-39-14.5T328-708q-33-33-42.5-78.5T281-879q47-5 92.5 4.5T452-832q23 23 33.5 52t13.5 61q13-31 31.5-58.5T572-828q11-11 28-11t28 11q11 11 11 28t-11 28q-22 22-39 48.5T564-667q88 28 142 101.5T760-400q0 117-81.5 198.5T480-120Zm0-80q83 0 141.5-58.5T680-400q0-83-58.5-141.5T480-600q-83 0-141.5 58.5T280-400q0 83 58.5 141.5T480-200Zm0-200Z" />
                </svg>
            </div>
        </div>
    </div>
</div>


@if ($citasDoctora->isEmpty() && $citasNutriologa->isEmpty())
<p>No hay citas para este día.</p>
@else

<div class="container" id="tablas">
    <div id="tablaDoctora" style="display: none;">
        @if ($citasDoctora->isEmpty())
        <p>No hay citas para la Doctora.</p>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Hora</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Motivo</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($citasDoctora as $cita)
                <tr>
                    <td>
                        @if ($cita->estado == 'Pendiente')
                        <i class="fa-solid fa-circle" style="color: #d56215;"></i>
                        @elseif ($cita->estado == 'Asistida')
                        <i class="fa-solid fa-circle" style="color: #056142;"></i>
                        @elseif ($cita->estado == 'Cancelada')
                        <i class="fa-solid fa-circle" style="color: #050505;"></i>
                        @elseif ($cita->estado == 'No asistida')
                        <i class="fa-solid fa-circle" style="color: #d90202;"></i>
                        @endif
                    </td>
                    <td>{{ $cita->hora }}</td>
                    <td>{{ $cita->nombre }}</td>
                    <td>{{ $cita->telefono }}</td>
                    <td>{{ $cita->email }}</td>
                    <td>{{ $cita->motivo }}</td>
                    <td>
                        @if ($cita->estado !== 'Cancelada')
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modificarCitaModal{{ $cita->id }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </button>
                        <button class="cancelarCitaButton btn btn-danger btn-sm" data-cita-id="{{ $cita->id }}"><i class="fa-solid fa-ban"></i></button>
                        @else
                        <!-- Botón para eliminar -->
                        <button class="eliminarCitaButton btn btn-danger btn-sm" data-cita-id="{{ $cita->id }}"><i class="fa-solid fa-trash"></i></button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

    <div id="tablaNutriologa" style="display: none;">
        @if ($citasNutriologa->isEmpty())
        <p>No hay citas para la Nutrióloga.</p>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Hora</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Motivo</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($citasNutriologa as $cita)
                <tr>
                    <td>
                        @if ($cita->estado == 'Pendiente')
                        <i class="fa-solid fa-circle" style="color: #d56215;"></i>
                        @elseif ($cita->estado == 'Asistida')
                        <i class="fa-solid fa-circle" style="color: #056142;"></i>
                        @elseif ($cita->estado == 'Cancelada')
                        <i class="fa-solid fa-circle" style="color: #050505;"></i>
                        @elseif ($cita->estado == 'No asistida')
                        <i class="fa-solid fa-circle" style="color: #d90202;"></i>
                        @endif
                    </td>
                    <td>{{ $cita->hora }}</td>
                    <td>{{ $cita->nombre }}</td>
                    <td>{{ $cita->telefono }}</td>
                    <td>{{ $cita->email }}</td>
                    <td>{{ $cita->motivo }}</td>
                    <td>
                        @if ($cita->estado !== 'Cancelada')
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modificarCitaModal{{ $cita->id }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </button>
                        <button class="cancelarCitaButton btn btn-danger btn-sm" data-cita-id="{{ $cita->id }}"><i class="fa-solid fa-ban"></i></button>
                        @else
                        <!-- Botón para eliminar -->
                        <button class="eliminarCitaButton btn btn-danger btn-sm" data-cita-id="{{ $cita->id }}"><i class="fa-solid fa-trash"></i></button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>

@endif

<!-- Modal para modificar cita -->
@foreach ($citas as $cita)
<div class="modal fade" id="modificarCitaModal{{ $cita->id }}" tabindex="-1" aria-labelledby="modificarCitaModalLabel{{ $cita->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modificarCitaModalLabel{{ $cita->id }}">Modificar Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modificarCitaForm" data-cita-id="{{ $cita->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row pt-2">
                            <div class="form-group col-md-6 col-sm-12 mb-2">
                                <label for="nombre_edit_{{ $cita->id }}" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre_edit_{{ $cita->id }}" name="nombre_edit_{{ $cita->id }}" value="{{ $cita->nombre }}" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 mb-2">
                                <label for="email_edit_{{ $cita->id }}" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="email_edit_{{ $cita->id }}" name="email_edit_{{ $cita->id }}" value="{{ $cita->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row pt-2">
                            <div class="form-group col-md-4 col-sm-8 mb-2">
                                <label for="telefono_edit_{{ $cita->id }}" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono_edit_{{ $cita->id }}" name="telefono_edit_{{ $cita->id }}" value="{{ $cita->telefono }}" required>
                            </div>
                            <div class="form-group col-md-4 col-sm-8 mb-2">
                                <label for="tipo_edit_{{ $cita->id }}" class="form-label">Tipo de Profesional</label>
                                <select class="form-select" id="tipo_edit_{{ $cita->id }}" name="tipo_edit_{{ $cita->id }}" required>
                                    <option value="Doctora" {{ $cita->tipo_profesional == 'Doctora' ? 'selected' : '' }}>Doctora</option>
                                    <option value="Nutrióloga" {{ $cita->tipo_profesional == 'Nutrióloga' ? 'selected' : '' }}>Nutrióloga</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 col-sm-8 mb-2">
                                <label for="hora_edit_{{ $cita->id }}" class="form-label">Hora</label>
                                <input type="time" class="form-control" id="hora_edit_{{ $cita->id }}" name="hora_edit" value="{{ $cita->hora }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row pt-2">
                            <div class="form-group col-md-4 col-sm-8 mb-2">
                                <label for="fecha_edit_{{ $cita->id }}" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="fecha_edit_{{ $cita->id }}" name="fecha_edit_{{ $cita->id }}" value="{{ $cita->fecha }}" required>
                            </div>
                            <div class="form-group col-md-4 col-sm-8 mb-2">
                                <label for="estado_edit_{{ $cita->id }}" class="form-label">Estado</label>
                                <select class="form-select" id="estado_edit_{{ $cita->id }}" name="estado_edit_{{ $cita->id }}" required>
                                    <option value="Pendiente" {{ $cita->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="Asistida" {{ $cita->estado == 'Asistida' ? 'selected' : '' }}>Asistida</option>
                                    <option value="No asistida" {{ $cita->estado == 'No asistida' ? 'selected' : '' }}>No asistida</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 col-sm-8 mb-2">
                                <label for="motivo_edit_{{ $cita->id }}" class="form-label">Motivo</label>
                                <textarea class="form-control" id="motivo_edit_{{ $cita->id }}" name="motivo_edit_{{ $cita->id }}" rows="3" required>{{ $cita->motivo }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal -->
<div class="modal fade" id="addCitaModal" tabindex="-1" aria-labelledby="addCitaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCitaModalLabel">Agregar Nueva Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('guardarCita') }}" method="POST" name="addCitaForm" id="addCitaForm">
                    @csrf
                    <input type="hidden" name="fecha" value="{{ $fecha }}">
                    <div class="form-group">
                        <div class="row pt-2">
                            <div class="form-group col-md-6 col-sm-12 mb-2">
                                <label for="Nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" name="Nombre" oninput="this.value = this.value.toUpperCase()" required>
                                <span class="text-danger fw-normal" style=" display: none;">Nombre no válido.</span>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 mb-2">
                                <label for="Email" class="form-label">Correo Electrónico:</label>
                                <input type="email" class="form-control" name="Email">
                                <span class="text-danger fw-normal" style=" display: none;">Correo no válido.</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row pt-2">
                            <div class="form-group col-md-6 col-sm-8 mb-2">
                                <label for="Telefono" class="form-label">Teléfono:</label>
                                <input type="text" class="form-control" name="Telefono" pattern="[0-9]{10}" maxlength="10" required>
                                <span class="text-danger fw-normal" style=" display: none;">Teléfono no válido.</span>
                            </div>
                            <div class="form-group col-md-3 col-sm-8 mb-2">
                                <label for="Tipo_profesional" class="form-label">Tipo de Profesional:</label>
                                <select class="form-control" name="Tipo_profesional" required>
                                    <option value="" disabled selected>Seleccione una opción</option>
                                    <option value="Doctora">Doctora</option>
                                    <option value="Nutrióloga">Nutrióloga</option>
                                </select>
                                <span class="text-danger fw-normal" style=" display: none;">Profesional no válido.</span>
                            </div>

                            <div class="form-group col-md-3 col-sm-8 mb-2">
                                <label for="Hora" class="form-label">Hora:</label>
                                <select class="form-control hora-select" name="Hora" required></select>
                                <span class="text-danger fw-normal" style="display: none;">Hora no válida.</span>
                            </div>


                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="Motivo" class="form-label">Motivo:</label>
                        <input type="text" class="form-control" name="Motivo" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Agregar Cita</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@vite(['resources/js/citas.js'])
@endsection