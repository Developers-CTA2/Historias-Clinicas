import Quill from 'quill';
import "quill/dist/quill.snow.css";
import { vitalSigns } from '../helpers';

import { options } from '../helpers';


$(function(){


    // Buttons
    const btnSaveConsultation = $('#saveConsultation');

    // Inputs
    const inputFrecuenciaCardiaca = $('#fcIpm');
    const inputPresionArterial = $('#taMMHg');
    const inputTemperatura = $('#tcCentrigrados');
    const inputPesoKilogramos = $('#pesoKilogramos');
    const inputFrecuenciaRespiratoria = $('#frRpm');
    const inputSATporcentaje = $('#satPorcentaje');
    const inputGlucosa = $('#glucosa');
    const inputTalla = $('#talla');

    // List vital signs 
    const listVitalSigns = $('.vitalSigns');

    // Quill Js
    const reasonQuill = new Quill('#reasonEditor', options('Escribe el motivo de la consulta'));
    const devicesQuill = new Quill('#devicesEditor',options('Escribe el motivo de la consulta'));
    const auxQuill = new Quill('#auxEditor',options('Escribe los auxiliares DX y TX previos'));

    const physicalExamQuill = new Quill('#physicalExamEditor',options('Escribe el examen físico'));
    const diagnosisQuill = new Quill('#diagnosisEditor',options('Escribe el diagnóstico'));
    const treatmentQuill = new Quill('#treatmentEditor',options('Escribe el tratamiento'));
    const observationsQuill = new Quill('#observationsEditor',options('Escribe las observaciones'));


    btnSaveConsultation.on('click', function(){
        
        const dataVitalSigns = getDataVitalSigns();
        const inputsDom = getInputsDom();
        const dataQuill = getDataQuill();

        if(!vitalSigns(dataVitalSigns, inputsDom)){
            console.log('No se puede guardar la consulta'); 
            return;
        }
      

        
    })


    const getDataVitalSigns = ()=>{

        return {
            frecuenciaCardiaca: inputFrecuenciaCardiaca.val(),
            presionArterial: inputPresionArterial.val(),
            temperatura: inputTemperatura.val(),
            pesoKilogramos: inputPesoKilogramos.val(),
            frecuenciaRespiratoria: inputFrecuenciaRespiratoria.val(),
            satPorcentaje: inputSATporcentaje.val(),
            glucosa: inputGlucosa.val(),
            talla: inputTalla.val()
        }
    }



    const getInputsDom = ()=>{
        return {
            inputFrecuenciaCardiaca,
            inputPresionArterial,
            inputTemperatura,
            inputPesoKilogramos,
            inputFrecuenciaRespiratoria,
            inputSATporcentaje,
            inputGlucosa,
            inputTalla,
            listVitalSigns
        }
    }

    const getDataQuill = ()=>{
        return {
            reason: reasonQuill.root.innerHTML,
            devices: devicesQuill.root.innerHTML,
            aux: auxQuill.root.innerHTML,
            physical_exam: physicalExamQuill.root.innerHTML,
            diagnosis: diagnosisQuill.root.innerHTML,
            treatment: treatmentQuill.root.innerHTML,
            observations: observationsQuill.root.innerHTML,
        }
    }


});