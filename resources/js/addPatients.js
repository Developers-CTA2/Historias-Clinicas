import { getPerson } from './helpers/request-get-person.js';
import { iconCompleted, iconBlocked } from './templates/iconsTemplate.js'
import { validateStepFormOne, validateStepFormFive } from './helpers/validateDataAddPatient.js';
import { selectDynamicSpecificDisease, getListDiseases, selectDynamicDrugAddiction, getListDrugAddiction, pathologicalHistory, getListPathologicalHistory } from './components';
import { requestSavePatient, AlertSweetSuccess, AlertError, AlertErrorWithHTML } from './helpers';
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
let activeSendButton = false;
let typePerson = null;
let templateErrors = '';


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

        resetAlertAndData();
        typePerson = getTypePerson(valueCode);



        // Request for get person data
        getPerson({ code: valueCode, type: typePerson }).then(handlePersonData).catch(handleError)

    });

    btnSearchCode.on('click', function () {

        console.log('click');
        const valueCode = inputCode.val().trim();

        if (prevCode == valueCode) return;

        prevCode = valueCode;

        if (!isValidateCodeLength(valueCode)) {
            showAlertError('La estructura es incorrecta, el código debe ser de 7 o 9 números.', 'alert-danger');
            inputCode.addClass('border-danger');
            return;
        }

        resetAlertAndData();
        typePerson = getTypePerson(valueCode);

        // Request for get person data
        getPerson({ code: valueCode, type: typePerson }).then(handlePersonData).catch(handleError)
    })


    /* Logic for handling a person belonging to the UDG */
    const isValidateCodeLength = (code) => code.length == 7 || code.length == 9;



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

    const handlePersonData = ({ data }) => {
        console.log(data, typePerson);
        if (typePerson == 1) {
            const { codigo, nombramiento, nombre, fecha_nacimiento, sexo, ultimo_grado } = data.worker;

            const adicionalData = formatToId(sexo, ultimo_grado, fecha_nacimiento);
            setPersonData(codigo, nombre, nombramiento, adicionalData);


        } else {

            const { codigo, carrera, nombre } = data.student;
            setPersonData(codigo, nombre, carrera);
        }


    }

    const setPersonData = (code, name, dependency, adicionalData = {}) => {
        patientData.code = code;
        patientData.name = name;
        patientData.career = dependency;


        if (adicionalData.sexo) {
            const { sexo, grado, fecha_nacimiento } = adicionalData;
            patientData.gender = sexo;
            patientData.scholarship = grado;
            patientData.birthdate = fecha_nacimiento;
        }

        updateUI(name, dependency);
    }

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

    const updateUI = (name, dependency) => {
        namePerson.text(name);
        careerPerson.text(dependency);
        containerDataPerson.removeClass('d-none');
    }

    const updateUIFormPersonData = () => {

        // If the person is a worker
        if (patientData.gender) {
            selectGender.val(patientData.gender).trigger('change').attr('disabled', true);
            inputScholarship.val(patientData.scholarship).trigger('change').attr('disabled', true);
            inputBirthDate.val(patientData.birthdate).attr('disabled', true);
        }

        inputCodePD.val(patientData.code).attr('disabled', true);
        inputNamePD.val(patientData.name).attr('disabled', true);
        inputCareerPD.val(patientData.career).attr('disabled', true);

        // Show form for person data
        containerFatherForm.removeClass('d-none');
    }

    // Handle error for request person
    const handleError = (error) => {
        const { message, status } = error;
        console.log(error);
        showAlertError(message.error.data.message, status == 404 || message.error.status == 400 ? 'alert-info' : 'alert-danger');
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

            formSteps.first().removeClass('d-none');
            stepCicles.first().addClass('active');

            patientData.type = 'udg';

            setTimeout(() => {
                inputNamePD.focus(); // Remove focus
            }, 1000);

            steps = 1;
        }
    });

    // Event listeners
    btnCardUdgPerson.off('click');
    btnCardUdgPerson.on('click', function () {
        containerUdgPerson.removeClass('d-none');
    });

    btnCardexternalPerson.on('click', function () {
        containerUdgPerson.addClass('d-none');
        containerPersonSelect.addClass('d-none');

        inputCodePD.val('').attr('disabled', true);
        inputNamePD.val('').attr('disabled', false);
        inputCareerPD.val('').attr('disabled', false);

        containerFatherForm.removeClass('d-none');
        formSteps.first().removeClass('d-none');
        stepCicles.first().addClass('active');

        patientData.type = 'external';

        setTimeout(() => {
            inputNamePD.focus(); // Remove focus
        }, 1000);

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

            if (!validateStepFormOne(patientData, elements)) return;
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

    btnErrorList.on('click', function () {
        templateErrors !== '' && AlertErrorWithHTML('Lista de errores', templateErrors);
    })

    const sendDataForm = () => {
        btnSendForm.off('click');
        btnSendForm.on('click', function () {

            if (steps == 5) {
                const elements = getDomGynecologyObstetrics();
                const values = getDataFiveStepValues();
                if (!validateStepFormFive(values, elements)) return;
            }

            getAllDataForm();
            console.log(patientData);

            requestSavePatient(patientData).then((data) => {
                const { title, message } = data;
                AlertSweetSuccess(title, message);

            }).catch((error) => {
                const { errorList } = error;

                if (errorList) {

                    AlertError('Oops', 'Hubo un error al guardar los datos, por favor corrige estos errores pueden ser por campos vacíos o mal escritos, puedes verificarlos al presionar el botón "Errores", este se encuentra en la parte superior derecha.');

                    templateErrors = '';
                    for (const [key, messages] of Object.entries(errorList)) {
                        templateErrors += templateErrorItem(messages[0]);
                    }

                    templateErrors = templateErrorList(templateErrors);

                    btnErrorList.removeClass('d-none');
                }



            });

        });
    }


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

    const insertDataGynecologyObstetrics = () => {
        patientData.listGynecologyObstetrics = {
            menarca: inputMenarca.val(),
            fum: inputFum.val(),
            numGestas: inputGestas.val() ?? '0',
            numPartos: inputPartos.val() ?? '0',
            numCesareas: inputCesareas.val() ?? '0',
            numAbortos: inputAbortos.val() ?? '0',
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

