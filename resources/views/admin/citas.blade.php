@extends('admin.layouts.main')

@section('title', 'Citas del Día')

@section('viteConfig')
    @vite(['resources/sass/citas.scss', 'resources/sass/main.scss'])
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}">
@endsection

@section('content')
    <!-- Boton para ingresar una nueva cita -->
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 col-lg-6">
                <h5 class="mb-0 fw-bold text-muted">Citas:</h5>
                <p class="mb-0">{{ $fechaFormateada }}</p>
            </div>
            <div class="col-12 col-lg-6 d-flex justify-content-end">

                <x-button-custom class="btn-blue" data-bs-toggle="modal" data-bs-target="#addCitaModal" text="Agendar cita"
                    tooltipText="Agendar una nueva cita">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 32 32">
                            <path fill="currentColor" d="M17 15V8h-2v7H8v2h7v7h2v-7h7v-2z" />
                        </svg>
                    </x-slot>
                </x-button-custom>

            </div>
        </div>


        @if ($citasDoctora->isEmpty() && $citasNutriologa->isEmpty())
            <div class="row-mb-4 card shadow-custom p-3 animate__animated animate__fadeInUp">
                <div class="col-12">
                    <p class="mb-0 fw-bold text-muted">No hay citas para este día.</p>
                </div>
            </div>
        @else
            <div class="row mb-4 card shadow-custom ">
                <div class="col-12 d-flex justify-content-between py-3 px-3 align-items-center">
                    <div>
                        <h5 class="fw-bold text-muted mb-0">Citas para la <span id="citasPara"> - <span></h5>
                    </div>
                    <div class="form-group">
                        <select class="form-select" id="selectFilterTable">
                            <option value="medico">Consultas para el Médico</option>
                            <option value="nuticion">Consultas para la Nutriologa</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row card shadow-custom p-3 ">
                <div id="tablaDoctora" class="animate__animated animate__fadeInUp">
                    @if ($citasDoctora->isEmpty())

                        <div class="col-12">
                            <p class="mb-0 fw-bold text-muted">No hay citas para la Doctora o el Doctor.</p>
                        </div>
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
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modificarCitaModal{{ $cita->id }}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <button class="cancelarCitaButton btn btn-danger btn-sm"
                                                    data-cita-id="{{ $cita->id }}"><i
                                                        class="fa-solid fa-ban"></i></button>
                                            @else
                                                <!-- Botón para eliminar -->
                                                <button class="eliminarCitaButton btn btn-danger btn-sm"
                                                    data-cita-id="{{ $cita->id }}"><i
                                                        class="fa-solid fa-trash"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>

                <div id="tablaNutriologa" class="animate__animated animate__fadeInUp" style="display: none;">
                    @if ($citasNutriologa->isEmpty())
                        <div class="col-12">
                            <p class="mb-0 fw-bold text-muted">No hay citas para la Nutrióloga o el Nutriólogo.</p>
                        </div>
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
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modificarCitaModal{{ $cita->id }}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <button class="cancelarCitaButton btn btn-danger btn-sm"
                                                    data-cita-id="{{ $cita->id }}"><i
                                                        class="fa-solid fa-ban"></i></button>
                                            @else
                                                <!-- Botón para eliminar -->
                                                <button class="eliminarCitaButton btn btn-danger btn-sm"
                                                    data-cita-id="{{ $cita->id }}"><i
                                                        class="fa-solid fa-trash"></i></button>
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
            <div class="modal fade" id="modificarCitaModal{{ $cita->id }}" tabindex="-1"
                aria-labelledby="modificarCitaModalLabel{{ $cita->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modificarCitaModalLabel{{ $cita->id }}">Modificar Cita</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form class="modificarCitaForm" data-cita-id="{{ $cita->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="nombre_edit_{{ $cita->id }}"
                                                class="form-label">Nombre</label>
                                            <input type="text" class="form-control"
                                                id="nombre_edit_{{ $cita->id }}"
                                                name="nombre_edit_{{ $cita->id }}" value="{{ $cita->nombre }}"
                                                required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12 mb-2">
                                            <label for="email_edit_{{ $cita->id }}" class="form-label">Correo</label>
                                            <input type="email" class="form-control"
                                                id="email_edit_{{ $cita->id }}"
                                                name="email_edit_{{ $cita->id }}" value="{{ $cita->email }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-md-4 col-sm-8 mb-2">
                                            <label for="telefono_edit_{{ $cita->id }}"
                                                class="form-label">Teléfono</label>
                                            <input type="text" class="form-control"
                                                id="telefono_edit_{{ $cita->id }}"
                                                name="telefono_edit_{{ $cita->id }}" value="{{ $cita->telefono }}"
                                                required>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-8 mb-2">
                                            <label for="tipo_edit_{{ $cita->id }}" class="form-label">Tipo de
                                                Profesional</label>
                                            <select class="form-select" id="tipo_edit_{{ $cita->id }}"
                                                name="tipo_edit_{{ $cita->id }}" required>
                                                <option value="Doctora"
                                                    {{ $cita->tipo_profesional == 'Doctora' ? 'selected' : '' }}>Doctora
                                                </option>
                                                <option value="Nutrióloga"
                                                    {{ $cita->tipo_profesional == 'Nutrióloga' ? 'selected' : '' }}>
                                                    Nutrióloga
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-8 mb-2">

                                            <label for="hora_edit_{{ $cita->id }}" class="form-label">Hora</label>
                                            <select class="form-control" id="hora_edit_{{ $cita->id }}"
                                                name="hora_edit_{{ $cita->id }}" required>
                                                @for ($hour = 8; $hour <= 18; $hour++)
                                                @foreach (['00', '30'] as $minute)
                                                    <option value="{{ sprintf('%02d:%02d', $hour, $minute) }}">
                                                        {{ sprintf('%02d:%02d', $hour, $minute) }}</option>
                                                @endforeach
                                            @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row pt-2">
                                        <div class="form-group col-md-4 col-sm-8 mb-2">
                                            <label for="fecha_edit_{{ $cita->id }}" class="form-label">Fecha</label>
                                            <input type="date" class="form-control"
                                                id="fecha_edit_{{ $cita->id }}"
                                                name="fecha_edit_{{ $cita->id }}" value="{{ $cita->fecha }}"
                                                required>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-8 mb-2">
                                            <label for="estado_edit_{{ $cita->id }}"
                                                class="form-label">Estado</label>
                                            <select class="form-select" id="estado_edit_{{ $cita->id }}"
                                                name="estado_edit_{{ $cita->id }}" required>
                                                <option value="Pendiente"
                                                    {{ $cita->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                <option value="Asistida"
                                                    {{ $cita->estado == 'Asistida' ? 'selected' : '' }}>
                                                    Asistida</option>
                                                <option value="No asistida"
                                                    {{ $cita->estado == 'No asistida' ? 'selected' : '' }}>No asistida
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-8 mb-2">
                                            <label for="motivo_edit_{{ $cita->id }}"
                                                class="form-label">Motivo</label>
                                            <textarea class="form-control" id="motivo_edit_{{ $cita->id }}" name="motivo_edit_{{ $cita->id }}"
                                                rows="3" required>{{ $cita->motivo }}</textarea>
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
        <div class="modal fade" id="addCitaModal" tabindex="-1" aria-labelledby="addCitaModalLabel"
            aria-hidden="true">
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
                                        <label for="Nombre" class="form-label">Nombre:<span
                                                class="required-point">*</span></label>
                                        <input type="text" class="form-control" name="Nombre"
                                            oninput="this.value = this.value.toUpperCase()">
                                        <span class="text-danger fw-normal" style=" display: none;">El campo es requerido,
                                            por
                                            favor llénalo</span>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12 mb-2">
                                        <label for="Email" class="form-label">Correo Electrónico:<span
                                                class="required-point">*</span></label>
                                        <input type="email" class="form-control" name="Email">
                                        <span class="text-danger fw-normal" style=" display: none;">El campo es requerido,
                                            por
                                            favor llénalo</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row pt-2">
                                    <div class="form-group col-md-6 col-sm-8 mb-2">
                                        <label for="Telefono" class="form-label">Teléfono:<span
                                                class="required-point">*</span></label>
                                        <input type="text" class="form-control" name="Telefono" pattern="[0-9]{10}"
                                            maxlength="10">
                                        <span class="text-danger fw-normal" style=" display: none;">El campo es requerido,
                                            por
                                            favor llénalo</span>
                                    </div>
                                    <div class="form-group col-md-3 col-sm-8 mb-2">
                                        <label for="Tipo_profesional" class="form-label">Tipo de Profesional:<span
                                                class="required-point">*</span></label>
                                        <select class="form-control" name="Tipo_profesional">
                                            <option value="" disabled selected>Seleccione una opción</option>
                                            <option value="Doctora">Doctora</option>
                                            <option value="Nutrióloga">Nutrióloga</option>
                                        </select>
                                        <span class="text-danger fw-normal" style=" display: none;">El campo es requerido,
                                            por
                                            favor llénalo</span>
                                    </div>
                                    <div class="form-group col-md-3 col-sm-8 mb-2">
                                        <label for="Hora" class="form-label">Hora:<span
                                                class="required-point">*</span></label>
                                        <select class="form-control" name="Hora" required>
                                            @for ($hour = 8; $hour <= 18; $hour++)
                                                @foreach (['00', '30'] as $minute)
                                                    <option value="{{ sprintf('%02d:%02d', $hour, $minute) }}">
                                                        {{ sprintf('%02d:%02d', $hour, $minute) }}</option>
                                                @endforeach
                                            @endfor
                                        </select>
                                        <span class="text-danger fw-normal" style="display: none;">El campo es requerido,
                                            por
                                            favor llénalo</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="Motivo" class="form-label">Motivo:<span
                                        class="required-point">*</span></label>
                                <input type="text" class="form-control" name="Motivo">
                                <span class="text-danger fw-normal" style="display: none;">El campo es requerido, por
                                    favor
                                    llénalo</span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Agregar Cita</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/citas.js'])
@endsection
