<div class="row mt-2 d-none form-step animate__animated animate__fadeInUp">
    <div class="hr-custom mb-2"></div>
    <h4 class="text-center fw-bold title-size-sm mt-2">Datos personales</h4>
    <p class="text-center">Todos los campos con un asterisco de color rojo<br /> son <b>obligatorios.</b></p>
    <div class="col-12 mt-2">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <div class="row pt-2">
                        <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                            <label for="codigo">Código:<span class="required-point">*</span></label>
                            <input class="form-control" type="text" id="codigo" name="codigo"
                                maxlength="9">
                            <span class="text-danger fw-normal d-none">Código no válido.</span>
                        </div>

                        <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                            <label for="gender">
                                Género:<span class="required-point">*</span></label>
                            <select class="form-control" name="gender" id="gender">
                                <option value="" disabled selected>Seleccione una opción</option>
                                <option value="1">Masculino</option>
                                <option value="2">Femenino</option>
                            </select>
                            <span class="text-danger fw-normal d-none"></span>
                        </div>
                    </div>
                </div>

                <div class="form-group pt-2 col-12 mb-2 group-custom">
                    <label for="name_P"> Nombre
                        Completo:<span class="required-point">*</span></label>
                    <input class="form-control" type="text" name="name_P" id="name_P"
                        oninput="this.value = this.value.toUpperCase()" />
                    <span class="text-danger fw-normal d-none"></span>

                </div>
                <div class="form-group mb-4">
                    <div class="row pt-2">
                        <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                            <label for="F_nacimiento"> Fecha de nacimiento <span class="required-point">*</span></label>
                            <input type="date" id="F_nacimiento" name="F_nacimiento"
                                class="form-control" />
                            <span class="text-danger fw-normal d-none"></span>
                        </div>
                        <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                            <label for="T_sangre"> Tipo de sangre <span class="required-point">*</span></label>
                            <select class="form-control" name="T_sangre" id="T_sangre">
                                <option value="" disabled selected>Seleccione una opción</option>
                                <option value="1">Grupo A Rh positivo (A+)</option>
                                <option value="2">Grupo A Rh negativo (A-)</option>
                                <option value="3">Grupo B Rh positivo (B+)</option>
                                <option value="4">Grupo B Rh negativo (B-)</option>
                                <option value="5">Grupo AB Rh positivo (AB+)</option>
                                <option value="6">Grupo AB Rh negativo (AB-)</option>
                                <option value="7">Grupo O Rh positivo (O+)</option>
                                <option value="8">Grupo O Rh negativo (O-)</option>
                            </select>
                            <span class="text-danger fw-normal d-none"></span>

                        </div>
                    </div>
                </div>
                <div class="hr-custom"></div>
                <h4 class="text-center pt-3 fw-bold title-size-sm">Domicilio</h4>
                <div class="form-group">
                    <div class="row pt-2">
                        <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                            <label for="estado">
                                Estado:<span class="required-point">*</span></label>
                            <input class="form-control" type="text" id="estado"
                                name="estado">
                            <span class="text-danger fw-normal d-none"></span>
                        </div>

                        <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                            <label for="ciudad">
                                Ciudad: <span class="required-point">*</span></label>
                            <input class="form-control" type="text" id="ciudad"
                                name="ciudad">
                            <span class="text-danger fw-normal d-none"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row pt-2">
                        <div class="form-group col-md-8 col-sm-12 mb-2 group-custom">
                            <label for="colonia">
                                Colonia:<span class="required-point">*</span></label>
                            <input class="form-control" type="text" id="colonia"
                                name="colonia">
                            <span class="text-danger fw-normal d-none"></span>
                        </div>

                        <div class="form-group col-md-4 col-sm-12 mb-2 group-custom">
                            <label for="cp">
                                Código postal: <span class="required-point">*</span></label>
                            <input class="form-control" maxlength="5" type="number" id="cp" name="cp" >
                            <span class="text-danger fw-normal d-none"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row pt-2">
                        <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                            <label for="calle"> Calle <span class="required-point">*</span></label>
                            <input type="text" id="calle" name="calle"
                                class="form-control" />
                            <span class="text-danger fw-normal d-none"></span>

                        </div>
                        <div class="form-group col-md-3 col-sm-8 mb-2 group-custom">
                            <label for="sangre"> Num <span class="required-point">*</span></label>
                            <input type="number" id="num" name="num" min="1"
                                class="form-control" />
                            <span class="text-danger fw-normal d-none"></span>
                        </div>
                        <div class="form-group col-md-3 col-sm-8 mb-2 ">
                            <label for="num_int">Num. Int </label>
                            <input type="number" id="num_int" name="num_int" min="0"
                                class="form-control" />
                            <span class="text-danger fw-normal d-none"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <div class="row pt-2">
                        <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                            <label for="telefono"> Teléfono: <span class="required-point">*</span></label>
                            <input type="text" id="telefono" name="telefono"
                                class="form-control" maxlength="10" />
                            <span class="text-danger fw-normal d-none"></span>
                        </div>
                        <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                            <label for="escolaridad"> Escolaridad: <span class="required-point">*</span></label>
                            <select class="form-control" name="escolaridad" id="escolaridad">
                                <option value="" disabled selected>Seleccione una opción</option>
                                <option value="1">Primaria</option>
                                <option value="2">Secundaria</option>
                                <option value="3">Preparatoria</option>
                                <option value="4">Licenciatura</option>
                                <option value="5">Maestría</option>
                                <option value="6">Doctorado</option>
                            </select>
                            <span class="text-danger fw-normal d-none"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row pt-2">
                        <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                            <label for="E_civil"> Estado
                                civil:<span class="required-point">*</span></label>
                            <select class="form-control" name="E_civil" id="E_civil">
                                <option value="" disabled selected>Seleccione una opción</option>
                                <option value="1">Soltero(a)</option>
                                <option value="2">Casado(a)</option>
                                <option value="3">Viudo(a)</option>
                                <option value="4">Divorciado(a)</option>
                                <option value="5">Separado(a)</option>
                            </select>
                            <span class="text-danger fw-normal d-none"></span>

                        </div>

                        <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                            <x-label-with-tooltip labelFor="nss" titleLabel="NSS" required="true" message="El NSS debe ser 11 dígitos" />
                            <input class="form-control" type="text" id="nss" maxlength="11"
                                name="nss">
                            <span class="text-danger fw-normal d-none"></span>
                        </div>

                        
                    </div>
                </div>
                <div class="row pt-2 mb-4">
                    <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                        <label for="Puesto">
                            Carrera/Puesto: <span class="required-point">*</span></label>
                        <input class="form-control" type="text" id="Puesto" name="puesto">
                        <span class="text-danger fw-normal d-none"></span>

                    </div>

                    <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                        <label for="religion">
                            Religión:<span class="required-point">*</span></label>
                        <input class="form-control" type="text" id="religion"
                            name="religion">
                        <span class="text-danger fw-normal d-none"></span>

                    </div>
                </div>
                <div class="hr-custom"></div>
                <h4 class="text-center pt-3 fw-bold title-size-sm">Contacto de emergencia</h4>
                <div class="form-group">
                    <div class="row pt-2">
                        <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                            <label for="nombre_e">
                                Nombre:<span class="required-point">*</span></label>
                            <input class="form-control" type="text" id="nombre_e"
                                name="nombre_e">
                            <span class="text-danger fw-normal d-none"></span>

                        </div>

                        <div class="form-group col-md-6 col-sm-12 mb-2 group-custom">
                            <label for="telefono_e">
                                Telefono:<span class="required-point">*</span></label>
                            <input class="form-control" type="text" id="telefono_e"
                                name="telefono_e" maxlength="10">
                            <span class="text-danger fw-normal d-none"></span>
                        </div>

                        <div class="form-group col-md-6 col-sm-12 mb-2 pt-md-2 group-custom">
                            <label for="parentesco">
                                Parentesco:<span class="required-point">*</span></label>
                            <input class="form-control" type="text" id="parentesco"
                                name="parentesco">
                            <span class="text-danger fw-normal d-none"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>