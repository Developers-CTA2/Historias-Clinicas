{{-- Ginecologia y obstetricia --}}

<div class="row form-step d-none animate__animated animate__fadeInUp bg-content-custom shadow-custom p-3">
    <div class="col-12 mb-3">
        <h5 class="text-center">Ginecología y Obstetricia</h5>
        <div class="hr-custom"></div>
    </div>

    {{-- Fecha de la primera menstruacion --}}
    <x-form-group class="group-gyo">
        <x-slot name="label">
            <x-label-with-tooltip labelFor="menarca" titleLabel="Menarca (Edad)" :required=true
                message="Debes ingresar la edad de la primera menstruación de la mujer, ejemplo: 12" :haveTooltip=true />
        </x-slot>
        <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                <g fill="none">
                    <path fill="#c026d3"
                        d="M9.5 17.75a.75.75 0 0 0 0 1.5zm5 1.5a.75.75 0 0 0 0-1.5zM11.25 22a.75.75 0 1 0 1.5 0zm0-6v2.5h1.5V16zm.75 1.75H9.5v1.5H12zm2.5 0H12v1.5h2.5zm-3.25.75V22h1.5v-3.5z" />
                    <path stroke="#c026d3" stroke-linecap="round" stroke-width="1.5"
                        d="M8.5 2.936A7 7 0 1 1 5.936 5.5" />
                </g>
            </svg>
        </x-slot>
        <x-slot name="input">
            <input class="form-control" type="number" name="menarca" id="menarca" placeholder="12">
        </x-slot>
    </x-form-group>

    
    {{-- Año de inicio de vida sexual --}}
    <x-form-group class="group-gyo">
        <x-slot name="label">
            <x-label-with-tooltip labelFor="inicioVidaSexual" titleLabel="Inicio de vida sexual (Edad)"
                :required=true :haveTooltip=true
                message="Debes ingresar la edad de inicio de vida sexual de la mujer, ejemplo: 20" />
        </x-slot>
        <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256">
                <path fill="#c026d3"
                    d="M208 28h-40a4 4 0 0 0 0 8h30.34l-34.79 34.79A60 60 0 1 0 116 171.85V196H88a4 4 0 0 0 0 8h28v28a4 4 0 0 0 8 0v-28h28a4 4 0 0 0 0-8h-28v-24.15A59.94 59.94 0 0 0 168.68 77L204 41.66V72a4 4 0 0 0 8 0V32a4 4 0 0 0-4-4m-88 136a52 52 0 1 1 52-52a52.06 52.06 0 0 1-52 52" />
            </svg>
        </x-slot>
        <x-slot name="input">
            <input class="form-control" type="number" name="inicioVidaSexual" id="inicioVidaSexual" min="1"
                placeholder="20">
        </x-slot>
    </x-form-group>

    {{-- Fecha de ultima menstruacion --}}
    <x-form-group class="group-gyo">
        <x-slot name="label">
            <x-label-with-tooltip labelFor="fechaUltimaMenstruacion" titleLabel="Fecha de última menstruación"
                :required=true message="Debes ingresar la fecha de última menstruación de la mujer"
                :haveTooltip=true />
        </x-slot>
        <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                <path fill="#c026d3"
                    d="M5.616 21q-.691 0-1.153-.462T4 19.385V6.615q0-.69.463-1.152T5.616 5h1.769V2.77h1.077V5h7.154V2.77h1V5h1.769q.69 0 1.153.463T20 6.616v12.769q0 .69-.462 1.153T18.384 21zm0-1h12.769q.23 0 .423-.192t.192-.424v-8.768H5v8.769q0 .23.192.423t.423.192M5 9.615h14v-3q0-.23-.192-.423T18.384 6H5.616q-.231 0-.424.192T5 6.616zm0 0V6zm7 4.539q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23m-4 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23m8 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23M12 18q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T12 18m-4 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T8 18m8 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T16 18" />
            </svg>
        </x-slot>
        <x-slot name="input">
            <input class="form-control" type="date" name="fechaUltimaMenstruacion" id="fechaUltimaMenstruacion">
        </x-slot>
    </x-form-group>

    {{-- Numero de partos --}}
    <x-form-group class="group-gyo">
        <x-slot name="label">
            <x-label-with-tooltip labelFor="numPartos" titleLabel="Partos" :required=false />
        </x-slot>
        <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256">
                <path fill="#c026d3"
                    d="M208 28h-40a4 4 0 0 0 0 8h30.34l-34.79 34.79A60 60 0 1 0 116 171.85V196H88a4 4 0 0 0 0 8h28v28a4 4 0 0 0 8 0v-28h28a4 4 0 0 0 0-8h-28v-24.15A59.94 59.94 0 0 0 168.68 77L204 41.66V72a4 4 0 0 0 8 0V32a4 4 0 0 0-4-4m-88 136a52 52 0 1 1 52-52a52.06 52.06 0 0 1-52 52" />
            </svg>
        </x-slot>
        <x-slot name="input">
            <input class="form-control" type="number" name="numPartos" id="numPartos" min="1"
                placeholder="0">
        </x-slot>
    </x-form-group>

    {{-- Si es ciclo regular e irregular --}}
    <section class="form-group col-12 col-lg-6">
        <x-label-with-tooltip labelFor="ciclos" titleLabel="Ciclos" :required=true />
        <div
            class="funkyradio d-flex flex-column flex-md-row justify-content-center justify-content-lg-between gap-3 group-gyo">
            <div class="funkyradio-primary">
                <input type="radio" name="radio" id="cicloRegular" checked />
                <label class="me-3" for="cicloRegular">Regular</label>
            </div>
            <div class="funkyradio-primary">
                <input type="radio" name="radio" id="cicloIrregular" />
                <label class="me-3" for="cicloIrregular">Irregular</label>
            </div>
            <span class="text-danger fw-normal d-none"></span>
        </div>
    </section>

    {{-- Numero de abortos --}}
    <x-form-group class="group-gyo">
        <x-slot name="label">
            <x-label-with-tooltip labelFor="numAbortos" titleLabel="Abortos" :required=false />
        </x-slot>
        <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256">
                <path fill="#c026d3"
                    d="M208 28h-40a4 4 0 0 0 0 8h30.34l-34.79 34.79A60 60 0 1 0 116 171.85V196H88a4 4 0 0 0 0 8h28v28a4 4 0 0 0 8 0v-28h28a4 4 0 0 0 0-8h-28v-24.15A59.94 59.94 0 0 0 168.68 77L204 41.66V72a4 4 0 0 0 8 0V32a4 4 0 0 0-4-4m-88 136a52 52 0 1 1 52-52a52.06 52.06 0 0 1-52 52" />
            </svg>
        </x-slot>
        <x-slot name="input">
            <input class="form-control" type="number" name="numAbortos" id="numAbortos" min="1"
                placeholder="0">
        </x-slot>
    </x-form-group>


    <section class="col-12 col-lg-6">
        <div class="row">

            {{-- Dias de sangrado --}}
            <x-form-group class="group-gyo">
                <x-slot name="label">
                    <x-label-with-tooltip labelFor="diasSangrado" titleLabel="Dias de sangrado" :required=true />
                </x-slot>
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 48 48">
                        <path fill="none" stroke="#c026d3" stroke-linecap="round" stroke-linejoin="round"
                            d="M38.5 5.5h-29a4 4 0 0 0-4 4v29a4 4 0 0 0 4 4h29a4 4 0 0 0 4-4v-29a4 4 0 0 0-4-4" />
                        <path fill="none" stroke="#c026d3" stroke-linecap="round" stroke-linejoin="round"
                            d="m16.283 29.765l7.222-3.227c.315-.14.675-.14.99 0l7.222 3.227c.395.163.825-.136.825-.574V5.5H15.458v23.69c0 .439.43.738.825.575" />
                    </svg>
                </x-slot>
                <x-slot name="input">
                    <input class="form-control" type="number" name="diasSangrado" id="diasSangrado" placeholder="10">
                </x-slot>
            </x-form-group>


            {{-- Dias de ciclo --}}
            <x-form-group class="group-gyo">
                <x-slot name="label">
                    <x-label-with-tooltip labelFor="diasCiclo" titleLabel="Dias de ciclos" :required=true />
                </x-slot>
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 48 48">
                        <path fill="none" stroke="#c026d3" stroke-linecap="round" stroke-linejoin="round"
                            d="M38.5 5.5h-29a4 4 0 0 0-4 4v29a4 4 0 0 0 4 4h29a4 4 0 0 0 4-4v-29a4 4 0 0 0-4-4" />
                        <path fill="none" stroke="#c026d3" stroke-linecap="round" stroke-linejoin="round"
                            d="m16.283 29.765l7.222-3.227c.315-.14.675-.14.99 0l7.222 3.227c.395.163.825-.136.825-.574V5.5H15.458v23.69c0 .439.43.738.825.575" />
                    </svg>
                </x-slot>
                <x-slot name="input">
                    <input class="form-control" type="number" name="diasCiclo" id="diasCiclo" placeholder="4">
                </x-slot>
            </x-form-group>
        </div>

    </section>

    {{-- Numero de cesareas --}}
    <x-form-group class="group-gyo">
        <x-slot name="label">
            <x-label-with-tooltip labelFor="numCesareas" titleLabel="Cesareas" :required=false />
        </x-slot>
        <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256">
                <path fill="#c026d3"
                    d="M208 28h-40a4 4 0 0 0 0 8h30.34l-34.79 34.79A60 60 0 1 0 116 171.85V196H88a4 4 0 0 0 0 8h28v28a4 4 0 0 0 8 0v-28h28a4 4 0 0 0 0-8h-28v-24.15A59.94 59.94 0 0 0 168.68 77L204 41.66V72a4 4 0 0 0 8 0V32a4 4 0 0 0-4-4m-88 136a52 52 0 1 1 52-52a52.06 52.06 0 0 1-52 52" />
            </svg>
        </x-slot>
        <x-slot name="input">
            <input class="form-control" type="number" name="numCesareas" id="numCesareas" min="1"
                placeholder="0" />
        </x-slot>
    </x-form-group>

    {{-- Fecha de ultima citologia --}}
    <x-form-group class="group-gyo">
        <x-slot name="label">
            <x-label-with-tooltip labelFor="citologia" titleLabel="Fecha de citología (año)" :required=true
                message="Debes ingresar el año de la última citología de la mujer, ejemplo: 2023" :haveTooltip=true />
        </x-slot>
        <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                <path fill="#c026d3"
                    d="M5.616 21q-.691 0-1.153-.462T4 19.385V6.615q0-.69.463-1.152T5.616 5h1.769V2.77h1.077V5h7.154V2.77h1V5h1.769q.69 0 1.153.463T20 6.616v12.769q0 .69-.462 1.153T18.384 21zm0-1h12.769q.23 0 .423-.192t.192-.424v-8.768H5v8.769q0 .23.192.423t.423.192M5 9.615h14v-3q0-.23-.192-.423T18.384 6H5.616q-.231 0-.424.192T5 6.616zm0 0V6zm7 4.539q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23m-4 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23m8 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23M12 18q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T12 18m-4 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T8 18m8 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T16 18" />
            </svg>
        </x-slot>
        <x-slot name="input">
            <input class="form-control" type="number" name="fechaCitologia" max="4" id="fechaCitologia"
                placeholder="2024">
        </x-slot>
    </x-form-group>

    {{-- Numero de gestas --}}
    <x-form-group class="group-gyo">
        <x-slot name="label">
            <x-label-with-tooltip labelFor="numGestas" titleLabel="Gestas" :required=false />
        </x-slot>
        <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256">
                <path fill="#c026d3"
                    d="M208 28h-40a4 4 0 0 0 0 8h30.34l-34.79 34.79A60 60 0 1 0 116 171.85V196H88a4 4 0 0 0 0 8h28v28a4 4 0 0 0 8 0v-28h28a4 4 0 0 0 0-8h-28v-24.15A59.94 59.94 0 0 0 168.68 77L204 41.66V72a4 4 0 0 0 8 0V32a4 4 0 0 0-4-4m-88 136a52 52 0 1 1 52-52a52.06 52.06 0 0 1-52 52" />
            </svg>
        </x-slot>
        <x-slot name="input">
            <input class="form-control" type="number" name="numGestas" id="numGestas" placeholder="0">
        </x-slot>
    </x-form-group>

    {{-- Año de ultima mastografia --}}
    <x-form-group class="group-gyo">
        <x-slot name="label">
            <x-label-with-tooltip labelFor="mastografia" titleLabel="Mastografía (año)" :required=true
                message="Debes ingresar el año de la última mastografía de la mujer, ejemplo: 2023"
                :haveTooltip=true />
        </x-slot>
        <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                <path fill="#c026d3"
                    d="M5.616 21q-.691 0-1.153-.462T4 19.385V6.615q0-.69.463-1.152T5.616 5h1.769V2.77h1.077V5h7.154V2.77h1V5h1.769q.69 0 1.153.463T20 6.616v12.769q0 .69-.462 1.153T18.384 21zm0-1h12.769q.23 0 .423-.192t.192-.424v-8.768H5v8.769q0 .23.192.423t.423.192M5 9.615h14v-3q0-.23-.192-.423T18.384 6H5.616q-.231 0-.424.192T5 6.616zm0 0V6zm7 4.539q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23m-4 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23m8 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23M12 18q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T12 18m-4 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T8 18m8 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.54T16 18" />
            </svg>
        </x-slot>
        <x-slot name="input">
            <input class="form-control" type="number" name="mastografia" max="4" placeholder="2024"
                id="mastografia">
        </x-slot>
    </x-form-group>


    {{-- Tiene embarazo --}}
    <div class="form-check col-12 col-lg-4 d-flex mx-3 align-items-center mb-3">
        <input class="form-check-input w-custom-checkbox" type="checkbox" id="tieneEmbarazo">
        <label class="form-check-label ps-2" for="tieneEmbarazo">
            Está embarazada
        </label>
    </div>

    {{-- Metodo anticonceptivo --}}
    <div class="form-floating mt-3">
        <textarea class="form-control h-custom-metodo" id="metodoDescripcion"></textarea>
        <label for="metodoDescripcion" class="mx-2">Método <span class="required-point">*</span></label>
        <span class="text-danger fw-normal d-none"></span>
    </div>



    

</div>
