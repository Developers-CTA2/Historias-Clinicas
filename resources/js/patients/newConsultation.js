import Quill from 'quill';
import Tagify from '@yaireo/tagify'
import Swal from "sweetalert2/dist/sweetalert2.js";
import "quill/dist/quill.snow.css";
import '@yaireo/tagify/dist/tagify.css'
import "sweetalert2/src/sweetalert2.scss";

import {
    vitalSigns, options,
    getAllSpecificDiseases,
    AlertErrorConsultation,
    validateQuill, DomPurify,
    requestPostConsultation,
    AlertConfirmationForm,
    AlertCancelConfirmation,
    AlertSweetSuccess,
    AlertError
} from '../helpers';
import { templateArrayDiseases } from '../templates'
import { btnUpScreenFunction } from '../components';


let diagnosticLabels = [];
let dataDiseases = [];

// Configurar Tagify que permite agregar etiquetas de enfermedades
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
    btnCancelConsultation.on('click', function(){
        AlertCancelConfirmation('¿Estás seguro de cancelar la consulta?', 'La información no se guardará', '/patients')
    });

    // Button for save consultation
    btnSaveConsultation.on('click', function () {
        managementDataForRequest($(this).data('id'));
    });


    const managementDataForRequest = (idPatient) => {
        // Get all data from form
        const { dataVitalSigns, inputsDom, dataQuill, listDiseases } = getAllDataForm();

        // Validate form data
        if (!validateData(dataVitalSigns, inputsDom, dataQuill)) return;

        // Request for store consultation
        AlertConfirmationForm(
            '¿Estás seguro de guardar la consulta?', 
            'La información se guardará en el historial del paciente', 
            ()=> managementRequestForStoreConsultation(dataVitalSigns, dataQuill, listDiseases, idPatient)
        );

    }


    // Get all data from form
    const getAllDataForm = () => {
        return {
            dataVitalSigns: getDataVitalSigns(),
            inputsDom: getInputsDom(),
            dataQuill: getDataQuill(),
            listDiseases: getDiagnosticLabels()
        }
    }

    // Validate form data
    const validateData = (dataVitalSigns, inputsDom, dataQuill) => {

        let validateForm = true;

        // Validate vital signs
        if (!vitalSigns(dataVitalSigns, inputsDom)) {
            AlertError('Error', 'Existen campos sin llenar, por favor revisa la información antes de guardar la consulta');
            validateForm = false;
        }

        // Validate textAreas of quill
        const { listWarnings, validate } = validateQuill(dataQuill);
        if (!validate) {
            AlertErrorConsultation('Error..!', listWarnings);
            validateForm = false;
        }


        return validateForm;
    }

    // Request for store consultation
    const managementRequestForStoreConsultation = (dataVitalSigns, dataQuill, diagnosticLabels, idPatient) => {
        requestPostConsultation({ ...dataVitalSigns, ...dataQuill, diagnosticLabels }, idPatient)
            .then(data => {
                const { title, message, idConsultation } = data;
                console.log(data);
                AlertSweetSuccess(title, message, `/patients/consultation/${idPatient}/history/${idConsultation}/details`);
            }).catch(error => {
                console.log(error);
                const { title, message } = error;
                AlertError(title, message);
            });
    }





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