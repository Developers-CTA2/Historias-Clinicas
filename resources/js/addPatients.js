import { iconCompleted, iconBlocked } from './templates/iconsTemplate.js'
import {calculateNumGestas, selectDynamicSpecificDisease, getListDiseases, selectDynamicDrugAddiction, getListDrugAddiction, pathologicalHistory, getListPathologicalHistory } from './components';
import {validateStepFormOne, validateStepFormFive, getPerson, requestSavePatient, AlertSweetSuccess, AlertError, AlertErrorWithHTML, AlertCancelConfirmation, AlertConfirmationForm } from './helpers'
import { templateErrorItem, templateErrorList } from './templates/addPatientsTemplate.js';


const patientData = {
    type: '',
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
    colony: '',
    cp: '',
    street: '',
    number: '',
    intNumber: null,
    scholarship: '',
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
        numCesareas: '',
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
let typePerson = null;
let templateErrors = '';
let loadingCalculateNumGestas = false;


$(function () {

    // Buttons
    const btnCardUdgPerson = $('#udgPerson');
    const btnCardexternalPerson = $('#externalPerson');
    const btnNextPersonUdg = $('#nextPersonUdg');
    const btnSearchCode = $('#searchCode');
    const btnPrevStep = $('#prevStep');
    const btnNextStep = $('#nextStep');
    const btnSendForm = $('#sendForm');

    // Containers
    const containerUdgPerson = $('#containerUdgPerson');
    const containerFatherForm = $('#containerFatherForm');
    const containerDataPerson = $('#containerDataPerson');
    const containerPersonSelect = $('#containerPersonSelect');


    // Form Steps
    const formSteps = $('.form-step');
    const stepCicles = $('.step-circle');


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
    const inputColony = $('#colonia');
    const inputCp = $('#cp');
    const inputNumber = $('#num');
    const inputIntNumber = $('#num_int');
    const inputPhone = $('#telefono');
    const inputScholarship = $('#escolaridad');
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
    const btnCancelRegister = $('#cancel');
    const btnTabsPersonalData = $('.tapsPersonalData')

    // Containers 
    const btnNavItem = $('.list-btn-nav');
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


    // Button error list
    const btnErrorList = $('#errorList');


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
        width: '90%',
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

    


    // Event listeners
    // Event listeners for cancel register patient
    btnCancelRegister.on('click', function () {
        AlertCancelConfirmation('¿Estás seguro de cancelar el registro?', 'No podrás recuperar la información ingresada', '/patients');
    });

    // Event for show button if the last tap is selected
    btnTabsPersonalData.on('click', function () {

        // If the last tap is selected, the button is displayed
        if(btnTabsPersonalData.last().hasClass('active')){
            btnNextStep.removeClass('disabled-custom').attr('disabled', false);
            return;
        }


        // If the last tap is not selected, the button is hidden
        btnNextStep.addClass('disabled-custom').attr('disabled', true);
        

    })


    inputCode.on('keydown', function (e) {

        // Solo se ejecuta si da enter
        if (e.keyCode != 13) {
            return;
        }

        const valueCode = $(this).val().trim();
        if (prevCode == valueCode) return;

        prevCode = valueCode;

        if (!isValidateCodeLength(valueCode)) {
            showAlertError('La estructura es incorrecta, el código debe ser de 7 o 9 números.', 'alert-danger');
            $(this).addClass('border-danger');

            return;
        }

        // Reset alert and data if the code is different
        resetAlertAndData();
        // Get type person for code, if student or worker
        typePerson = getTypePerson(valueCode);

        console.log('Hola aqui');
        // Request for get person data
        getPerson({ code: valueCode, type: typePerson, person : 'patient' }).then(handlePersonData).catch(handleError)

    });

    // Search code for people who belong to the UDG
    btnSearchCode.on('click', function () {

        // Get code of input
        const valueCode = inputCode.val().trim();

        // If the code is the same as the previous one, it does not execute
        if (prevCode == valueCode) return;

        // Save the previous code
        prevCode = valueCode;

        // Validate the length of the code
        if (!isValidateCodeLength(valueCode)) {
            showAlertError('La estructura es incorrecta, el código debe ser de 7 o 9 números.', 'alert-danger');
            inputCode.addClass('border-danger');
            return;
        }

        // Reset alert and data
        resetAlertAndData();
        // Get type person for code, if student or worker
        typePerson = getTypePerson(valueCode);

        // Request for get person data
        getPerson({ code: valueCode, type: typePerson, person : 'patient' }).then(handlePersonData).catch(handleError)
    })


    /* Logic for handling a person belonging to the UDG */
    const isValidateCodeLength = (code) => code.length == 7 || code.length == 9;



    // Reset alert and data of UI container
    const resetAlertAndData = () => {
        // Remove alert class and border danger
        alertCodePerson.removeClass('alert-danger alert-info').addClass('d-none');
        inputCode.removeClass('border-danger');
        containerDataPerson.addClass('d-none');

        // Empty code
        patientData.code = '';
        patientData.name = '';
        patientData.career = '';
        patientData.gender = null;
        patientData.birthdate = '';
        patientData.scholarship = null;

        // Reset inputs and selects
        inputCodePD.val('').attr('disabled', false);
        inputNamePD.val('').attr('disabled', false);
        inputCareerPD.val('').attr('disabled', false);
        selectGender.val('').attr('disabled', false);
        inputScholarship.val('').attr('disabled', false);
        inputBirthDate.val('').attr('disabled', false);


        typePerson = null;
    }

    // Get person Worker or Student
    const getTypePerson = (code) => code.length == 7 ? 1 : 2;

    // Handle data person if code is worker, get data for worker and if code is student, get data for student
    const handlePersonData = ({ data }) => {
        
        if (typePerson == 1) {
            const { codigo, nombramiento, nombre, fecha_nacimiento, sexo, ultimo_grado } = data.worker;

            // Format for include inputs
            const adicionalData = formatToId(sexo, ultimo_grado, fecha_nacimiento);
            // Set data person template
            setPersonData(codigo, nombre, nombramiento, adicionalData);

        } else {
            const { codigo, carrera, nombre } = data.student;
            setPersonData(codigo, nombre, carrera);
        }

    }

    // Set data person of object patientData
    const setPersonData = (code, name, dependency, adicionalData = {}) => {
        patientData.code = code;
        patientData.name = name;
        patientData.career = dependency;


        // If the person is a worker, save the data
        if (adicionalData.sexo) {
            const { sexo, grado, fecha_nacimiento } = adicionalData;
            patientData.gender = sexo;
            patientData.scholarship = grado;
            patientData.birthdate = fecha_nacimiento;
        }

        // Update UI with data person
        updateUI(name, dependency);
    }

    // Convert Id to format for sex and grade of person
    const formatToId = (sexo, grado, fecha_nacimiento) => {

        let sexoId = null;
        let gradoId = null;

        switch (sexo) {
            case 'Masculino':
                sexoId = 1;
                break;
            case 'Femenino':
                sexoId = 2;
                break;
            default:
                sexoId = null;
                break;
        }

        switch (grado) {
            case 'Primaria':
                gradoId = 2;
                break;
            case 'Secundaria':
                gradoId = 3;
                break;
            case 'Preparatoria':
                gradoId = 4;
                break;
            case 'Licenciatura/Ingeniería':
                gradoId = 5;
                break;
            case 'Maestría':
                gradoId = 6;
                break;
            case 'Doctorado':
                gradoId = 7;
                break;
            default:
                gradoId = null;
                break;
        }

        return {
            sexo: sexoId,
            grado: gradoId,
            fecha_nacimiento
        }

    }

    // Update UI with data person
    const updateUI = (name, dependency) => {
        namePerson.text(name);
        careerPerson.text(dependency);
        containerDataPerson.removeClass('d-none');
    }

    // Update UI with data person for the personal data form
    const updateUIFormPersonData = () => {

        // If the person is a worker
        if (patientData.gender) {
            selectGender.val(patientData.gender).trigger('change');
            inputScholarship.val(patientData.scholarship).trigger('change');
            inputBirthDate.val(patientData.birthdate);

            disabledInputOtherData();
        }

        // Send data to inputs
        inputCodePD.val(patientData.code);
        inputNamePD.val(patientData.name);
        inputCareerPD.val(patientData.career);

        disabledInputPersonalData();

        // Show form for person data
        containerFatherForm.removeClass('d-none');
    }

    // Reset container for person data of the UDG
    const resetContainerUdgPerson = () => { 
        containerUdgPerson.addClass('d-none');    
        containerDataPerson.addClass('d-none');
        namePerson.text('-');
        careerPerson.text('-');
        prevCode = '';
        inputCode.val('');
    }


    // Disabled inputs for personal data
    const disabledInputPersonalData = (disabledVal = true) => {
        inputCodePD.attr('disabled', true);
        inputNamePD.val(patientData.name).attr('disabled', disabledVal);
        inputCareerPD.val(patientData.career).attr('disabled', disabledVal);
    }

    // Disabled inputs for other data
    const disabledInputOtherData = (disabledVal = true) => {
        selectGender.attr('disabled', disabledVal);
        inputScholarship.attr('disabled', disabledVal);
        inputBirthDate.attr('disabled', disabledVal);
    }

    // Clear input for personal data, if the person is external o UDG
    const clearInputPersonalData = () => {
        inputCodePD.val('');
        inputNamePD.val('');
        inputCareerPD.val('');
    }

    // Clear input for other data, if the person is external o UDG
    const clearInputOtherData = () => {
        selectGender.val('').trigger('change');
        inputScholarship.val('').trigger('change');
        inputBirthDate.val('');
    }

    // Handle error for request person
    const handleError = (error) => {
        const { message, status } = error;

        console.log(error);
        
        let messageForAlert = '';

        if(status == 404 ){
            messageForAlert = message.msg || 'Ha sucedido un error al obtener los datos de la persona, por favor intenta de nuevo.'
        }else if(status == 400){
            messageForAlert = message.msg || 'El paciente ya se encuentra registrado.';
        }else{
            messageForAlert = message.error?.data?.message || 'Ha sucedido un error al obtener los datos de la persona, por favor intenta de nuevo.';
        }
        
        let alertClass = status == 404 || message.error?.status == 400 ? 'alert-info' : 'alert-danger'
        showAlertError(messageForAlert , alertClass);
        namePerson.text('-');
        careerPerson.text('-');
    };

    const showAlertError = (message, alertClass) => {
        alertCodePerson.text(message)
            .addClass(alertClass)
            .removeClass('d-none');
    }


    // Next for step 2
    btnNextPersonUdg.on('click', function () {

        containerPersonSelect.addClass('d-none');
        if (patientData.code !== '') {

            updateUIFormPersonData();
            resetContainerUdgPerson();

            // Show form for personal data
            formSteps.first().removeClass('d-none');
            stepCicles.first().addClass('active');

            // Set type person
            patientData.type = 'udg';

            // Insert focus
            setTimeout(() => {
                inputNamePD.focus(); 
            }, 1000);

            steps = 1;
        }
    });

    // Event listeners
    // If the person is from the UDG, the form is displayed
    btnCardUdgPerson.off('click');
    btnCardUdgPerson.on('click', function () {
        containerUdgPerson.removeClass('d-none');
    });

    // If the person is external, the form is displayed
    btnCardexternalPerson.on('click', function () {
        containerUdgPerson.addClass('d-none');
        containerPersonSelect.addClass('d-none');

        // Reset alert and data
        disabledInputPersonalData(false);
        clearInputPersonalData();
        disabledInputOtherData(false);
        clearInputOtherData();

        // Show form for personal data
        containerFatherForm.removeClass('d-none');
        formSteps.first().removeClass('d-none');
        stepCicles.first().addClass('active');

        // Set type person
        patientData.type = 'external';

        // Insert focus
        setTimeout(() => {
            inputNamePD.focus();
        }, 1000);

        steps = 1;
    });


    /* Buttons for step form */
    btnPrevStep.on('click', function () {

        // Validate if the form is complete
        stepCicles.eq(steps - 1).removeClass('active');
        stepCicles.eq(steps - 1).removeClass('completed');

        !btnSendForm.hasClass('d-none') && btnSendForm.addClass('d-none');
        btnNextStep.hasClass('d-none') && btnNextStep.removeClass('d-none');

        // If the steps are less than 0, it is set to 0
        if (steps < 0) steps = 0;

        steps--;

        // If the step is equal to 0, the form is displayed to select the person
        if (steps == 0) {
            AlertConfirmationForm('¿Estás seguro de regresar?', 'Posiblemente la información ingresada se pierda', activeFormPersonSelect);
            return;
        }

        // Hide all forms
        formSteps.each(function () {
            $(this).addClass('d-none');
        });

        // Show the form according to the step
        if (steps > 0) {
            formSteps.eq(steps - 1).removeClass('d-none');
            stepCicles.eq(steps - 1).removeClass('completed');
        };

        

    });

    const activeFormPersonSelect = () => {
        console.log('Hola');
        containerPersonSelect.removeClass('d-none');
        containerFatherForm.addClass('d-none');
    }

    btnNextStep.on('click', function () {

        // Validate if the form is complete
        if (steps == 1) {
            // Get data for first step, personal data form
            // Elements of DOM
            const elements = getDataFirstStep();
            // Values of formp
            getDataFirstStepValues();

            // Validate form, personal data
            if (!validateStepFormOne(patientData, elements)) return;
        }

        // Validate if the form is complete
        if (((formSteps.length - 1) == steps && patientData.gender == 1) || formSteps.length == steps && patientData.gender == 2) {
            btnSendForm.removeClass('d-none');
            btnNextStep.addClass('d-none');
            sendDataForm();
            return;
        }

        steps++;


        // if the steps are greater than the length of the form, it is set to the length of the form
        if (steps > formSteps.length) steps = formSteps.length;

        // Add class active to step circle
        if (steps > 0) {
            stepCicles.eq(steps - 1).addClass('active');
            stepCicles.eq(steps - 2).addClass('completed');
        };


        // Hide all forms
        formSteps.each(function () {
            $(this).addClass('d-none');
        });

        // Show the form according to the step
        formSteps.eq(steps - 1).removeClass('d-none');

        // If the form is complete, the button is displayed to send the form
        if (((formSteps.length - 1) == steps && patientData.gender == 1) || formSteps.length == steps && patientData.gender == 2) {
            btnSendForm.removeClass('d-none');
            btnNextStep.addClass('d-none');
            sendDataForm();

        }


    });


    // Event listeners for select 
    selectGender.off('change');
    selectGender.on('change', function () {
        // Save data
        patientData.gender = $(this).val();

        // If this val is equal to 1, the form is displayed for step 5
        if ($(this).val() == 1) {
            stepCicles.last().html(iconBlocked).addClass('blocked')
        } else {
            // If this val is equal to 2, the form is displayed for step 5
            stepCicles.last().html(iconCompleted).removeClass('blocked');
            // Load calculateNumGestas
            if(!loadingCalculateNumGestas){
                calculateNumGestas({inputNumPartos : inputPartos, inputNumCesareas : inputCesareas , inputNumAbortos : inputAbortos }, inputGestas);
                loadingCalculateNumGestas = true;
            }
            
        }
    });

    // Event listeners for show errors of the all form
    btnErrorList.on('click', function () {
        templateErrors !== '' && AlertErrorWithHTML('Lista de errores', templateErrors);
    })

    // Send data form
    const sendDataForm = () => {
        btnSendForm.off('click');
        btnSendForm.on('click', function () {

            // Management request for store patient
            managementRequestForStorePatient();
        });
    }

    

    const managementRequestForStorePatient = () => {

        // Validate if the form is complete for gynecology and obstetrics
        if (!validateGynecologyObstetrics()) return;

        // Get all data form
        getAllDataForm();

        // Show alert for confirmation
        AlertConfirmationForm('¿Estás seguro de guardar los datos?','', managementRequestStore);
        
    }

    // Validate if the form is complete for gynecology and obstetrics
    const validateGynecologyObstetrics = () => {
        if (steps == 5) {
            const elements = getDomGynecologyObstetrics();
            const values = getDataFiveStepValues();
            if (!validateStepFormFive(values, elements)) return false;

        }

        return true;
    }


    // Request for save patient
    const managementRequestStore = () => {
        // Request for save patient
        requestSavePatient(patientData).then((data) => {
            const { title, message } = data;
            AlertSweetSuccess(title, message);

        }).catch((error) => {
            // If there is an error
            console.log(error);
            const { errorList, message } = error;

            // If there are errors in the form
            if (errorList) {

                // Show alert for errors
                AlertError('Oops', 'Hubo un error al guardar los datos, por favor corrige estos errores, puedes verificarlos al presionar el botón "Errores", este se encuentra en la parte superior derecha.');

                templateErrors = '';
                for (const [key, messages] of Object.entries(errorList)) {
                    templateErrors += templateErrorItem(messages[0]);
                }

                templateErrors = templateErrorList(templateErrors);
                btnErrorList.removeClass('d-none');

                return;
            }

            AlertError(message.title, message.message);

        });
    }


    // Get all data for the form 
    const getAllDataForm = () => {
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
        btnNavItem,
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
            inputColony,
            inputCp,
            inputStreet,
            inputNumber,
            inputIntNumber,
            inputPhone,
            inputNss,
            inputScholarship,
            selectCivilStatus,
            inputReligion,
            inputDependency,
            inputEmergencyName,
            inputEmergencyPhone,
            inputRelationship,
            accordionListPathologicalHistory
        }
    }

    // Get personal data for first step form
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
        patientData.colony = inputColony.val();
        patientData.cp = inputCp.val();
        patientData.street = inputStreet.val();
        patientData.number = inputNumber.val();
        patientData.intNumber = inputIntNumber.val();
        patientData.scholarship = inputScholarship.val();
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
            numCesareas: inputCesareas.val(),
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
    

    // Insert data for gynecology and obstetrics in object patientData
    const insertDataGynecologyObstetrics = () => {

        console.log(inputCesareas.val())

        patientData.listGynecologyObstetrics = {
            menarca: inputMenarca.val(),
            fum: inputFum.val(),
            numGestas: inputGestas.val() == '' ? 0 : inputGestas.val(),
            numPartos: inputPartos.val() == '' ? 0 : inputPartos.val(),
            numCesareas: inputCesareas.val() == '' ? 0 : inputPartos.val(),
            numAbortos: inputAbortos.val() == '' ? 0 : inputPartos.val(),
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


    // Get all elements of the DOM for gynecology and obstetrics
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

