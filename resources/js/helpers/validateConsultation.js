let validate = false;

export const  vitalSigns = (data, inputsDom)=>{

    validate = true;

    const { frecuenciaCardiaca,
        presionArterial,
        temperatura,
        pesoKilogramos,
        frecuenciaRespiratoria,
        satPorcentaje,
        glucosa,
        talla } = data;

    const { inputFrecuenciaCardiaca,
        inputPresionArterial,
        inputTemperatura,
        inputPesoKilogramos,
        inputFrecuenciaRespiratoria,
        inputSATporcentaje,
        inputGlucosa,
        inputTalla, listVitalSigns } = inputsDom;



        listVitalSigns.each(function(){
            $(this).children('input').removeClass('is-invalid border-danger');
            $(this).children('span').addClass('d-none').text('');
        });

    if( frecuenciaCardiaca === '' && presionArterial === '' && temperatura === '' && pesoKilogramos === '' && frecuenciaRespiratoria === '' && satPorcentaje === '' && glucosa === '' && talla === ''){
        console.log('Todos los campos estan vacios');   
        listVitalSigns.each(function(){
            $(this).children('input').addClass('is-invalid border-danger');
            $(this).children('span').text('El campo es requerido').removeClass('d-none');
        });

        validate = false;
        return validate;
    }

    return validate;


    

}