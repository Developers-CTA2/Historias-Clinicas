{{-- Contenedor de la parte superior con los botones de crear consultas --}}
<div class="col-12 ">
    <div class="d-flex flex-column flex-md-row justify-content-end gap-md-2 gap-3">


        @if (Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Prestador de medicina'))
            <x-button-link-custom :route="route('consultation.history', ['id_persona' => $Personal->id_persona])" class="btn-sec" text="Historial"
                tooltipText="Historial médico del paciente">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path
                            d="M7 9V7h14v2zm0 4v-2h14v2zm0 4v-2h14v2zM4 9q-.425 0-.712-.288T3 8t.288-.712T4 7t.713.288T5 8t-.288.713T4 9m0 4q-.425 0-.712-.288T3 12t.288-.712T4 11t.713.288T5 12t-.288.713T4 13m0 4q-.425 0-.712-.288T3 16t.288-.712T4 15t.713.288T5 16t-.288.713T4 17" />
                    </svg>
                </x-slot>
            </x-button-link-custom>

            <x-button-link-custom :route="route('consultation.new', ['id_persona' => $Personal->id_persona])" class="btn-blue-sec" text="Nueva consulta"
                tooltipText="Generar una consulta médica">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 1.25a.75.75 0 0 1 .75.75v.251a3.75 3.75 0 0 1 3.7 3.418c.014.166.014.354.014.629V7.52c0 3.87-2.944 7.05-6.714 7.427V17A4.25 4.25 0 0 0 14 21.25h.882a3.37 3.37 0 0 0 2.924-1.694A3.752 3.752 0 0 1 19 12.25a3.75 3.75 0 0 1 .387 7.48a4.869 4.869 0 0 1-4.505 3.02H14A5.75 5.75 0 0 1 8.25 17v-2.05a7.751 7.751 0 0 1-7-7.715v-.937c0-.275 0-.463.015-.628A3.75 3.75 0 0 1 4.67 2.265a6.88 6.88 0 0 1 .58-.015V2a.75.75 0 1 1 1.5 0v2a.75.75 0 0 1-1.5 0v-.25c-.263 0-.366.001-.448.009a2.25 2.25 0 0 0-2.043 2.043c-.008.09-.009.206-.009.535v.898A6.25 6.25 0 0 0 9 13.485a5.964 5.964 0 0 0 5.964-5.964V6.337c0-.329 0-.445-.008-.535a2.25 2.25 0 0 0-2.206-2.05V4a.75.75 0 0 1-1.5 0V2a.75.75 0 0 1 .75-.75M16.75 16a2.25 2.25 0 1 1 4.5 0a2.25 2.25 0 0 1-4.5 0"
                            clip-rule="evenodd" />
                    </svg>
                </x-slot>
            </x-button-link-custom>
        @endif

        @if (Auth::user()->hasRole('Prestador de nutrición'))

            <x-button-link-custom :route="route('nutrition.consultation.history', ['id_persona' => $Personal->id_persona])" class="btn-sec" text="Historial"
                tooltipText="Historial nutrional del paciente">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path
                            d="M7 9V7h14v2zm0 4v-2h14v2zm0 4v-2h14v2zM4 9q-.425 0-.712-.288T3 8t.288-.712T4 7t.713.288T5 8t-.288.713T4 9m0 4q-.425 0-.712-.288T3 12t.288-.712T4 11t.713.288T5 12t-.288.713T4 13m0 4q-.425 0-.712-.288T3 16t.288-.712T4 15t.713.288T5 16t-.288.713T4 17" />
                    </svg>
                </x-slot>
            </x-button-link-custom>

            <x-button-link-custom :route="route('nutrition.complete.nutrition-history', ['id_persona' => $Personal->id_persona])" class="btn-blue-sec" text="Nueva consulta"
                tooltipText="Generar una consulta de nutrición">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                        <path
                            d="M8.397 11.235a.75.75 0 0 0-.294-1.471c-.903.18-1.585.812-1.948 1.659c-.36.838-.413 1.886-.132 3.008a.75.75 0 1 0 1.455-.363c-.22-.878-.148-1.58.055-2.054c.2-.466.518-.71.864-.78M5.471 3.419A5.18 5.18 0 0 0 6.89 7.302a5.12 5.12 0 0 0-3.66 4.216a10.46 10.46 0 0 0 1.37 6.796l.35.59l.043.063l1.416 1.906a3.462 3.462 0 0 0 5.275.336a.437.437 0 0 1 .63 0a3.462 3.462 0 0 0 5.275-.336l1.416-1.907l.042-.063l.351-.59a10.46 10.46 0 0 0 1.373-6.795a5.12 5.12 0 0 0-6.11-4.306l-1.901.394h-.003c.03-.78.152-1.62.391-2.338c.29-.868.692-1.39 1.14-1.576a.75.75 0 1 0-.578-1.385c-1.052.439-1.65 1.48-1.985 2.486l-.046.142a5.2 5.2 0 0 0-.943-1.29a5.18 5.18 0 0 0-3.98-1.51A1.367 1.367 0 0 0 5.47 3.418m1.493.207a3.68 3.68 0 0 1 2.712 1.08a3.68 3.68 0 0 1 1.08 2.712a4 4 0 0 1-.543-.025l-.617-.128a3.7 3.7 0 0 1-1.552-.927a3.68 3.68 0 0 1-1.08-2.712m2.07 5.055l.202.042q.36.102.73.152l.97.2a5.25 5.25 0 0 0 2.13 0l1.902-.394a3.62 3.62 0 0 1 4.32 3.045a8.96 8.96 0 0 1-1.177 5.821l-.331.557l-1.393 1.876a1.962 1.962 0 0 1-2.99.19a1.936 1.936 0 0 0-2.792 0a1.962 1.962 0 0 1-2.99-.19l-1.393-1.876l-.331-.557a8.96 8.96 0 0 1-1.176-5.821A3.62 3.62 0 0 1 9.033 8.68" />
                    </svg>
                </x-slot>
            </x-button-link-custom>
        @endif
    </div>
</div>
