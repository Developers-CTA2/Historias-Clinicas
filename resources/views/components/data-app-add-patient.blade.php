@props(['enfermedades', 'alergias'])

{{-- Antecedentes patológicos --}}

<div class="row p-3 form-step d-none animate__animated animate__fadeInUp bg-content-custom shadow-custom">
    <div class="col-xl-7 col-xxl-6 col-sm-12">

        <div class="d-flex justify-content-between my-1">
            <h5>Antecendentes patológicos</h5>
            <x-tooltip message="En esta sección debes agregar los antecedentes que ha tenido el paciente a lo largo de su vida, en caso de no tener alguno, presionar 'Siguiente'" />
        </div>
        
        <div class="hr-custom"></div>

        

        {{-- Tabs para las opciones --}}
        <div class="d-flex align-items-start mt-3">
            <x-container-tap-links />
            <x-container-tap-content :enfermedades="$enfermedades" :alergias="$alergias" />
        </div>
    
        <section class="mt-4 d-flex">
            <button id="addAntecedentesPatologicos" class="btn-blue-sec px-3 py-2 w-full d-flex gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px;" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Agregar</button>
        </section>



    </div> <!-- FIN contenedor 1  -->
    {{-- Contenedor 2 --}}
    <div class="col-xl-5 col-xxl-6 col-sm-12 mt-xl-0 mt-3">
        <div class="d-flex my-1">
            <h5>Lista de Antecedentes patológicos</h5>
        </div>
        <div class="hr-custom"></div>
        <div class="row d-flex justify-content-center justify-content-lg-start mt-4 mx-2">
            <div class="form-group container-list-custom">
                <div class="accordion mt-2 mb-2 list-dependencies-custom" id="listPathologicalHistory">
                </div>
                {{-- <ul class="list-group mt-2 list-dependencies-custom" id="listPathologicalHistory">
                </ul> --}}
            </div>
        </div>
    </div><!-- Fin de contenedor 2 -->
    <!-- Fin de contenedor 3 -->
</div>
