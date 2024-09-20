<div class="tab-content row mx-3 mt-4 mt-lg-0" id="tab-content-app">

        {{-- Enfermedades --}}
        <x-item-content-tab-pane id="diseases-tab-pane" :active=true>
            
            <div class="form-group " id="enfermedad-container">
                <label for="enfermedad" class="pb-1">Enfermedades</label>
                <select class="form-control" name="enfermedadPersonal" id="enfermedadPersonal">
                    <option value="0" selected>Seleccione una
                        opción</option>
                    @if ($enfermedades->isEmpty())
                        <option value="0" disabled selected>No hay
                            enfermedades registradas</option>
                    @else
                        @foreach ($enfermedades as $enfermedad)
                            <option value="{{ $enfermedad->id_especifica_ahf }}">
                                {{ $enfermedad->nombre }}</option>
                        @endforeach
                    @endif
                </select>
                <span class="text-danger fw-normal d-none"></span>
            </div>
        </x-item-content-tab-pane>


        {{-- Alergias --}}
        <x-item-content-tab-pane id="alergias-tab-pane" :active=false>
            <div class="form-group mt-2" id="enfermedad-container">
                <label for="enfermedad" class="pb-1">Alergias</label>
                <select class="form-control" name="alergias" id="alergias">
                    <option value="0" selected>Seleccione una
                        opción</option>
                    @if ($alergias->isEmpty())
                        <option value="0" disabled selected>No hay
                            alergias registradas</option>
                    @else
                        @foreach ($alergias as $alergia)
                            <option value="{{ $alergia->id_alergia }}">
                                {{ $alergia->nombre }}</option>
                        @endforeach
                    @endif
                </select>
                <span class="text-danger fw-normal d-none"></span>
            </div>

            <div class="form-floating mt-3">
                <textarea class="form-control h-custom-detail-textarea" placeholder="Describe las alergias" id="descripcionAlergias"></textarea>
                <label for="descripcionAlergias" class="text-dark">Descripción</label>
            </div>
            <span class="text-danger fw-normal d-none"></span>
        </x-item-content-tab-pane>


        {{-- Hospitalizaciones --}}
        <x-item-content-tab-pane id="hospitalizaciones-tab-pane" :active=false>
            <div class="form-group mb-2">
                <label for="fecha_H">Fecha:</label>
                <input class="form-control" type="date" name="fecha_H" id="fecha_H">
                <span class="text-danger fw-normal d-none"></span>

            </div>

            <div class="form-floating mt-3">
                <textarea class="form-control h-custom-detail-textarea" name="motivo_H" id="motivo_H"></textarea>
                <label for="motivo_H" class="text-dark">Motivo</label>
            </div>
            <span class="text-danger fw-normal d-none"></span>
        </x-item-content-tab-pane>

        {{-- Cirugías --}}
        <x-item-content-tab-pane id="cirugias-tab-pane" :active=false>
            <div class="form-group  mb-2">
                <label for="fecha_C">Fecha:</label>
                <input class="form-control" type="date" name="fecha_C" id="fecha_C">
                <span class="text-danger fw-normal d-none"></span>

            </div>

            <div class="form-floating mt-3">
                <textarea class="form-control h-custom-detail-textarea" name="motivo_C" id="motivo_C"></textarea>
                <label for="motivo_C" class="text-dark">Motivo</label>
            </div>
            <span class="text-danger fw-normal d-none"></span>

        </x-item-content-tab-pane>

        {{-- Transfusiones --}}
        <x-item-content-tab-pane id="transfusiones-tab-pane" :active=false>
            <div class="form-group mb-2">
                <label for="fecha_TF">Fecha:</label>
                <input class="form-control" type="date" name="fecha_TF" id="fecha_TF">
                <span class="text-danger fw-normal d-none"></span>

            </div>
            <div class="form-floating mt-3">
                <textarea class="form-control h-custom-detail-textarea" name="motivo_TF" id="motivo_TF"></textarea>
                <label for="motivo_TF" class="text-dark">Motivo</label>
            </div>
            <span class="text-danger fw-normal d-none"></span>
        </x-item-content-tab-pane>

        {{-- Traumatismo --}}
        <x-item-content-tab-pane id="traumatismos-tab-pane" :active=false>
            <div class="form-group mb-2">
                <label for="fecha_TU">Fecha:</label>
                <input class="form-control" type="date" name="fecha_TU" id="fecha_TU">
                <span class="text-danger fw-normal d-none"></span>

            </div>

            <div class="form-floating mt-3">
                <textarea class="form-control h-custom-detail-textarea" name="motivo_TU" id="motivo_TU"></textarea>
                <label for="motivo_TU" class="text-dark">Motivo</label>
            </div>
            <span class="text-danger fw-normal d-none"></span>
        </x-item-content-tab-pane>


</div>
