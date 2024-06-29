@extends('admin.layouts.main')

@section('title', 'Citas del Día')

@section('content')
<h1>Citas para el {{ $fecha }}</h1>

<!-- Botón para abrir el modal de agregar cita -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCitaModal">
    Agregar Cita
</button>

@if ($citas->isEmpty())
<p>No hay citas para este día.</p>
@else
<table class="table">
    <thead>
        <tr>
            <th scope="col">Hora</th>
            <th scope="col">Nombre</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Correo</th>
            <th scope="col">Motivo</th>
            <th scope="col">Consulta</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($citas as $cita)
        <tr>
            <td>{{ $cita->hora }}</td>
            <td>{{ $cita->nombre }}</td>
            <td>{{ $cita->telefono }}</td>
            <td>{{ $cita->email }}</td>
            <td>{{ $cita->motivo }}</td>
            <td>{{ $cita->tipo_profesional }}</td>
            <td>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modificarCitaModal{{ $cita->id }}">
                    Modificar
                </button>
                <button class="cancelarCitaButton btn btn-danger btn-sm" data-cita-id="{{ $cita->id }}">Cancelar</button>
            </td>
        </tr>

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
                                    <div class="form-group col-md-6 col-sm-8 mb-2">
                                        <label for="fecha_edit_{{ $cita->id }}" class="form-label">Fecha</label>
                                        <input type="date" class="form-control" id="fecha_edit_{{ $cita->id }}" name="fecha_edit_{{ $cita->id }}" value="{{ $cita->fecha }}" required>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-8 mb-2">
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

        @endforeach
    </tbody>
</table>
@endif



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
                                <input type="time" class="form-control" name="Hora" required>
                                <span class="text-danger fw-normal" style=" display: none;">Hora no válida.</span>
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