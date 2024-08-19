<section id="containerPersonSelect">
    <div class="row d-flex justify-content-center align-items-start gap-3">
        <div class="col-12 col-md-6 col-lg-3 col-xl-3 col-xxl-2 d-flex flex-column align-items-center bg-content-custom shadow-custom text-center py-3 card-hover"
            id="udgPerson">
            <div class="bg-avatar">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                    <g fill="#000000">
                        <path
                            d="M12.486 5.414a1 1 0 0 0-.972 0L5.06 9l6.455 3.586a1 1 0 0 0 .972 0L18.94 9l-6.455-3.586zm-1.943-1.749a3 3 0 0 1 2.914 0l8.029 4.46a1 1 0 0 1 0 1.75l-8.03 4.46a3 3 0 0 1-2.913 0l-8.029-4.46a1 1 0 0 1 0-1.75l8.03-4.46z" />
                        <path
                            d="M21 8a1 1 0 0 1 1 1v7a1 1 0 1 1-2 0V9a1 1 0 0 1 1-1zM6 10a1 1 0 0 1 1 1v5.382l4.553 2.276a1 1 0 0 0 .894 0L17 16.382V11a1 1 0 1 1 2 0v6a1 1 0 0 1-.553.894l-5.105 2.553a3 3 0 0 1-2.684 0l-5.105-2.553A1 1 0 0 1 5 17v-6a1 1 0 0 1 1-1z" />
                    </g>
                </svg>
            </div>
            <h4 class="fw-bold title-size-sm mt-2">Perteneciente UDG</h4>
        </div>
        <div class="col-12 col-md-6 col-lg-3 col-xl-3 col-xxl-2 d-flex flex-column align-items-center bg-content-custom shadow-custom text-center py-3 card-hover"
            id="externalPerson">
            <div class="bg-avatar">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                    <path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="M3 21h18M5 21V7l8-4v18m6 0V11l-6-4M9 9v.01M9 12v.01M9 15v.01M9 18v.01" />
                </svg>
            </div>
            <h4 class="fw-bold title-size-sm mt-2">Externos</h4>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-3 animate__animated animate__fadeInUp d-none"
        id="containerUdgPerson">
        <div class="col-12 col-md-10 col-lg-6 col-xl-4 bg-content-custom shadow-custom p-3">
            {{-- Alert for errors o no found code --}}
            <div class="alert text-center d-none" id="alertCodePerson" role="alert"></div>
            <div class="mb-3 d-flex gap-3 align-items-lg-end flex-column flex-lg-row">
                <div class="flex-grow-1">
                    <label for="code" class="form-label">Código</label>
                    <input type="text" class="form-control" id="code" placeholder="216610402" autocomplete="false">
                </div>
                <button class="btn-sec fst-normal tooltip-container p-2" type="button" id="searchCode">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 26 26">
                        <path
                            d="M10 .188A9.812 9.812 0 0 0 .187 10A9.812 9.812 0 0 0 10 19.813c2.29 0 4.393-.811 6.063-2.125l.875.875a1.845 1.845 0 0 0 .343 2.156l4.594 4.625c.713.714 1.88.714 2.594 0l.875-.875a1.84 1.84 0 0 0 0-2.594l-4.625-4.594a1.824 1.824 0 0 0-2.157-.312l-.875-.875A9.812 9.812 0 0 0 10 .188M10 2a8 8 0 1 1 0 16a8 8 0 0 1 0-16M4.937 7.469a5.446 5.446 0 0 0-.812 2.875a5.46 5.46 0 0 0 5.469 5.469a5.516 5.516 0 0 0 3.156-1a7.166 7.166 0 0 1-.75.03a7.045 7.045 0 0 1-7.063-7.062c0-.104-.005-.208 0-.312" />
                    </svg>
                    Buscar
                    <span class="tooltip-text">Buscar el código.</span>
                </button>
            </div>
            <div id="containerDataPerson" class="d-none animate__animated animate__fadeInUp">
                <ul class="list-group mb-2">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Nombre</div>
                            <span id="namePerson"> - </span>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Carrera / Puesto</div>
                            <span id="careerPerson"> - </span>
                        </div>
                    </li>
                </ul>

                <div class="d-flex justify-content-center mt-3">
                    <button class="w-full btn btn-primary" id="nextPersonUdg">Continuar</button>
                </div>
            </div>

        </div>
    </div>
</section>