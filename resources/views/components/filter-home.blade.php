<div class="row my-2">

    <div class="col-12 col-lg-4 d-flex align-items-end">
        <h4 class="text-muted fw-bold mb-0">Filtros</h4>
    </div>

    <div  @class(['col-12', $class])>

        <div class="row">
            <div class="col-12 col-xl-6">
                <div class="form-group">
                    <label for="{{$idMonth}}">Meses</label>
                    <select class="form-select" aria-label="Filters" id="{{$idMonth}}">
                        <option selected>Selecciona una opción</option>
                        @foreach ($months as $month)
                            {{-- {{ $month['id']}} --}}
                            <option value="{{ $month['id'] }}">{{ $month['month'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="form-group">
                    <label for="{{$idYear}}">Año</label>
                    <select class="form-select" aria-label="Filters" id="{{$idYear}}">
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

    </div>
</div>