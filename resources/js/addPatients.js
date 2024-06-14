import { getPerson } from './helpers/request-get-person.js';
import { iconCompleted, iconBlocked } from './templates/iconsTemplate.js'
import { validateStepFormOne, validateStepFormFive } from './helpers/validateDataAddPatient.js';
import { selectDynamicSpecificDisease, getListDiseases, selectDynamicDrugAddiction, getListDrugAddiction, pathologicalHistory, getListPathologicalHistory } from './components';
import { requestSavePatient } from './helpers';


const patientData = {
    code: '',
    name: '',
    career: '',
    gender: null,
    birthdate: '',
    bloodType: null,
    phone: '',
    nss: '',
    civilStatus: null,
    religion: '',
    dependency: '',
    state: '',
    city: '',
    street: '',
    number: '',
    intNumber: '',
    emergencyName: '',
    emergencyPhone: '',
    relationship: '',
    listHereditaryFamilialDiseases: [],
    listDrugAddiction: [],
    listPathologicalHistory: [],
    listGynecologyObstetrics:
    {
        menarca: '',
        fum: '',
        numGestas: '',
        numPartos: '',
        numCerareas: '',
        numAbortos: '',
        diasSangrado: '',
        diasCiclo: '',
        fechaCitologia: '',
        mastografia: '',
        inicioVidaSexual: '',
        metodoDescriptivo: '',
        estaEmbarazada: false,
        cicloRegular: false,
        cicloIrregular: false
    }


}

let steps = 0;
let activeSendButton = false;


$(function () {

    // Buttons
    const btnCardUdgPerson = $('#udgPerson');
    const btnCardexternalPerson = $('#externalPerson');
    const btnNextPersonUdg = $('#nextPersonUdg');
    const btnPrevStep = $('#prevStep');
    const btnNextStep = $('#nextStep');
    const btnExternalPerson = $('#externalPerson');
    const btnSendForm = $('#sendForm');

    // Containers
    const containerUdgPerson = $('#containerUdgPerson');
    const containerFatherForm = $('#containerFatherForm');
    const containerDataPerson = $('#containerDataPerson');
    const containerPersonSelect = $('#containerPersonSelect');


    // Form Steps
    const formSteps = $('.form-step');
    const stepCicles = $('.step-circle');


    // Event listeners
    btnCardUdgPerson.off('click');
    btnCardUdgPerson.on('click', function () {
        containerUdgPerson.removeClass('d-none');
    });


    // Inputs
    const inputCode = $('#code');
    // PD = Person Data
    const allInputsPD = $('.group-custom');
    const inputCodePD = $('#codigo')
    const inputNamePD = $('#name_P');
    const inputCareerPD = $('#Puesto');
    const inputBirthDate = $('#F_nacimiento');
    const inputState = $('#estado');
    const inputCity = $('#ciudad');
    const inputStreet = $('#calle');
    const inputNumber = $('#num');
    const inputIntNumber = $('#num_int');
    const inputPhone = $('#telefono');
    const inputNss = $('#nss');
    const inputReligion = $('#religion');
    const inputDependency = $('#Puesto');
    const inputEmergencyName = $('#nombre_e');
    const inputEmergencyPhone = $('#telefono_e');
    const inputRelationship = $('#parentesco');

    // Selects 
    const selectGender = $('#gender');
    const selectBloodType = $('#T_sangre');
    const selectCivilStatus = $('#E_civil');


    /* Disease */
    // Selects 
    const selectDisease = $('#enfermedad');

    // List 
    const ulListDiseases = $('#listDiseasesSelected');


    /* Drug Addiction */
    // Selects
    const selectDrugAddiction = $('#toxico');
    const inputNumberOfCigarettes = $('#cantidadCigarros');
    const inputHowDateSmoking = $('#desdeCuandoFuma');
    const inputHowOtherDrugs = $('#desdeCuandoOtros');
    const descriptionOtherDrugs = $('#descripcionOtros');

    // Containers
    const contaienerOptionSmoking = $('#optionSmoking');
    const containerOptionOthers = $('#optionOthersDrugAddiction');

    // List 
    const accordionListDrugAddiction = $('#listDrugAddictionSelected');

    // Buttons 
    const btnAddDrugAddiction = $('#addDrugAddiction');


    /* Pathological History | Atecentedes patologicos */

    const inputHospitalizations = $('#fecha_H');
    const inputSurgeries = $('#fecha_C');
    const inputTraumatism = $('#fecha_TF');
    const inputTransfusions = $('#fecha_TU');


    // Selects 
    const selectDiseasePersonal = $('#enfermedadPersonal');
    const selectAllergies = $('#alergias');

    // Textarea
    const descriptionAllergies = $('#descripcionAlergias');
    const descriptionHospitalizationsReason = $('#motivo_H');
    const descriptionSurgeriesReason = $('#motivo_C');
    const descriptionTraumatismReason = $('#motivo_TF');
    const descriptionTransfusionsReason = $('#motivo_TU');


    // Buttons 
    const btnAddPathological = $('#addAntecedentesPatologicos');

    // Containers 
    const buttonAccordionCollapse = $('.accordion-button');
    const accordionListPathologicalHistory = $('#listPathologicalHistory');




    /* Gynecology and Obstetrics | Ginecología y Obstetricia */

    const inputMenarca = $('#menarca');
    const inputFum = $('#fechaUltimaMenstruacion');
    const inputGestas = $('#numGestas');
    const inputPartos = $('#numPartos');
    const inputCesareas = $('#numCesareas');
    const inputAbortos = $('#numAbortos');
    const inputDiasSangrado = $('#diasSangrado');
    const inputDiasCiclo = $('#diasCiclo');
    const inputfechaCitologia = $('#fechaCitologia');
    const inputMastografia = $('#mastografia');
    const inputInicioVidaSexual = $('#inicioVidaSexual');

    // Textarea
    const textMetodoDescriptivo = $('#metodoDescripcion');

    // Checkboxes
    const checkEstaEmbarazada = $('#tieneEmbarazo');

    // Radio
    const radioCicloRegular = $('#cicloRegular');
    const radioCicloIrregular = $('#cicloIrregular');

    // Containers
    const formGynecologyObstetrics = $('.group-gyo');

    

    selectDisease.select2({
        theme: 'bootstrap-5',
        selectionCssClass: "select2--base",
        dropdownCssClass: "select2--base",
        width: '100%',
    });

    selectDiseasePersonal.select2({
        theme: 'bootstrap-5',
        selectionCssClass: "select2--base",
        dropdownCssClass: "select2--base",
        width: '100%',
    })

    selectAllergies.select2({
        theme: 'bootstrap-5',
        selectionCssClass: "select2--base",
        dropdownCssClass: "select2--base",
        width: '100%',
    });

    // Auxiliars
    let prevCode = '';

    /* Alert */
    const alertCodePerson = $('#alertCodePerson');

    // Templates
    const namePerson = $('#namePerson');
    const careerPerson = $('#careerPerson');



    btnCardexternalPerson.off('click');
    btnCardexternalPerson.on('click', function () {
        containerUdgPerson.addClass('d-none');
    });

    inputCode.on('keydown', function (e) {

        // Solo se ejecuta si da enter
        if (e.keyCode != 13) {
            return;
        }

        const valueCode = $(this).val();



        if (prevCode == valueCode) return;

        prevCode = valueCode;

        if (valueCode.length !== 7 && valueCode.length !== 9) {
            alertCodePerson.text('La estructura es incorrecta, el código debe ser de 7 o 9 números.').addClass('alert-danger').removeClass('d-none');
            $(this).addClass('border-danger');
        }

        // Remove alert class and border danger
        alertCodePerson.removeClass('alert-danger alert-info').addClass('d-none');
        $(this).removeClass('border-danger');
        containerDataPerson.addClass('d-none');

        // Empty code
        patientData.code = '';
        patientData.name = '';
        patientData.career = '';

        // Request for get person data
        getPerson({ code: valueCode }).then((data) => {

            const { Codigo, Nombre, Carrera } = data;

            console.log(data);
            patientData.code = Codigo;
            patientData.name = Nombre;
            patientData.career = Carrera;
            namePerson.text(Nombre);
            careerPerson.text(Carrera);

            console.log(patientData);

            containerDataPerson.removeClass('d-none');


        }).catch((error) => {
            const { message, status } = error;
            console.log(error);
            alertCodePerson.text(message.message);
            status == 404 ? alertCodePerson.addClass('alert-info') : alertCodePerson.addClass('alert-danger');
            alertCodePerson.removeClass('d-none');
        })

    });

    // Next for step 2
    btnNextPersonUdg.on('click', function () {

        containerPersonSelect.addClass('d-none');
        if (patientData.code !== '') {
            inputCodePD.val(patientData.code).attr('disabled', true);
            inputNamePD.val(patientData.name).attr('disabled', true);
            inputCareerPD.val(patientData.career).attr('disabled', true);

            containerFatherForm.removeClass('d-none');
            formSteps.first().removeClass('d-none');
            stepCicles.first().addClass('active');

            steps = 1;
        }
    });

    btnExternalPerson.on('click', function () {
        containerPersonSelect.addClass('d-none');

        inputCodePD.val('').attr('disabled', false);
        inputNamePD.val('').attr('disabled', false);
        inputCareerPD.val('').attr('disabled', false);

        containerFatherForm.removeClass('d-none');
        formSteps.first().removeClass('d-none');
        stepCicles.first().addClass('active');

        steps = 1;
    });


    /* Buttons for step form */
    btnPrevStep.on('click', function () {

        stepCicles.eq(steps - 1).removeClass('active');
        stepCicles.eq(steps - 1).removeClass('completed');

        !btnSendForm.hasClass('d-none') && btnSendForm.addClass('d-none');
        btnNextStep.hasClass('d-none') && btnNextStep.removeClass('d-none');

        if (steps < 0) steps = 0;

        steps--;

        if (steps == 0) {
            containerPersonSelect.removeClass('d-none');
            containerFatherForm.addClass('d-none');
        }

        formSteps.each(function () {
            $(this).addClass('d-none');
        });

        if (steps > 0) {
            formSteps.eq(steps - 1).removeClass('d-none');
            stepCicles.eq(steps - 1).removeClass('completed');
        };

    });

    btnNextStep.on('click', function () {

        // Validate if the form is complete
        if (steps == 1) {
            const elements = getDataFirstStep();
            getDataFirstStepValues();

            if(!validateStepFormOne(patientData, elements)) return;

            console.log('Validado');


        }

        if (steps == 5) {
            const elements = getDomGynecologyObstetrics();
            const values = getDataFiveStepValues();
            if (!validateStepFormFive(values, elements)) return;

        }



        if (((formSteps.length - 1) == steps && patientData.gender == 1) || formSteps.length == steps && patientData.gender == 2) {
            btnSendForm.removeClass('d-none');
            btnNextStep.addClass('d-none');
            sendDataForm();
            return;
        }

        steps++;


        if (steps > formSteps.length) steps = formSteps.length;

        if (steps > 0) {
            stepCicles.eq(steps - 1).addClass('active');
            stepCicles.eq(steps - 2).addClass('completed');
        };


        formSteps.each(function () {
            $(this).addClass('d-none');
        });

        formSteps.eq(steps - 1).removeClass('d-none');

        if (((formSteps.length - 1) == steps && patientData.gender == 1) || formSteps.length == steps && patientData.gender == 2) {
            btnSendForm.removeClass('d-none');
            btnNextStep.addClass('d-none');
            sendDataForm();

        }

        console.log(patientData);


    });


    selectGender.off('change');
    selectGender.on('change', function () {
        patientData.gender = $(this).val();
        if ($(this).val() == 1) {
            stepCicles.last().html(iconBlocked).addClass('blocked')
        } else {
            stepCicles.last().html(iconCompleted).removeClass('blocked');
        }
    });

    const sendDataForm = () => {
        btnSendForm.off('click');
        btnSendForm.on('click', function () {

            getAllDataForm();
            console.log(patientData);
            
            // requestSavePatient(patientData).then((data)=>{
            //     console.log(data);
            // }).catch((error)=>{
            //     console.log(error);
            // })

        });
    }


    const getAllDataForm = ()=>{
        insertDataGynecologyObstetrics();
        patientData.listPathologicalHistory = getListPathologicalHistory();
        patientData.listDrugAddiction = getListDrugAddiction();
        patientData.listHereditaryFamilialDiseases = getListDiseases();
    }


    /* llamada a la función para obtener los datos de las enfermedades dinamicamente */
    selectDynamicSpecificDisease(selectDisease, ulListDiseases);
    // Se maneja la lógica de la selección de enfermedades
    selectDynamicDrugAddiction({ selectDrugAddiction, inputNumberOfCigarettes, inputHowDateSmoking, inputHowOtherDrugs, descriptionOtherDrugs, contaienerOptionSmoking, containerOptionOthers, accordionListDrugAddiction, btnAddDrugAddiction });
    // Se maneja la lógica de los antecedentes patológicos
    pathologicalHistory({
        inputHospitalizations,
        inputSurgeries,
        inputTraumatism,
        inputTransfusions,
        descriptionHospitalizationsReason,
        descriptionSurgeriesReason,
        descriptionTraumatismReason,
        descriptionTransfusionsReason,
        btnAddPathological,
        buttonAccordionCollapse,
        selectAllergies,
        selectDiseasePersonal,
        descriptionAllergies,
        accordionListPathologicalHistory
    });


    // Get data for first step
    const getDataFirstStep = () => {

        return {
            allInputsPD,
            inputCodePD,
            inputNamePD,
            inputCareerPD,
            selectGender,
            selectBloodType,
            inputBirthDate,
            inputState,
            inputCity,
            inputStreet,
            inputNumber,
            inputIntNumber,
            inputPhone,
            inputNss,
            selectCivilStatus,
            inputReligion,
            inputDependency,
            inputEmergencyName,
            inputEmergencyPhone,
            inputRelationship,
            accordionListPathologicalHistory
        }
    }

    const getDataFirstStepValues = () => {

        patientData.code = inputCodePD.val();
        patientData.name = inputNamePD.val();
        patientData.career = inputCareerPD.val();
        patientData.gender = selectGender.val();
        patientData.birthdate = inputBirthDate.val();
        patientData.bloodType = selectBloodType.val();
        patientData.phone = inputPhone.val();
        patientData.nss = inputNss.val();
        patientData.civilStatus = selectCivilStatus.val();
        patientData.religion = inputReligion.val();
        patientData.dependency = inputDependency.val();
        patientData.state = inputState.val();
        patientData.city = inputCity.val();
        patientData.street = inputStreet.val();
        patientData.number = inputNumber.val();
        patientData.intNumber = inputIntNumber.val();
        patientData.emergencyName = inputEmergencyName.val();
        patientData.emergencyPhone = inputEmergencyPhone.val();
        patientData.relationship = inputRelationship.val();
    }

    // Get data for gynecology and obstetrics
    // If is a female
    const getDataFiveStepValues = () => {
        return {
            menarca: inputMenarca.val(),
            fum: inputFum.val(),
            numGestas: inputGestas.val(),
            numPartos: inputPartos.val(),
            numCerareas: inputCesareas.val(),
            numAbortos: inputAbortos.val(),
            diasSangrado: inputDiasSangrado.val(),
            diasCiclo: inputDiasCiclo.val(),
            fechaCitologia: inputfechaCitologia.val(),
            mastografia: inputMastografia.val(),
            inicioVidaSexual: inputInicioVidaSexual.val(),
            metodoDescriptivo: textMetodoDescriptivo.val(),
            estaEmbarazada: checkEstaEmbarazada.prop('checked'),
            cicloRegular: radioCicloRegular.prop('checked'),
            cicloIrregular: radioCicloIrregular.prop('checked')
        }

    }

    const insertDataGynecologyObstetrics = () => {
        patientData.listGynecologyObstetrics = {
            menarca: inputMenarca.val(),
            fum: inputFum.val(),
            numGestas: inputGestas.val(),
            numPartos: inputPartos.val(),
            numCerareas: inputCesareas.val(),
            numAbortos: inputAbortos.val(),
            diasSangrado: inputDiasSangrado.val(),
            diasCiclo: inputDiasCiclo.val(),
            fechaCitologia: inputfechaCitologia.val(),
            mastografia: inputMastografia.val(),
            inicioVidaSexual: inputInicioVidaSexual.val(),
            metodoDescriptivo: textMetodoDescriptivo.val(),
            estaEmbarazada: checkEstaEmbarazada.prop('checked'),
            cicloRegular: radioCicloRegular.prop('checked'),
            cicloIrregular: radioCicloIrregular.prop('checked')
        }
    }


    const getDomGynecologyObstetrics = () => {
        return {
            inputMenarca,
            inputFum,
            inputGestas,
            inputPartos,
            inputCesareas,
            inputAbortos,
            inputDiasSangrado,
            inputDiasCiclo,
            inputfechaCitologia,
            inputMastografia,
            inputInicioVidaSexual,
            textMetodoDescriptivo,
            checkEstaEmbarazada,
            radioCicloRegular,
            radioCicloIrregular,
            formGynecologyObstetrics
        }
    }















});

