@props(['hemotipos' => [], 'escolaridades' => [], 'estados' => []])

<div class="row d-none form-step animate__animated animate__fadeInUp">
    <div class="col-12">

        <div class="nav nav-pills mb-3" role="tablist" aria-orientation="vertical">
            <x-item-tab id="datapersonal-tab-pane" name="Datos personales" :active=true>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20">
                    <g fill="none" stroke="#0284c7" stroke-linecap="round">
                        <circle cx="9.5" cy="5.5" r="3" />
                        <path d="M15 16.5v-2c0-3.098-2.495-6-5.5-6c-3.006 0-5.5 2.902-5.5 6v2" />
                    </g>
                </svg>
            </x-item-tab>

            <x-item-tab id="domicile-tab-pane" name="Domicilio" :active=false>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 48 48">
                    <defs>
                        <mask id="IconifyId1914d5a44dfc7fc610">
                            <g fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="4">
                                <path d="M8 36v8h32V4H8v8M6 30h4m-4-6h4m-4-6h4" />
                                <circle cx="24" cy="17" r="4" fill="#555" />
                                <path d="M32 35a8 8 0 1 0-16 0" />
                            </g>
                        </mask>
                    </defs>
                    <path fill="#0284c7" d="M0 0h48v48H0z" mask="url(#IconifyId1914d5a44dfc7fc610)" />
                </svg>
            </x-item-tab>

            <x-item-tab id="emergency-contact-tab-pane" name="Contacto de emergencia" :active=false>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"
                    class="me-1">
                    <path fill="#0284c7"
                        d="M12 21.325q1.875-1.775 2.938-3.412T16 15.15q0-1.725-1.162-2.937T12 11t-2.838 1.213T8 15.15q0 1.125 1.063 2.763T12 21.325m0 1.348q-2.486-2.229-3.743-4.111T7 15.15q0-2.127 1.449-3.638T12 10t3.551 1.512T17 15.15q0 1.644-1.305 3.47T12 22.672m0-6.557q.471 0 .793-.323q.323-.322.323-.793t-.323-.793q-.322-.323-.793-.323t-.793.323q-.323.322-.323.793t.323.793q.322.323.793.323M8.47 7.142l-.69-.688q.886-.75 1.968-1.16q1.083-.41 2.252-.41t2.252.41t1.967 1.16l-.688.688q-.744-.628-1.657-.943T12 5.885t-1.874.314t-1.657.943M5.65 4.317l-.694-.707q1.46-1.325 3.277-2.025T12 .885q1.97 0 3.787.7t3.277 2.044l-.708.713q-1.314-1.198-2.945-1.827q-1.63-.63-3.411-.63q-1.761 0-3.399.617T5.65 4.317M12 15" />
                </svg>
            </x-item-tab>
        </div>

        {{-- x-item-tab-with --}}
        <div class="tab-content row bg-content-custom shadow-custom p-3 ">
            {{-- <div class="col-12">
                <p>Todos los campos con un asterisco de color rojo son <b>obligatorios.</b></p>
            </div> --}}

            <section id="datapersonal-tab-pane" class="tab-pane fade show active">
                <div class="row">

                    {{-- Código --}}
                    <x-form-group>
                        <x-slot name="label">
                            <label for="codigo"><span class="required-point me-1">*</span>Código:</label>
                        </x-slot>
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                <path fill="#999999"
                                    d="M14 7V5h8v2zm0 4V9h8v2zm0 4v-2h8v2zm-6-1q-1.25 0-2.125-.875T5 11t.875-2.125T8 8t2.125.875T11 11t-.875 2.125T8 14m-6 6v-1.9q0-.525.25-1t.7-.75q1.125-.675 2.388-1.012T8 15t2.663.338t2.387 1.012q.45.275.7.75t.25 1V20z" />
                            </svg>
                        </x-slot>
                        <x-slot name="input">
                            <input class="form-control" type="text" id="codigo" name="codigo" maxlength="9">
                        </x-slot>
                    </x-form-group>

                    {{-- Escolaridad --}}
                    <x-form-group>
                        <x-slot name="label">
                            <label for="escolaridad"><span class="required-point me-1">*</span>Escolaridad:</label>
                        </x-slot>
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 512 512">
                                <path fill="#999999"
                                    d="m368 350.643l-112 63l-112-63v-66.562l-32-17.778v103.054l144 81l144-81V266.303l-32 17.778z" />
                                <path fill="#999999"
                                    d="M256 45.977L32 162.125v27.734L256 314.3l192-106.663V296h32V162.125Zm160 142.831l-32 17.777L256 277.7l-128-71.115l-32-17.777l-22.179-12.322L256 82.023l182.179 94.463Z" />
                            </svg>
                        </x-slot>
                        <x-slot name="input">
                            <select class="form-control" name="escolaridad" id="escolaridad">
                                <option value="" disabled selected>Seleccione una opción</option>
                                @foreach ($escolaridades as $escolaridad)
                                    <option value="{{ $escolaridad->id_escolaridad }}">{{ $escolaridad->nombre }}</option>
                                @endforeach
                            </select>
                        </x-slot>

                    </x-form-group>


                    {{-- Nombre --}}
                    <x-form-group>
                        <x-slot name="label">
                            <label for="name_P"><span class="required-point me-1">*</span> Nombre Completo:</label>
                        </x-slot>
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                <path fill="#999999"
                                    d="M12 12q-1.65 0-2.825-1.175T8 8t1.175-2.825T12 4t2.825 1.175T16 8t-1.175 2.825T12 12m-8 6v-.8q0-.85.438-1.562T5.6 14.55q1.55-.775 3.15-1.162T12 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T20 17.2v.8q0 .825-.587 1.413T18 20H6q-.825 0-1.412-.587T4 18m2 0h12v-.8q0-.275-.137-.5t-.363-.35q-1.35-.675-2.725-1.012T12 15t-2.775.338T6.5 16.35q-.225.125-.363.35T6 17.2zm6-8q.825 0 1.413-.587T14 8t-.587-1.412T12 6t-1.412.588T10 8t.588 1.413T12 10m0 8" />
                            </svg>
                        </x-slot>
                        <x-slot name="input">
                            <input class="form-control" type="text" name="name_P" id="name_P"
                                oninput="this.value = this.value.toUpperCase()" />
                        </x-slot>
                    </x-form-group>


                    {{-- Carrera/Puesto --}}
                    <x-form-group>
                        <x-slot name="label">
                            <label for="Puesto"><span class="required-point me-1">*</span> Carrera/Puesto: </label>
                        </x-slot>
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                <path fill="#999999"
                                    d="M12 12q-1.65 0-2.825-1.175T8 8t1.175-2.825T12 4t2.825 1.175T16 8t-1.175 2.825T12 12m-8 6v-.8q0-.85.438-1.562T5.6 14.55q1.55-.775 3.15-1.162T12 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T20 17.2v.8q0 .825-.587 1.413T18 20H6q-.825 0-1.412-.587T4 18m2 0h12v-.8q0-.275-.137-.5t-.363-.35q-1.35-.675-2.725-1.012T12 15t-2.775.338T6.5 16.35q-.225.125-.363.35T6 17.2zm6-8q.825 0 1.413-.587T14 8t-.587-1.412T12 6t-1.412.588T10 8t.588 1.413T12 10m0 8" />
                            </svg>
                        </x-slot>
                        <x-slot name="input">
                            <input class="form-control" type="text" id="Puesto" name="puesto">
                        </x-slot>
                    </x-form-group>


                    {{-- Genero --}}
                    <x-form-group>
                        <x-slot name="label">
                            <label for="gender"><span class="required-point me-1">*</span>Género:</label>
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 256 256">
                                <path fill="#999999"
                                    d="M208 24h-40a8 8 0 0 0 0 16h20.69l-25.15 25.15A64 64 0 1 0 112 175.48V192H88a8 8 0 0 0 0 16h24v24a8 8 0 0 0 16 0v-24h24a8 8 0 0 0 0-16h-24v-16.52a63.92 63.92 0 0 0 45.84-98L200 51.31V72a8 8 0 0 0 16 0V32a8 8 0 0 0-8-8m-88 136a48 48 0 1 1 48-48a48.05 48.05 0 0 1-48 48" />
                            </svg>
                        </x-slot>

                        <x-slot name="input">
                            <select class="form-control" name="gender" id="gender">
                                <option value="" disabled selected>Seleccione una opción</option>
                                <option value="1">Masculino</option>
                                <option value="2">Femenino</option>
                            </select>
                        </x-slot>
                    </x-form-group>


                    {{-- Tipo de sangre --}}
                    <x-form-group>
                        <x-slot name="label">
                            <label for="E_civil"><span class="required-point me-1">*</span> Estado civil:</label>
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 24 24">
                                <path fill="#999999"
                                    d="M12 10L8 4.4L9.6 2h4.8L16 4.4zm3.5-3.2l-1.2 1.7c2.2.9 3.7 3 3.7 5.5a6 6 0 0 1-6 6a6 6 0 0 1-6-6c0-2.5 1.5-4.6 3.7-5.5L8.5 6.8C5.8 8.1 4 10.8 4 14a8 8 0 0 0 8 8a8 8 0 0 0 8-8c0-3.2-1.8-5.9-4.5-7.2" />
                            </svg>
                        </x-slot>

                        <x-slot name="input">
                            <select class="form-control" name="E_civil" id="E_civil">
                                <option value="" disabled selected>Seleccione una opción</option>
                                <option value="1">Soltero(a)</option>
                                <option value="2">Casado(a)</option>
                                <option value="3">Viudo(a)</option>
                                <option value="4">Divorciado(a)</option>
                                <option value="5">Separado(a)</option>
                            </select>
                        </x-slot>

                    </x-form-group>




                    {{-- Fecha de nacimiento --}}
                    <x-form-group>
                        <x-slot name="label">
                            <label for="F_nacimiento"><span class="required-point me-1">*</span> Fecha de nacimiento
                            </label>
                        </x-slot>
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 24 24">
                                <path fill="none" stroke="#999999" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M13.5 4.5a1.5 1.5 0 0 1-3 0C10.5 3.672 12 2 12 2s1.5 1.672 1.5 2.5M12 6v3m5.667 5c1.564 0 2.833-1.12 2.833-2.5S19.232 9 17.667 9H6.333C4.77 9 3.5 10.12 3.5 11.5S4.769 14 6.333 14c1.371 0 2.571-.859 2.834-2c.262 1.141 1.462 2 2.833 2c1.37 0 2.57-.859 2.833-2c.263 1.141 1.463 2 2.834 2M5 14l.52 2.58c.525 2.597.788 3.895 1.676 4.658c.889.762 2.14.762 4.643.762h.322c2.503 0 3.754 0 4.643-.762c.889-.763 1.15-2.061 1.675-4.658L19 14"
                                    color="#999999" />
                            </svg>
                        </x-slot>

                        <x-slot name="input">
                            <input type="date" id="F_nacimiento" name="F_nacimiento" class="form-control" />
                        </x-slot>

                    </x-form-group>


                    {{-- Telefonoo --}}
                    <x-form-group>
                        <x-slot name="label">
                            <label for="telefono"><span class="required-point me-1">*</span> Teléfono:</label>
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 256 256">
                                <path fill="#999999"
                                    d="m222.37 158.46l-47.11-21.11l-.13-.06a16 16 0 0 0-15.17 1.4a8 8 0 0 0-.75.56L134.87 160c-15.42-7.49-31.34-23.29-38.83-38.51l20.78-24.71c.2-.25.39-.5.57-.77a16 16 0 0 0 1.32-15.06v-.12L97.54 33.64a16 16 0 0 0-16.62-9.52A56.26 56.26 0 0 0 32 80c0 79.4 64.6 144 144 144a56.26 56.26 0 0 0 55.88-48.92a16 16 0 0 0-9.51-16.62M176 208A128.14 128.14 0 0 1 48 80a40.2 40.2 0 0 1 34.87-40a.6.6 0 0 0 0 .12l21 47l-20.67 24.74a6 6 0 0 0-.57.77a16 16 0 0 0-1 15.7c9.06 18.53 27.73 37.06 46.46 46.11a16 16 0 0 0 15.75-1.14a8 8 0 0 0 .74-.56L168.89 152l47 21.05h.11A40.21 40.21 0 0 1 176 208" />
                            </svg>
                        </x-slot>

                        <x-slot name="input">
                            <input type="text" id="telefono" name="telefono" class="form-control"
                                maxlength="10" />
                        </x-slot>

                    </x-form-group>


                    {{-- Tipo de sangre --}}
                    <x-form-group>
                        <x-slot name="label">
                            <label for="T_sangre"><span class="required-point me-1">*</span>Tipo de sangre </label>
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 24 24">
                                <g fill="none">
                                    <path stroke="#999999" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M14 7h6m-3-3v6" />
                                    <path fill="#999999"
                                        d="m8 5l.759-.651a1 1 0 0 0-1.518 0zm0 0l-.76-.651v.002l-.005.004a8.864 8.864 0 0 0-.228.277A30.613 30.613 0 0 0 4.64 8.048C3.367 10.19 2 13.133 2 16h2c0-2.31 1.133-4.866 2.36-6.93a28.613 28.613 0 0 1 2.203-3.181a14.844 14.844 0 0 1 .186-.226l.008-.01l.002-.002zm6 11c0-2.867-1.367-5.81-2.64-7.952a30.604 30.604 0 0 0-2.367-3.416a16.844 16.844 0 0 0-.228-.277l-.004-.004l-.002-.002L8 5l-.759.651l.002.002l.008.01a7.62 7.62 0 0 1 .186.226A28.613 28.613 0 0 1 9.64 9.07C10.866 11.134 12 13.69 12 16zm-2 0a4 4 0 0 1-4 4v2a6 6 0 0 0 6-6zm-4 4a4 4 0 0 1-4-4H2a6 6 0 0 0 6 6z" />
                                </g>
                            </svg>
                        </x-slot>

                        <x-slot name="input">
                            <select class="form-control" name="T_sangre" id="T_sangre">
                                <option value="" disabled selected>Seleccione una opción</option>
                                @foreach ($hemotipos as $hemotipo)
                                    <option value="{{ $hemotipo->id_hemotipo }}">{{ $hemotipo->nombre }}</option>
                                @endforeach
                            </select>
                        </x-slot>

                    </x-form-group>


                    {{-- Número de seguro social --}}

                    <x-form-group>
                        <x-slot name="label">
                            <x-label-with-tooltip labelFor="nss" titleLabel="NSS" :required="true"
                                message="El NSS debe ser 11 dígitos" :haveTooltip="true" />
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 48 48">
                                <path fill="none" stroke="#333333" stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.951 17.884c2.45-.749 7.004-2.796 12.813-8.199c8.383-7.794 12.667-3.55 12.735 3.9s-3.838 23.28-7.495 26.394s-7.018 2.427-7.018 2.427s5.999-3.421 2.745-11.51s-11.802-11.138-16.711-11.2s-7.452-.282-7.877.654c0 0-1.314-1.48-.183-2.196s2.544-1.24 3.117-1.994s3.534-1.443 7.042-1.309s4.406-.313 4.406-.313" />
                                <path fill="none" stroke="#333333" stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.698 12.646a53 53 0 0 1-3.462-2.96C9.853 1.89 5.569 6.135 5.5 13.584c-.006.66.019 1.383.072 2.159m.995 7.136c1.402 7.175 3.971 15.007 6.428 17.1c3.657 3.115 7.018 2.427 7.018 2.427m14.082-8.726a25.7 25.7 0 0 0-3.91-10.428c-3.13-4.594-3.855-5.515-2.963-7.255s4.696-4.355 4.696-4.355" />
                                <path fill="none" stroke="#333333" stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.783 30.25s-3.296.895-3.799-1.485s1.369-3.948 4.211-2.854s5.865 8.261 3.404 12.112s-8.832.285-8.832.285" />
                                <path fill="none" stroke="#333333" stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.528 36.734c.73-.632-.023-2.228-1.226-1.973c-.111-1-1.454-1.88-3.389-.847c-2.263 1.21-1.232 4.94 2.661 4.247M17.7 31.72a3.7 3.7 0 0 1 2.215-1.337" />
                            </svg>
                        </x-slot>

                        <x-slot name="input">
                            <input class="form-control" type="text" id="nss" maxlength="11"
                                name="nss">
                        </x-slot>

                    </x-form-group>



                    <x-form-group>
                        <x-slot name="label">
                            <label for="religion"><span class="required-point me-1">*</span> Religión:</label>
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 24 24">
                                <path fill="#333333"
                                    d="M2.5 20.5v-5.623q0-.296.164-.537t.44-.365l3.396-1.52v-2.69q0-.289.148-.521t.394-.37L11.5 6.635v-2.29H10q-.213 0-.356-.144T9.5 3.845t.144-.356t.356-.143h1.5v-1.5q0-.212.144-.356t.357-.144t.356.144t.143.356v1.5H14q.213 0 .356.144q.144.144.144.357t-.144.356t-.356.143h-1.5v2.288l4.458 2.239q.246.138.394.37t.148.52v2.693l3.396 1.519q.277.124.44.365t.164.537V20.5q0 .402-.299.701t-.701.299h-6.192q-.344 0-.576-.232t-.232-.576v-2.769q0-.617-.441-1.059q-.442-.441-1.059-.441t-1.059.442q-.441.44-.441 1.058v2.77q0 .342-.232.575t-.576.232H3.5q-.402 0-.701-.299T2.5 20.5m1 0h6v-2.588q0-1.05.729-1.781q.728-.731 1.769-.731t1.771.73q.731.732.731 1.782V20.5h6v-5.627l-4-1.793V9.742l-4.5-2.3l-4.5 2.3v3.338l-4 1.793zm8.505-7.384q.466 0 .788-.327q.323-.327.323-.793q0-.467-.327-.79q-.327-.321-.793-.321q-.467 0-.79.326q-.321.327-.321.793q0 .467.326.79q.327.322.793.322m-.004.846" />
                            </svg>
                        </x-slot>

                        <x-slot name="input">
                            <input class="form-control" type="text" id="religion" name="religion">
                        </x-slot>

                    </x-form-group>

                </div>
            </section>

            <section id="domicile-tab-pane" class="tab-pane fade">
                <div class="row">
                    {{-- Estado de la republica --}}
                    <x-form-group>
                        <x-slot name="label">
                            <x-label-with-tooltip labelFor="estado" titleLabel="Estado" :required="true" />
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 15 15">
                                <path
                                    d="M7.5 0L1 3.445V4h13v-.555L7.5 0zM2 5v5l-1 1.555V13h13v-1.445L13 10V5H2zm2 1h1v5.5H4V6zm3 0h1v5.5H7V6zm3 0h1v5.5h-1V6z"
                                    fill="#999999" />
                            </svg>
                        </x-slot>

                        <x-slot name="input">
                            <select class="form-control" id="estado" name="estado">
                                <option value="" disabled selected>Seleccione una opción</option>
                                @foreach ($estados as $estado)
                                    <option value="{{ $estado->id_estado }}">{{ $estado->nombre }}</option>
                                @endforeach
                            </select>
                        </x-slot>

                    </x-form-group>


                    {{-- Ciudad --}}
                    <x-form-group>
                        <x-slot name="label">
                            <x-label-with-tooltip labelFor="ciudad" titleLabel="Ciudad" :required="true" />
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 32 32">
                                <path fill="#999999"
                                    d="m10 3.883l-7 3.5V28h26V10H17V7.383zm0 2.234l5 2.5V26H5V8.617zM7 10v2h2v-2zm4 0v2h2v-2zm6 2h10v14H17zM7 14v2h2v-2zm4 0v2h2v-2zm8 0v2h2v-2zm4 0v2h2v-2zM7 18v2h2v-2zm4 0v2h2v-2zm8 0v2h2v-2zm4 0v2h2v-2zM7 22v2h2v-2zm4 0v2h2v-2zm8 0v2h2v-2zm4 0v2h2v-2z" />
                            </svg>
                        </x-slot>

                        <x-slot name="input">
                            <input class="form-control" type="text" id="ciudad" name="ciudad">
                        </x-slot>
                    </x-form-group>


                    {{-- Colonia --}}
                    <x-form-group>
                        <x-slot name="label">
                            <x-label-with-tooltip labelFor="colonia" titleLabel="Colonia" :required="true" />
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 48 48">
                                <path fill="#999999" fill-rule="evenodd"
                                    d="M16.445 6.168a1 1 0 0 1 1.11 0l6 4A1 1 0 0 1 24 11v8a1 1 0 0 1-1 1H11a1 1 0 0 1-1-1v-8a1 1 0 0 1 .445-.832zM16 18h2v-4h-2zm4 0v-5a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v5h-2v-6.465l5-3.333l5 3.333V18zm14.496-5.868a1 1 0 0 0-.992 0l-7 4A1 1 0 0 0 26 17v10a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V17a1 1 0 0 0-.504-.868zM37 26h3v-8.42l-6-3.428l-6 3.428V26h3v-6a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1zm-2 0v-5h-2v5zm-11.553 2.106l-8-4a1 1 0 0 0-.894 0l-8 4A1 1 0 0 0 6 29v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V29a1 1 0 0 0-.553-.894M16 34v6h-2v-6zm2-1v7h4V29.618l-7-3.5l-7 3.5V40h4v-7a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1"
                                    clip-rule="evenodd" />
                            </svg>
                        </x-slot>

                        <x-slot name="input">
                            <input class="form-control" maxlength="5" type="text" id="colonia"
                                name="colonia">
                        </x-slot>

                    </x-form-group>


                    {{-- Codigo postal --}}
                    <x-form-group>
                        <x-slot name="label">
                            <x-label-with-tooltip labelFor="cp" titleLabel="Código postal" :required="true" />
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 20 20">
                                <path fill="#999999"
                                    d="M17 4H3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2M8.6 9l-.4.3c-.4.4-.5 1.1-.2 1.6l-.8.8l-1.1-1.1l-1.3 1.3c-.2.2-1.6 1.3-1.8 1.1s.9-1.6 1.1-1.8l1.3-1.3l-1.1-1.1l.8-.8c.5.3 1.2.3 1.6-.2l.3-.3c.5-.5.5-1.2.2-1.7L8 5l3 2.9l-.8.8c-.5-.2-1.2-.2-1.6.3m5.4 1.5L12.5 12l1.5 1.5V15l-3-3l3-3zm1 4.5v-1.5l1.5-1.5l-1.5-1.5V9l3 3z" />
                            </svg>
                        </x-slot>

                        <x-slot name="input">
                            <input class="form-control" maxlength="5" type="number" id="cp" name="cp">
                        </x-slot>

                    </x-form-group>


                    <x-form-group>
                        <x-slot name="label">
                            <x-label-with-tooltip labelFor="calle" titleLabel="Calle" :required="true" />
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 14 14">
                                <path fill="none" stroke="#999999" stroke-linecap="round" stroke-linejoin="round"
                                    d="m.5 13.5l3-13M7 .5v2M7 6v2m0 3.5v2m6.5 0l-3-13" />
                            </svg>
                        </x-slot>

                        <x-slot name="input">
                            <input type="text" id="calle" name="calle" class="form-control" />
                        </x-slot>

                    </x-form-group>


                    {{-- Numero --}}
                    <x-form-group>
                        <x-slot name="label">
                            <x-label-with-tooltip labelFor="num" titleLabel="Numero" :required="true" />
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 24 24">
                                <path fill="#999999"
                                    d="M7.75 10.5a1.25 1.25 0 1 1 0 2.5a1.25 1.25 0 0 1 0-2.5m4.25 0a1.25 1.25 0 1 1 0 2.5a1.25 1.25 0 0 1 0-2.5m5.5 1.25a1.25 1.25 0 1 0-2.5 0a1.25 1.25 0 0 0 2.5 0m-8.5 4a1.25 1.25 0 1 0-2.5 0a1.25 1.25 0 0 0 2.5 0m4.25 0a1.25 1.25 0 1 0-2.5 0a1.25 1.25 0 0 0 2.5 0m3-1.25a1.25 1.25 0 1 1 0 2.5a1.25 1.25 0 0 1 0-2.5M10.537 2.534a2.25 2.25 0 0 1 2.903-.002L20.2 8.23c.507.427.8 1.057.8 1.72v9.299A1.75 1.75 0 0 1 19.25 21H4.75A1.75 1.75 0 0 1 3 19.25v-9.3c0-.662.292-1.29.797-1.718zm1.936 1.145a.75.75 0 0 0-.968 0l-6.74 5.698a.75.75 0 0 0-.265.573v9.3c0 .138.112.25.25.25h14.5a.25.25 0 0 0 .25-.25v-9.3a.75.75 0 0 0-.267-.573z" />
                            </svg>
                        </x-slot>

                        <x-slot name="input">
                            <input type="number" id="num" name="num" min="1"
                                class="form-control" />
                        </x-slot>

                    </x-form-group>


                    {{-- Numero interior --}}
                    <x-form-group>
                        <x-slot name="label">
                            <x-label-with-tooltip labelFor="num_int" titleLabel="Numero interior" :required="false" />
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 24 24">
                                <path fill="#999999"
                                    d="M7.75 10.5a1.25 1.25 0 1 1 0 2.5a1.25 1.25 0 0 1 0-2.5m4.25 0a1.25 1.25 0 1 1 0 2.5a1.25 1.25 0 0 1 0-2.5m5.5 1.25a1.25 1.25 0 1 0-2.5 0a1.25 1.25 0 0 0 2.5 0m-8.5 4a1.25 1.25 0 1 0-2.5 0a1.25 1.25 0 0 0 2.5 0m4.25 0a1.25 1.25 0 1 0-2.5 0a1.25 1.25 0 0 0 2.5 0m3-1.25a1.25 1.25 0 1 1 0 2.5a1.25 1.25 0 0 1 0-2.5M10.537 2.534a2.25 2.25 0 0 1 2.903-.002L20.2 8.23c.507.427.8 1.057.8 1.72v9.299A1.75 1.75 0 0 1 19.25 21H4.75A1.75 1.75 0 0 1 3 19.25v-9.3c0-.662.292-1.29.797-1.718zm1.936 1.145a.75.75 0 0 0-.968 0l-6.74 5.698a.75.75 0 0 0-.265.573v9.3c0 .138.112.25.25.25h14.5a.25.25 0 0 0 .25-.25v-9.3a.75.75 0 0 0-.267-.573z" />
                            </svg>
                        </x-slot>

                        <x-slot name="input">
                            <input type="text" id="num_int" name="num_int" min="0"
                                class="form-control" />
                        </x-slot>

                    </x-form-group>
                </div>

            </section>

            <section id="emergency-contact-tab-pane" class="tab-pane fade">

                <div class="row">

                    {{-- Nombre de emergencia --}}
                    <x-form-group>
                        <x-slot name="label">
                            <x-label-with-tooltip labelFor="nombre_e" titleLabel="Nombre" :required="true"/>
                        </x-slot>
    
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                <path fill="#999999"
                                    d="M12 12q-1.65 0-2.825-1.175T8 8t1.175-2.825T12 4t2.825 1.175T16 8t-1.175 2.825T12 12m-8 6v-.8q0-.85.438-1.562T5.6 14.55q1.55-.775 3.15-1.162T12 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T20 17.2v.8q0 .825-.587 1.413T18 20H6q-.825 0-1.412-.587T4 18m2 0h12v-.8q0-.275-.137-.5t-.363-.35q-1.35-.675-2.725-1.012T12 15t-2.775.338T6.5 16.35q-.225.125-.363.35T6 17.2zm6-8q.825 0 1.413-.587T14 8t-.587-1.412T12 6t-1.412.588T10 8t.588 1.413T12 10m0 8" />
                            </svg>
                        </x-slot>
    
                        <x-slot name="input">
                            <input class="form-control" type="text" id="nombre_e" name="nombre_e">
                        </x-slot>
    
                    </x-form-group>

                    {{-- Telefono de emergencia --}}
                    <x-form-group>
                        <x-slot name="label">
                            <x-label-with-tooltip labelFor="telefono_e" titleLabel="Teléfono" :required="true"/>
                        </x-slot>
    
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                            viewBox="0 0 256 256">
                            <path fill="#999999"
                                d="m222.37 158.46l-47.11-21.11l-.13-.06a16 16 0 0 0-15.17 1.4a8 8 0 0 0-.75.56L134.87 160c-15.42-7.49-31.34-23.29-38.83-38.51l20.78-24.71c.2-.25.39-.5.57-.77a16 16 0 0 0 1.32-15.06v-.12L97.54 33.64a16 16 0 0 0-16.62-9.52A56.26 56.26 0 0 0 32 80c0 79.4 64.6 144 144 144a56.26 56.26 0 0 0 55.88-48.92a16 16 0 0 0-9.51-16.62M176 208A128.14 128.14 0 0 1 48 80a40.2 40.2 0 0 1 34.87-40a.6.6 0 0 0 0 .12l21 47l-20.67 24.74a6 6 0 0 0-.57.77a16 16 0 0 0-1 15.7c9.06 18.53 27.73 37.06 46.46 46.11a16 16 0 0 0 15.75-1.14a8 8 0 0 0 .74-.56L168.89 152l47 21.05h.11A40.21 40.21 0 0 1 176 208" />
                        </svg>
                        </x-slot>
    
                        <x-slot name="input">
                            <input class="form-control" type="text" id="telefono_e" name="telefono_e"
                                maxlength="10">
                        </x-slot>
    
                    </x-form-group>

                    {{-- Parentesco del contacto de emergencia --}}
                    <x-form-group>
                        <x-slot name="label">
                            <x-label-with-tooltip labelFor="parentesco" titleLabel="Parentesco" :required="true"/>
                        </x-slot>
    
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 2048 2048"><path fill="#999999" d="M1790 1717q98 48 162 135t81 196h-110q-11-57-41-106t-73-84t-97-56t-112-20q-59 0-112 20t-97 55t-73 85t-41 106h-110q16-108 80-195t163-136q-57-45-88-109t-32-136q0-45 12-87t36-79t57-66t74-49q-27-39-62-69t-76-53t-86-33t-93-12q-80 0-153 31t-127 91q24 65 24 134q0 92-41 173t-115 136q65 33 117 81t90 108t57 128t20 142H896q0-79-30-149t-82-122t-123-83t-149-30q-80 0-149 30t-122 82t-83 123t-30 149H0q0-73 20-141t57-128t89-108t118-82q-74-55-115-136t-41-173q0-79 30-149t82-122t122-83t150-30q85 0 161 36t132 100q26-25 56-45t63-38q-74-55-115-136t-41-173q0-79 30-149t82-122t122-83t150-30q79 0 149 30t122 82t83 123t30 149q0 92-41 173t-115 136q70 37 126 90t95 123q64 0 120 24t99 67t66 98t24 121q0 72-31 136t-89 109M512 1536q53 0 99-20t82-55t55-81t20-100q0-53-20-99t-55-82t-81-55t-100-20q-53 0-99 20t-82 55t-55 81t-20 100q0 53 20 99t55 82t81 55t100 20m384-896q0 53 20 99t55 82t81 55t100 20q53 0 99-20t82-55t55-81t20-100q0-53-20-99t-55-82t-81-55t-100-20q-53 0-99 20t-82 55t-55 81t-20 100m704 630q-42 0-78 16t-64 43t-44 64t-16 79t16 78t43 64t64 44t79 16t78-16t64-43t44-64t16-79t-16-78t-43-64t-64-44t-79-16"/></svg>
                        </x-slot>
    
                        <x-slot name="input">
                            <input class="form-control" type="text" id="parentesco" name="parentesco">
                        </x-slot>
    
                    </x-form-group>

                </div>

            </section>

        </div>


    </div>
</div>
