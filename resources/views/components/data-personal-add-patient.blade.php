<div class="row d-none form-step animate__animated animate__fadeInUp">
    <div class="col-12">

        {{-- Tabs para los datos del usuario --}}
        <div class="nav nav-pills mb-3 justify-content-center justify-content-lg-start" role="tablist" aria-orientation="vertical">

            {{-- Tap para los datos personales --}}
            <x-item-tab id="datapersonal-tab-pane" name="Datos personales" :active=true classCustom="tapsPersonalData">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20">
                    <g fill="none" stroke="#0284c7" stroke-linecap="round">
                        <circle cx="9.5" cy="5.5" r="3" />
                        <path d="M15 16.5v-2c0-3.098-2.495-6-5.5-6c-3.006 0-5.5 2.902-5.5 6v2" />
                    </g>
                </svg>
            </x-item-tab>

            {{-- Tap para el domicilio --}}
            <x-item-tab id="domicile-tab-pane" name="Domicilio" :active=false classCustom="tapsPersonalData">
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


            {{-- Tap para el contacto de emergencia --}}
            <x-item-tab id="emergency-contact-tab-pane" name="Contacto de emergencia" :active=false classCustom="tapsPersonalData">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"
                    class="me-1">
                    <path fill="#0284c7"
                        d="M12 21.325q1.875-1.775 2.938-3.412T16 15.15q0-1.725-1.162-2.937T12 11t-2.838 1.213T8 15.15q0 1.125 1.063 2.763T12 21.325m0 1.348q-2.486-2.229-3.743-4.111T7 15.15q0-2.127 1.449-3.638T12 10t3.551 1.512T17 15.15q0 1.644-1.305 3.47T12 22.672m0-6.557q.471 0 .793-.323q.323-.322.323-.793t-.323-.793q-.322-.323-.793-.323t-.793.323q-.323.322-.323.793t.323.793q.322.323.793.323M8.47 7.142l-.69-.688q.886-.75 1.968-1.16q1.083-.41 2.252-.41t2.252.41t1.967 1.16l-.688.688q-.744-.628-1.657-.943T12 5.885t-1.874.314t-1.657.943M5.65 4.317l-.694-.707q1.46-1.325 3.277-2.025T12 .885q1.97 0 3.787.7t3.277 2.044l-.708.713q-1.314-1.198-2.945-1.827q-1.63-.63-3.411-.63q-1.761 0-3.399.617T5.65 4.317M12 15" />
                </svg>
            </x-item-tab>
        </div>

        {{-- x-item-tab-with --}}
        <div class="tab-content row bg-content-custom shadow-custom p-3 ">
        
            <section id="datapersonal-tab-pane" class="tab-pane fade show active">
                <div class="row">

                    {{-- Código --}}
                    <x-form-group>
                        <x-slot name="label">
                            <label for="codigo"><span class="required-point me-1">*</span>Código:</label>
                        </x-slot>
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#0284c7" d="M14 7V5h8v2zm0 4V9h8v2zm0 4v-2h8v2zm-6-1q-1.25 0-2.125-.875T5 11t.875-2.125T8 8t2.125.875T11 11t-.875 2.125T8 14m-6 6v-1.9q0-.525.25-1t.7-.75q1.125-.675 2.388-1.012T8 15t2.663.338t2.387 1.012q.45.275.7.75t.25 1V20zm2.15-2h7.7q-.875-.5-1.85-.75T8 17t-2 .25t-1.85.75M8 12q.425 0 .713-.288T9 11t-.288-.712T8 10t-.712.288T7 11t.288.713T8 12m0 6"/></svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><g fill="none" stroke="#65a30d" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M22 9L12 5L2 9l10 4zv6"/><path d="M6 10.6V16a6 3 0 0 0 12 0v-5.4"/></g></svg>
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
                            <label for="name_P"><span class="required-point me-1">*</span> Nombre completo:</label>
                        </x-slot>
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#ea580c" d="M15.71 12.71a6 6 0 1 0-7.42 0a10 10 0 0 0-6.22 8.18a1 1 0 0 0 2 .22a8 8 0 0 1 15.9 0a1 1 0 0 0 1 .89h.11a1 1 0 0 0 .88-1.1a10 10 0 0 0-6.25-8.19M12 12a4 4 0 1 1 4-4a4 4 0 0 1-4 4"/></svg>
                        </x-slot>
                        <x-slot name="input">
                            <input class="form-control" type="text" name="name_P" id="name_P"
                                oninput="this.value = this.value.toUpperCase()" />
                        </x-slot>
                    </x-form-group>


                    {{-- Carrera/Puesto --}}
                    <x-form-group>
                        <x-slot name="label">
                            <label for="Puesto"><span class="required-point me-1">*</span> Carrera/puesto: </label>
                        </x-slot>
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#0891b2" d="M4 19V8zm.616 1q-.691 0-1.153-.462T3 18.384V8.616q0-.691.463-1.153T4.615 7H9V5.615q0-.69.463-1.153T10.616 4h2.769q.69 0 1.153.462T15 5.615V7h4.385q.69 0 1.152.463T21 8.616v4.198q-.239-.152-.479-.265q-.24-.112-.521-.21V8.616q0-.27-.173-.443T19.385 8H4.615q-.269 0-.442.173T4 8.616v9.769q0 .269.173.442t.443.173h7.459q.056.275.12.516q.063.24.153.484zM10 7h4V5.615q0-.269-.173-.442T13.385 5h-2.77q-.269 0-.442.173T10 5.615zm8 15q-1.671 0-2.835-1.164Q14 19.67 14 18t1.165-2.835T18 14t2.836 1.165T22 18t-1.164 2.836T18 22m.385-4.161v-2.723h-.77v3.046l2.035 2.034l.546-.546z"/></svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256"><path fill="#7c3aed" d="M208 26h-40a6 6 0 0 0 0 12h25.52l-30 29.94A62 62 0 1 0 114 173.7V194H88a6 6 0 0 0 0 12h26v26a6 6 0 0 0 12 0v-26h26a6 6 0 0 0 0-12h-26v-20.3a62 62 0 0 0 45.28-96.5L202 46.48V72a6 6 0 0 0 12 0V32a6 6 0 0 0-6-6m-88 136a50 50 0 1 1 50-50a50.06 50.06 0 0 1-50 50"/></svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#4f46e5" d="M12 10L8 4.4L9.6 2h4.8L16 4.4zm3.5-3.2l-1.2 1.7c2.2.9 3.7 3 3.7 5.5a6 6 0 0 1-6 6a6 6 0 0 1-6-6c0-2.5 1.5-4.6 3.7-5.5L8.5 6.8C5.8 8.1 4 10.8 4 14a8 8 0 0 0 8 8a8 8 0 0 0 8-8c0-3.2-1.8-5.9-4.5-7.2"/></svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><g fill="none" stroke="#0284c7" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M4 16.5V20a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-3.5M3 14v-1a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v1m-9-6v3m0-3c1.262 0 2-.968 2-2.625S12 2 12 2s-2 1.718-2 3.375S10.738 8 12 8"/><path d="M9 14a3 3 0 1 1-6 0m12 0a3 3 0 1 1-6 0m12 0a3 3 0 1 1-6 0"/></g></svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256"><path fill="#059669" d="m222.37 158.46l-47.11-21.11l-.13-.06a16 16 0 0 0-15.17 1.4a8 8 0 0 0-.75.56L134.87 160c-15.42-7.49-31.34-23.29-38.83-38.51l20.78-24.71c.2-.25.39-.5.57-.77a16 16 0 0 0 1.32-15.06v-.12L97.54 33.64a16 16 0 0 0-16.62-9.52A56.26 56.26 0 0 0 32 80c0 79.4 64.6 144 144 144a56.26 56.26 0 0 0 55.88-48.92a16 16 0 0 0-9.51-16.62M176 208A128.14 128.14 0 0 1 48 80a40.2 40.2 0 0 1 34.87-40a.6.6 0 0 0 0 .12l21 47l-20.67 24.74a6 6 0 0 0-.57.77a16 16 0 0 0-1 15.7c9.06 18.53 27.73 37.06 46.46 46.11a16 16 0 0 0 15.75-1.14a8 8 0 0 0 .74-.56L168.89 152l47 21.05h.11A40.21 40.21 0 0 1 176 208"/></svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><g fill="none"><path stroke="#dc2626" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 7h6m-3-3v6"/><path fill="#dc2626" d="m8 5l.759-.651a1 1 0 0 0-1.518 0zm0 0l-.76-.651v.002l-.005.004a8.864 8.864 0 0 0-.228.277A30.613 30.613 0 0 0 4.64 8.048C3.367 10.19 2 13.133 2 16h2c0-2.31 1.133-4.866 2.36-6.93a28.613 28.613 0 0 1 2.203-3.181a14.844 14.844 0 0 1 .186-.226l.008-.01l.002-.002zm6 11c0-2.867-1.367-5.81-2.64-7.952a30.604 30.604 0 0 0-2.367-3.416a16.844 16.844 0 0 0-.228-.277l-.004-.004l-.002-.002L8 5l-.759.651l.002.002l.008.01a7.62 7.62 0 0 1 .186.226A28.613 28.613 0 0 1 9.64 9.07C10.866 11.134 12 13.69 12 16zm-2 0a4 4 0 0 1-4 4v2a6 6 0 0 0 6-6zm-4 4a4 4 0 0 1-4-4H2a6 6 0 0 0 6 6z"/></g></svg>
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
                            <x-label-with-tooltip labelFor="nss" titleLabel="NSS" :required=true
                                message="El NSS debe ser 11 dígitos" :haveTooltip="true" />
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 48 48"><path fill="none" stroke="#059669" stroke-linecap="round" stroke-linejoin="round" d="M16.951 17.884c2.45-.749 7.004-2.796 12.813-8.199c8.383-7.794 12.667-3.55 12.735 3.9s-3.838 23.28-7.495 26.394s-7.018 2.427-7.018 2.427s5.999-3.421 2.745-11.51s-11.802-11.138-16.711-11.2s-7.452-.282-7.877.654c0 0-1.314-1.48-.183-2.196s2.544-1.24 3.117-1.994s3.534-1.443 7.042-1.309s4.406-.313 4.406-.313"/><path fill="none" stroke="#059669" stroke-linecap="round" stroke-linejoin="round" d="M21.698 12.646a53 53 0 0 1-3.462-2.96C9.853 1.89 5.569 6.135 5.5 13.584c-.006.66.019 1.383.072 2.159m.995 7.136c1.402 7.175 3.971 15.007 6.428 17.1c3.657 3.115 7.018 2.427 7.018 2.427m14.082-8.726a25.7 25.7 0 0 0-3.91-10.428c-3.13-4.594-3.855-5.515-2.963-7.255s4.696-4.355 4.696-4.355"/><path fill="none" stroke="#059669" stroke-linecap="round" stroke-linejoin="round" d="M21.783 30.25s-3.296.895-3.799-1.485s1.369-3.948 4.211-2.854s5.865 8.261 3.404 12.112s-8.832.285-8.832.285"/><path fill="none" stroke="#059669" stroke-linecap="round" stroke-linejoin="round" d="M21.528 36.734c.73-.632-.023-2.228-1.226-1.973c-.111-1-1.454-1.88-3.389-.847c-2.263 1.21-1.232 4.94 2.661 4.247M17.7 31.72a3.7 3.7 0 0 1 2.215-1.337"/></svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#ea580c" d="M18 12.22V9l-5-2.5V5h2V3h-2V1h-2v2H9v2h2v1.5L6 9v3.22L2 14v8h9v-4c0-.55.45-1 1-1s1 .45 1 1v4h9v-8zM20 20h-5v-2.04c0-1.69-1.35-3.06-3-3.06s-3 1.37-3 3.06V20H4v-4.79l4-1.81v-3.35L12 8l4 2.04v3.35l4 1.81zm-8-9.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5"/></svg>
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
                            <x-label-with-tooltip labelFor="estado" titleLabel="Estado" :required=true />
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#4f46e5" d="M2 2h5.442L11 5.913V2h5.468L22 8.638V22H2zm11 2v16h7V9.362L15.532 4zm-2 16V8.887L6.558 4H4v16zM6 7.998h2.004v2.004H6zm9 0h2.004v2.004H15zm-9 4h2.004v2.004H6zm9 0h2.004v2.004H15zm-9 4h2.004v2.004H6zm9 0h2.004v2.004H15z"/></svg>
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
                            <x-label-with-tooltip labelFor="ciudad" titleLabel="Ciudad" :required=true />
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256"><path fill="#0891b2" d="M240 210h-10V88a6 6 0 0 0-6-6h-64a6 6 0 0 0-6 6v42h-52V40a6 6 0 0 0-6-6H32a6 6 0 0 0-6 6v170H16a6 6 0 0 0 0 12h224a6 6 0 0 0 0-12M166 94h52v116h-52Zm-12 48v68h-52v-68ZM38 46h52v164H38Zm32 26v16a6 6 0 0 1-12 0V72a6 6 0 0 1 12 0m0 48v16a6 6 0 0 1-12 0v-16a6 6 0 0 1 12 0m0 48v16a6 6 0 0 1-12 0v-16a6 6 0 0 1 12 0m52 16v-16a6 6 0 0 1 12 0v16a6 6 0 0 1-12 0m64 0v-16a6 6 0 0 1 12 0v16a6 6 0 0 1-12 0m0-48v-16a6 6 0 0 1 12 0v16a6 6 0 0 1-12 0"/></svg>
                        </x-slot>

                        <x-slot name="input">
                            <input class="form-control" type="text" id="ciudad" name="ciudad">
                        </x-slot>
                    </x-form-group>


                    {{-- Colonia --}}
                    <x-form-group>
                        <x-slot name="label">
                            <x-label-with-tooltip labelFor="colonia" titleLabel="Colonia" :required=true />
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 50 50"><path fill="#65a30d" d="M7.743 21.8h3.485v22.4h5.229V25h5.229v19.2h5.228V25h5.23v19.2h5.229V21.8h3.484c.963 0 1.744-.716 1.744-1.6c0-.534-.288-1.004-.727-1.294l.003-.003l-.026-.015l-.045-.027l-16.635-8.609V7.73c3.072 1.412 5.601-1.02 9.585.442V2.601c-3.986-1.462-6.514.968-9.585-.443V1.8c0-.443-.389-.8-.871-.8s-.87.357-.87.8v8.452L6.795 18.859l-.045.027l-.025.017v.003c-.437.29-.724.761-.724 1.294c-.001.884.78 1.6 1.742 1.6m1.742 24.001L6 49h36.602l-3.487-3.199z"/></svg>
                        </x-slot>

                        <x-slot name="input">
                            <input class="form-control" type="text" id="colonia"
                                name="colonia">
                        </x-slot>

                    </x-form-group>


                    {{-- Codigo postal --}}
                    <x-form-group>
                        <x-slot name="label">
                            <x-label-with-tooltip labelFor="cp" titleLabel="Código postal" :required=true />
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 1792 1792"><path fill="#0284c7" d="m1474 913l39 51q8 11 6.5 23.5T1508 1008q-43 34-126.5 98.5t-146.5 113t-67 51.5q-39 32-60 48t-60.5 41t-76.5 36.5t-74 11.5h-2q-37 0-74-11.5t-76-36.5t-61-41.5t-60-47.5q-5-4-65-50.5t-143.5-111T293 1015q-11-8-12.5-20.5T287 971l37-52q8-11 21.5-13t24.5 7q94 73 306 236q5 4 43.5 35t60.5 46.5t56.5 32.5t58.5 17h2q24 0 58.5-17t56.5-32.5t60.5-46.5t43.5-35q258-198 313-242q11-8 24-6.5t21 12.5m190 719V704q-90-83-159-139q-91-74-389-304q-3-2-43-35t-61-48t-56-32.5t-59-17.5h-2q-24 0-59 17.5T780 178t-61 48t-43 35Q461 427 360.5 506.5T231 610.5T149 685q-14 12-21 19v928q0 13 9.5 22.5t22.5 9.5h1472q13 0 22.5-9.5t9.5-22.5m128-928v928q0 66-47 113t-113 47H160q-66 0-113-47T0 1632V704q0-56 41-94q123-114 350-290.5T624 138q36-30 59-47.5t61.5-42t76-36.5T895 0h2q37 0 74.5 12t76 36.5t61.5 42t59 47.5q43 36 156 122t226 177t201 173q41 38 41 94"/></svg>
                        </x-slot>

                        <x-slot name="input">
                            <input class="form-control" maxlength="5" type="number" id="cp" name="cp">
                        </x-slot>

                    </x-form-group>


                    {{-- Calle --}}
                    <x-form-group>
                        <x-slot name="label">
                            <x-label-with-tooltip labelFor="calle" titleLabel="Calle" :required=true />
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#666666" d="M2 16.289V7.711h4.77v8.577zm7.616 0V7.711h4.769v8.577zm7.615 0V7.711H22v8.577zM3 15.289h2.77V8.71H3zm15.423 0H21V8.71h-2.577z"/></svg>
                        </x-slot>

                        <x-slot name="input">
                            <input type="text" id="calle" name="calle" class="form-control" />
                        </x-slot>

                    </x-form-group>


                    {{-- Numero --}}
                    <x-form-group>
                        <x-slot name="label">
                            <x-label-with-tooltip labelFor="num" titleLabel="Número" :required=true />
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20"><path fill="#db2777" d="M2.75 4.5a.75.75 0 0 0 0 1.5h14.5a.75.75 0 0 0 0-1.5zm0 3a.75.75 0 0 0 0 1.5h14.5a.75.75 0 0 0 0-1.5zM2 11.25a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75m.75 2.25a.75.75 0 0 0 0 1.5h9.5a.75.75 0 0 0 0-1.5z"/></svg>
                        </x-slot>

                        <x-slot name="input">
                            <input type="number" id="num" name="num" min="1"
                                class="form-control" />
                        </x-slot>

                    </x-form-group>


                    {{-- Numero interior --}}
                    <x-form-group>
                        <x-slot name="label">
                            <x-label-with-tooltip labelFor="num_int" titleLabel="Número interior" :required=false />
                        </x-slot>

                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 24 24">
                                <path fill="#059669"
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
                            <x-label-with-tooltip labelFor="nombre_e" titleLabel="Nombre" :required=true/>
                        </x-slot>
    
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                <path fill="#e11d48"
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
                            <x-label-with-tooltip labelFor="telefono_e" titleLabel="Teléfono" :required=true/>
                        </x-slot>
    
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                            viewBox="0 0 256 256">
                            <path fill="#e11d48"
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
                            <x-label-with-tooltip labelFor="parentesco" titleLabel="Parentesco" :required=true/>
                        </x-slot>
    
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 2048 2048"><path fill="#e11d48" d="M1790 1717q98 48 162 135t81 196h-110q-11-57-41-106t-73-84t-97-56t-112-20q-59 0-112 20t-97 55t-73 85t-41 106h-110q16-108 80-195t163-136q-57-45-88-109t-32-136q0-45 12-87t36-79t57-66t74-49q-27-39-62-69t-76-53t-86-33t-93-12q-80 0-153 31t-127 91q24 65 24 134q0 92-41 173t-115 136q65 33 117 81t90 108t57 128t20 142H896q0-79-30-149t-82-122t-123-83t-149-30q-80 0-149 30t-122 82t-83 123t-30 149H0q0-73 20-141t57-128t89-108t118-82q-74-55-115-136t-41-173q0-79 30-149t82-122t122-83t150-30q85 0 161 36t132 100q26-25 56-45t63-38q-74-55-115-136t-41-173q0-79 30-149t82-122t122-83t150-30q79 0 149 30t122 82t83 123t30 149q0 92-41 173t-115 136q70 37 126 90t95 123q64 0 120 24t99 67t66 98t24 121q0 72-31 136t-89 109M512 1536q53 0 99-20t82-55t55-81t20-100q0-53-20-99t-55-82t-81-55t-100-20q-53 0-99 20t-82 55t-55 81t-20 100q0 53 20 99t55 82t81 55t100 20m384-896q0 53 20 99t55 82t81 55t100 20q53 0 99-20t82-55t55-81t20-100q0-53-20-99t-55-82t-81-55t-100-20q-53 0-99 20t-82 55t-55 81t-20 100m704 630q-42 0-78 16t-64 43t-44 64t-16 79t16 78t43 64t64 44t79 16t78-16t64-43t44-64t16-79t-16-78t-43-64t-64-44t-79-16"/></svg>
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
