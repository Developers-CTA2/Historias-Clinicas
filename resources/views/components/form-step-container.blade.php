<div class="row line-progress-step d-flex justify-content-between">

    <x-form-step-item :active="true" :haveTooltip="true" tooltipText="Datos personales">
        <p class="m-0 d-none d-sm-block">DP</p>
    </x-form-step-item>
    
    <x-form-step-item :active="false" :haveTooltip="true" tooltipText="Antecedentes heredo-familiares">
        <p class="m-0 d-none d-sm-block">AHF</p>
    </x-form-step-item>

    <x-form-step-item :active="false" :haveTooltip="true" tooltipText="Antecendentes no patológicos">
        <p class="m-0 d-none d-sm-block">ANP</p>
    </x-form-step-item>

    <x-form-step-item :active="false" :haveTooltip="true" tooltipText="Antecedentes patológicos personales">
        <p class="m-0 d-none d-sm-block">APP</p>
    </x-form-step-item>

    <x-form-step-item :active="false" :haveTooltip="true" tooltipText="Ginecología Obstetricia">
        <p class="m-0 d-none d-sm-block">GYO</p>
    </x-form-step-item>



</div>