<x-card-custom title="Medidas corporales">
    <div class="container">
        <div class="row">



            <div class="col-lg-6 col-12  mt-2">
                <div class="row ">
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
                    <ul class="list-group pe-0">
                        <li class="list-group-item d-flex justify-content-between align-items-start pt-0">
                            <div class="form-group col-6 col-12 pt-2">
                                <p class="fw-bold mb-0">Peso </p>
                                <div class="mt-0 ps-1"> <span> {{ $Medidas['Peso'] }} </span> Kg
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start pt-0">
                            <div class="form-group col-6 col-12 pt-2">
                                <p class="fw-bold mb-0">Estatura </p>
                                <div class="mt-0 ps-1"> <span> {{ $Medidas['Estatura'] }} </span> cm
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 col-12 mt-4 mt-lg-2">
                <div class="row">
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
                    <ul class="list-group pe-0">
                        <li class="list-group-item d-flex justify-content-between align-items-start pt-0">
                            <div class="form-group col-6 col-12 pt-2">
                                <p class="fw-bold mb-0">Circ. cintura </p>
                                <div class="mt-0 Old-Data"> <span> {{ $Medidas['Cintura'] }} </span> cm
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start pt-0">
                            <div class="form-group col-6 col-12 pt-2">
                                <p class="fw-bold mb-0">Circ. cadera </p>
                                <div class="mt-0 Old-Data"> <span> {{ $Medidas['Cadera'] }} </span> cm
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-12 mt-3">
                <div class="row ">
                    <h5 class="m-0 mt-1 aling-items-center mb-2">
                        <span class="pe-2"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 512 512">
                                <circle cx="256" cy="56" r="56" fill="#06285c" />
                                <path fill="#06285c"
                                    d="M437 128H75a27 27 0 0 0 0 54h101.88c6.91 0 15 3.09 19.58 15c5.35 13.83 2.73 40.54-.57 61.23l-4.32 24.45a.42.42 0 0 1-.12.35l-34.6 196.81A27.43 27.43 0 0 0 179 511.58a27.06 27.06 0 0 0 31.42-22.29l23.91-136.8S242 320 256 320c14.23 0 21.74 32.49 21.74 32.49l23.91 136.92a27.24 27.24 0 1 0 53.62-9.6L320.66 283a.45.45 0 0 0-.11-.35l-4.33-24.45c-3.3-20.69-5.92-47.4-.57-61.23c4.56-11.88 12.91-15 19.28-15H437a27 27 0 0 0 0-54Z" />
                            </svg>
                        </span> Índice de masa corporal (IMC)
                    </h5>
                    <ul class="list-group pe-0">
                        <li class="list-group-item d-flex justify-content-center align-items-center pt-0">
                            <div class="row d-flex flex-column">
                                <div class="col-12 h-avatar-imc d-flex justify-content-center">
                                    @if (!empty($Medidas['Imc']))
                                        <img style="width: 120px;"
                                            src="{{ asset('/images/' . $Medidas['Imc']['url']) }}"
                                            alt="Medidor indice de masa corporal">
                                    @else
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24"><path fill="none" stroke="#999999" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4.01l.01-.011M9 3H4v3m0 5v2m16-2v2M15 3h5v3M9 21H4v-3m11 3h5v-3"/></svg> --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80"
                                            viewBox="0 0 24 24">
                                            <path fill="#999999"
                                                d="M5 3h13a3 3 0 0 1 3 3v13a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3Zm0 1a2 2 0 0 0-2 2v11.586l4.293-4.293l2.5 2.5l5-5L20 16V6a2 2 0 0 0-2-2H5Zm4.793 13.207l-2.5-2.5L3 19a2 2 0 0 0 2 2h13a2 2 0 0 0 2-2v-1.586l-5.207-5.207l-5 5ZM7.5 6a2.5 2.5 0 1 1 0 5a2.5 2.5 0 0 1 0-5Zm0 1a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3Z" />
                                        </svg>
                                    @endif
                                </div>
                                <div class="col-12 text-center">
                                    <hr class="my-1">
                                    @if (!empty($Medidas['Imc']))
                                        <h5>{{ $Medidas['Imc']['titleImc'] }}</h5>
                                    @else
                                        <h5>Sin IMC</h5>
                                    @endif
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</x-card-custom>
