@extends('admin.layouts.main')

@section('title', 'Citas del Día')

@section('content')
<h1>Citas para el {{ $fecha }}</h1>

<!-- Botón para abrir el modal -->
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
        </tr>
    </thead>
    <tbody>
        @foreach ($citas as $cita)
        <tr>
            <td>{{ $cita->hora }}</td>
            <td>{{ $cita->pacientes->nombre }}</td>
            <td>{{ $cita->pacientes->telefono }}</td>
            <td>{{ $cita->pacientes->email }}</td>
            <td>{{ $cita->motivo }}</td>
            <td>{{ $cita->tipo_profesional }}</td>
        </tr>
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
                <form action="{{ route('guardarCita') }}" method="POST">
                    @csrf
                    <input type="hidden" name="fecha" value="{{ $fecha }}">
                    <div class="form-group">
                        <div class="row pt-2">
                            <div class="form-group col-md-6 col-sm-12 mb-2">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" oninput="this.value = this.value.toUpperCase()" required>
                                <span class="text-danger fw-normal" style=" display: none;">Nombre no válido.</span>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 mb-2">
                                <label for="email" class="form-label">Correo Electrónico:</label>
                                <input type="email" class="form-control" name="email">
                                <span class="text-danger fw-normal" style=" display: none;">Correo no válido.</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row pt-2">
                            <div class="form-group col-md-6 col-sm-8 mb-2">
                                <label for="telefono" class="form-label">Teléfono:</label>
                                <input type="text" class="form-control" name="telefono"pattern="[0-9]{10}" maxlength="10" required>
                                <span class="text-danger fw-normal" style=" display: none;">Teléfono no válido.</span>
                            </div>
                            <div class="form-group col-md-3 col-sm-8 mb-2">
                                <label for="tipo_profesional" class="form-label">Tipo de Profesional:</label>
                                <select class="form-control" name="tipo_profesional" required>
                                    <option value="" disabled selected>Seleccione una opción</option>
                                    <option value="Doctora">Doctora</option>
                                    <option value="Nutrióloga">Nutrióloga</option>
                                </select>
                                <span class="text-danger fw-normal" style=" display: none;">Profesional no válido.</span>
                            </div>

                            <div class="form-group col-md-3 col-sm-8 mb-2">
                                <label for="hora" class="form-label">Hora:</label>
                                <input type="time" class="form-control" name="hora" required>
                                <span class="text-danger fw-normal" style=" display: none;">Hora no válida.</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="motivo" class="form-label">Motivo:</label>
                        <input type="text" class="form-control" name="motivo" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Agregar Cita</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection