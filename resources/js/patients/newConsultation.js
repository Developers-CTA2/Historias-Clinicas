import Quill from 'quill';
import Tagify from '@yaireo/tagify'
import "quill/dist/quill.snow.css";
import '@yaireo/tagify/dist/tagify.css'

import {
    vitalSigns, options,
    getAllSpecificDiseases,
    AlertErrorConsultation,
    validateQuill, DomPurify,
    requestPostConsultation
} from '../helpers';
import { templateArrayDiseases } from '../templates'
import { btnUpScreenFunction } from '../components';
import { Swal } from 'sweetalert2/dist/sweetalert2';

let diagnosticLabels = [];
let dataDiseases = [];


const configTagify = () => {

    getAllSpecificDiseases().then(data => {

        const input = document.querySelector('#enfermedades'),

            // init Tagify script on the above inputs
            tagify = new Tagify(input, {
                enforceWhitelist: true,
                delimiters: null,
                whitelist: templateArrayDiseases(data),
                callbacks: {
                    add: function (e) {
                        diagnosticLabels.push({ id: e.detail.data.id });
                    },
                    remove: function (e) {
                        diagnosticLabels = diagnosticLabels.filter(disease => disease.id !== e.detail.data.id);
                    },
                },

            });
    });

};

const confirmationAlertCancel = () => {
    Swal.fire({
        title: '¿Estás seguro de cancelar la consulta?',
        text: "No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, cancelar!',
        cancelButtonText: 'No, seguir aquí!'
    }).then((result) => {
        if (result.isConfirmed) {
            location.href = '/patients';
        }
    })
}



$(function () {

    configTagify();


    // Buttons
    const btnSaveConsultation = $('#saveConsultation');
    const btnCancelConsultation = $('#cancelConsultation');

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
    const auxQuill = new Quill('#auxEditor', options('Escribe los auxiliares DX y TX previos'));

    const physicalExamQuill = new Quill('#physicalExamEditor', options('Escribe el examen físico'));
    const diagnosisQuill = new Quill('#diagnosisEditor', options('Escribe el diagnóstico'));
    const treatmentQuill = new Quill('#treatmentEditor', options('Escribe el tratamiento'));
    const observationsQuill = new Quill('#observationsEditor', options('Escribe las observaciones'));

    // Active button for up screen
    btnUpScreenFunction();

    // Button for cancel consultation
    btnCancelConsultation.on('click', function () {
        confirmationAlertCancel();
    })

    btnSaveConsultation.on('click', function () {

        const dataVitalSigns = getDataVitalSigns();
        const inputsDom = getInputsDom();
        const dataQuill = getDataQuill();
        const listDiseases = getDiagnosticLabels();

        if (!vitalSigns(dataVitalSigns, inputsDom)) {
            return;
        }

        const { listWarnings, validate } = validateQuill(dataQuill);
        if (!validate) {
            AlertErrorConsultation('Error..!', listWarnings);
            return;
        }



        const id_person = $(this).data('id');
        requestPostConsultation({ ...dataVitalSigns, ...dataQuill, diagnosticLabels: listDiseases }, id_person)
            .then(data => {
                Swal.fire({
                    title: 'Consulta guardada',
                    text: 'La consulta ha sido guardada con éxito',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    location.href = '/patients';
                });
            }).catch(error => {
                console.log(error);
            })


    })





    const getDataVitalSigns = () => {

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



    const getInputsDom = () => {
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

    const getDataQuill = () => {
        return {
            reason: DomPurify(reasonQuill.root.innerHTML),
            aux: DomPurify(auxQuill.root.innerHTML),
            physical_exam: DomPurify(physicalExamQuill.root.innerHTML),
            diagnosis: DomPurify(diagnosisQuill.root.innerHTML),
            treatment: DomPurify(treatmentQuill.root.innerHTML),
            observations: DomPurify(observationsQuill.root.innerHTML)
        }
    }

    const getDiagnosticLabels = () => {
        return diagnosticLabels.map(disease => disease.id);
    }











});