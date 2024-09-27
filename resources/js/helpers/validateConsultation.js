import {regexFrecuenciaCardiaca,
    regexPresionArterial,
    regexTemperatura,
    regexPesoKilogramos,
    regexFrecuenciaRespiratoria,
    regexPorcentaje,
    regexDecimal,
    regexGlucosa } from './Regex';

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

    if(frecuenciaCardiaca === ''){
        inputFrecuenciaCardiaca.addClass('is-invalid border-danger');
        inputFrecuenciaCardiaca.next().text('El campo es requerido').removeClass('d-none');
        validate = false;   
    }

    if(frecuenciaCardiaca !== '' && !regexFrecuenciaCardiaca.test(frecuenciaCardiaca)){
        inputFrecuenciaCardiaca.addClass('is-invalid border-danger');
        inputFrecuenciaCardiaca.next().text('No has ingresado una frecuencia cardiaca correcta').removeClass('d-none');
        validate = false;
    }

    if(presionArterial === ''){
        inputPresionArterial.addClass('is-invalid border-danger');
        inputPresionArterial.next().text('El campo es requerido').removeClass('d-none');
        validate = false;
    }   

    if(presionArterial !== '' && !regexPresionArterial.test(presionArterial)){
        inputPresionArterial.addClass('is-invalid border-danger');  
        inputPresionArterial.next().text('No has ingresado una presión arterial correcta').removeClass('d-none');
        validate = false;
    }

    if(temperatura === ''){
        inputTemperatura.addClass('is-invalid border-danger');
        inputTemperatura.next().text('El campo es requerido').removeClass('d-none');
        validate = false;
    }

    if(temperatura !== '' && !regexTemperatura.test(temperatura)){
        inputTemperatura.addClass('is-invalid border-danger');
        inputTemperatura.next().text('No has ingresado una temperatura correcta').removeClass('d-none');
        validate = false;
    }

    if(pesoKilogramos === ''){
        inputPesoKilogramos.addClass('is-invalid border-danger');
        inputPesoKilogramos.next().text('El campo es requerido').removeClass('d-none');
    }

    if(pesoKilogramos !== '' && !regexPesoKilogramos.test(pesoKilogramos)){
        inputPesoKilogramos.addClass('is-invalid border-danger');
        inputPesoKilogramos.next().text('No has ingresado un peso correcto').removeClass('d-none');
        validate = false;
    }

    if(frecuenciaRespiratoria === ''){
        inputFrecuenciaRespiratoria.addClass('is-invalid border-danger');
        inputFrecuenciaRespiratoria.next().text('El campo es requerido').removeClass('d-none');
        validate = false;
    }

    if(frecuenciaRespiratoria !== '' && !regexFrecuenciaRespiratoria.test(frecuenciaRespiratoria)){
        inputFrecuenciaRespiratoria.addClass('is-invalid border-danger');
        inputFrecuenciaRespiratoria.next().text('No has ingresado una frecuencia respiratoria correcta').removeClass('d-none');
        validate = false;
    }

    if(satPorcentaje === ''){
        inputSATporcentaje.addClass('is-invalid border-danger');
        inputSATporcentaje.next().text('El campo es requerido').removeClass('d-none');
        validate = false;
    }

    if(satPorcentaje !== '' && !regexPorcentaje.test(satPorcentaje)){
        inputSATporcentaje.addClass('is-invalid border-danger');
        inputSATporcentaje.next().text('No has ingresado un porcentaje correcto').removeClass('d-none');
        validate = false;
    }

    if(glucosa === ''){
        inputGlucosa.addClass('is-invalid border-danger');
        inputGlucosa.next().text('El campo es requerido').removeClass('d-none');
        validate = false;
    }

    if(glucosa !== '' && !regexGlucosa.test(glucosa)){
        inputGlucosa.addClass('is-invalid border-danger');
        inputGlucosa.next().text('No has ingresado una glucosa correcta').removeClass('d-none');
        validate = false;
    }

    if(talla === ''){
        inputTalla.addClass('is-invalid border-danger');
        inputTalla.next().text('El campo es requerido').removeClass('d-none');
        validate = false;
    }

    if(talla !== '' && !regexDecimal.test(talla)){
        inputTalla.addClass('is-invalid border-danger');
        inputTalla.next().text('No has ingresado una talla correcta').removeClass('d-none');
        validate = false;
    }
    

    return validate;

}


export const validateQuill = (dataQuill) => {

    let listWarnings = [];
    validate = true;

    const { reason,
        physical_exam,
        diagnosis,
        treatment } = dataQuill


    if(reason === '<p><br></p>'){
        listWarnings.push('Motivo de la consulta');
        validate = false;
    }

    if(physical_exam === '<p><br></p>'){
        listWarnings.push('Exploración física');
        validate = false;
    }

    if(diagnosis === '<p><br></p>'){
        listWarnings.push('Diagnóstico');
        validate = false;
    }

    if(treatment === '<p><br></p>'){
        listWarnings.push('Tratamiento');
        validate = false;
    }

    return {listWarnings, validate};
}