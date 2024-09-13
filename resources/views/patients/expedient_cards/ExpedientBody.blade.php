<div class="card">
    <div class="card-header text-center bg-blue">
        Medidas corporales
    </div>
    <div class="card-body">
        <div class="row col-12">


            <div class="col-lg-6 col-md-6 col-sm-12  mt-2">
                <div class="row ms-1">
                    <h5 class="m-0 mt-1 aling-items-center mb-2">
                        <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 48 48">
                                <g fill="none">
                                    <path stroke="#059669" stroke-linejoin="round" stroke-width="4"
                                        d="M41 4H7a3 3 0 0 0-3 3v34a3 3 0 0 0 3 3h34a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3Z" />
                                    <path stroke="#059669" stroke-linecap="round" stroke-width="4"
                                        d="M12 19.054q4.987-6 12-6q7.012 0 12 6" />
                                    <path fill="#059669" d="M24 31a3 3 0 1 0 0-6a3 3 0 0 0 0 6" />
                                    <path stroke="#059669" stroke-linecap="round" stroke-width="4" d="m19 21l5.008 7" />
                                </g>
                            </svg>
                        </span> Peso
                    </h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-start pt-0">
                            <div class="form-group col-6 col-sm-12 pt-2">
                                <p class="fw-bold mb-0">Peso </p>
                                <div class="mt-0 ps-1"> <span> {{ $Medidas['Peso'] }} </span> Kg
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start pt-0">
                            <div class="form-group col-6 col-sm-12 pt-2">
                                <p class="fw-bold mb-0">Estatura </p>
                                <div class="mt-0 ps-1"> <span> {{ $Medidas['Estatura'] }} </span> cm
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                <div class="row ms-1">
                    <h5 class="m-0 mt-1 aling-items-center mb-2">
                        <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 48 48">
                                <g fill="none" stroke="#0284c7" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M15.819 41.078h16.974M19.302 6.8h14.714m.039.01c5.207 3.384 8.436 9.808 8.436 16.78h0c0 7.437-3.67 14.205-9.418 17.368m-2.226-26.502h9.436m-7.485 9.784h9.52m-12.062 9.602l9.668-.029M16.339 18.189h10.177m-10.066-.006h.296m2.602-11.329c4.751 3.478 7.733 9.755 7.733 16.42h0c-.04 7.12-2.977 14.17-7.069 16.781c-1.087.694-2.31.978-3.489 1.026" />
                                    <path
                                        d="M16.484 18.179c4.459.087 7.246 9.895 2.995 13.885c-.356.33-.952.67-1.206.815c-.725.414-1.325.452-1.891.51c-.841.087-1.572-.22-2.008-.43s-1.271-.806-1.784-1.515c-1.312-1.812-1.578-5.042 2.079-6.883" />
                                    <path
                                        d="M15.864 41.08c-5.9-.296-10.269-5.347-10.269-11.455c0-5.626 3.342-10.426 8.608-11.367c.183-.032-.075-.003.234-.042c.453-.054 1.572-.018 1.849-.032" />
                                </g>
                            </svg>
                        </span> Medidas
                    </h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-start pt-0">
                            <div class="form-group col-6 col-sm-12 pt-2">
                                <p class="fw-bold mb-0">Circ. cintura </p>
                                <div class="mt-0 Old-Data"> <span> {{ $Medidas['Cintura'] }} </span> cm
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start pt-0">
                            <div class="form-group col-6 col-sm-12 pt-2">
                                <p class="fw-bold mb-0">Circ. cadera </p>
                                <div class="mt-0 Old-Data"> <span> {{ $Medidas['Cadera'] }} </span> cm
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-12 mt-3">
                <div class="row ms-1">
                    <h5 class="m-0 mt-1 aling-items-center mb-2">
                        <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 48 48">
                                <g fill="none" stroke="#0284c7" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M15.819 41.078h16.974M19.302 6.8h14.714m.039.01c5.207 3.384 8.436 9.808 8.436 16.78h0c0 7.437-3.67 14.205-9.418 17.368m-2.226-26.502h9.436m-7.485 9.784h9.52m-12.062 9.602l9.668-.029M16.339 18.189h10.177m-10.066-.006h.296m2.602-11.329c4.751 3.478 7.733 9.755 7.733 16.42h0c-.04 7.12-2.977 14.17-7.069 16.781c-1.087.694-2.31.978-3.489 1.026" />
                                    <path
                                        d="M16.484 18.179c4.459.087 7.246 9.895 2.995 13.885c-.356.33-.952.67-1.206.815c-.725.414-1.325.452-1.891.51c-.841.087-1.572-.22-2.008-.43s-1.271-.806-1.784-1.515c-1.312-1.812-1.578-5.042 2.079-6.883" />
                                    <path
                                        d="M15.864 41.08c-5.9-.296-10.269-5.347-10.269-11.455c0-5.626 3.342-10.426 8.608-11.367c.183-.032-.075-.003.234-.042c.453-.054 1.572-.018 1.849-.032" />
                                </g>
                            </svg>
                        </span> Índice de masa corporal (IMC)
                    </h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-center align-items-center pt-0">
                            <div class="row d-flex flex-column">
                                <div class="col-12 h-avatar-imc d-flex justify-content-center">
                                    <img src="{{ asset('/images/' . $Medidas['Imc']['url']) }}"
                                        alt="Medidor indice de masa corporal">
                                </div>
                                <div class="col-12 text-center">
                                    <hr class="my-1">
                                    <h5>{{ $Medidas['Imc']['titleImc'] }}</h5>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
