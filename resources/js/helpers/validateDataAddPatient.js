import { regexNumero,regexCp,regexIntNumero, regexDescription, regexLetters,regexNumlenght2, regexAnio, regexFecha, regexTelefono, regexNss } from './Regex.js';

const yearActual = new Date().getFullYear();

// Función para validar los campos del formulario dee los datos personales del paciente
export const validateStepFormOne = (dataValidate, elementsForm) => {

    let validateForm = true;

    const {
        code,
        name,
        career,
        gender,
        birthdate,
        bloodType,
        phone,
        nss,
        civilStatus,
        religion,
        dependency,
        state,
        city,
        scholarship,
        colony,
        cp,
        street,
        number,
        intNumber,
        emergencyName,
        emergencyPhone,
        type,
        relationship } = dataValidate;

    const { allInputsPD,
        inputCodePD,
        inputNamePD,
        inputCareerPD,
        inputBirthDate,
        selectGender,
        selectBloodType,
        selectCivilStatus,
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
        inputReligion,
        inputDependency,
        inputEmergencyName,
        inputEmergencyPhone,
        inputRelationship } = elementsForm;


        console.log(inputColony,colony);

    allInputsPD.each(function () {

        $(this).children('input').removeClass('is-invalid border-danger');
        $(this).children('span').addClass('d-none').text('');
        $(this).children('select').removeClass('is-invalid border-danger');
    });


    if ((type === 'udg' && code === '') && name === '' && career === '' && gender === null && birthdate === '' && bloodType === null && phone === '' && nss === '' && civilStatus === null && religion === '' && dependency === '' && state === '' && city === '' && street === '' && number === '' && emergencyName === '' && emergencyPhone === '' && relationship === '' && colony === '' && cp === '' && scholarship === null) {  
        allInputsPD.each(function () {
            let input = $(this).children('input');
            let span = $(this).children('span');
            let select = $(this).children('select');

            select.addClass('is-invalid border-danger');
            input.addClass('is-invalid border-danger');
            span.text('El campo es requerido, por favor llénalo').removeClass('d-none');

        })
        validateForm = false
        return validateForm;


    }

    if (type == 'udg' && code === '') {
        inputCodePD.addClass('is-invalid border-danger');
        inputCodePD.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
    }

    if (type == 'udg' && code !== '' && !regexNumero.test(code)) {
        inputCodePD.addClass('is-invalid border-danger');
        inputCodePD.next().text('Solo se permiten números').removeClass('d-none');
        validateForm = false;

    }

    if (name === '') {
        inputNamePD.addClass('is-invalid border-danger');
        inputNamePD.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
    }

    if (name !== '' && !regexLetters.test(name)) {
        inputNamePD.addClass('is-invalid border-danger');
        inputNamePD.next().text('Solo se permiten letras').removeClass('d-none');
        validateForm = false;
    }

    if (career === '') {
        inputCareerPD.addClass('is-invalid border-danger');
        inputCareerPD.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
    }

    if (birthdate === '') {
        inputBirthDate.addClass('is-invalid border-danger');
        inputBirthDate.next().text('El campo es requerido, por favor selecciona una fecha').removeClass('d-none');
        validateForm = false;
    }

    if (birthdate !== '' && !regexFecha.test(birthdate)) {
        inputBirthDate.addClass('is-invalid border-danger');
        inputBirthDate.next().text('Formato de fecha incorrecto').removeClass('d-none');
        validateForm = false;
    }

    if (gender === null) {
        selectGender.addClass('is-invalid border-danger');
        selectGender.next().text('El campo es requerido, por favor selecciona una opción').removeClass('d-none');
        validateForm = false;
    }

    if (bloodType === null) {
        selectBloodType.addClass('is-invalid border-danger');
        selectBloodType.next().text('El campo es requerido, por favor selecciona una opción').removeClass('d-none');
        validateForm = false;
    }

    if (phone === '') {
        inputPhone.addClass('is-invalid border-danger');
        inputPhone.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
    }

    if (phone !== '' && !regexNumero.test(phone)) {
        inputPhone.addClass('is-invalid border-danger');
        inputPhone.next().text('Solo se permiten números').removeClass('d-none');
        validateForm = false;
    }

    if (phone !== '' && !regexTelefono.test(phone)) {
        inputPhone.addClass('is-invalid border-danger');
        inputPhone.next().text('El número debe tener 10 dígitos').removeClass('d-none');
        validateForm = false;
    }

    if (nss === '') {
        inputNss.addClass('is-invalid border-danger');
        inputNss.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
    }

    if (nss !== '' && !regexNss.test(nss)) {
        inputNss.addClass('is-invalid border-danger');
        inputNss.next().text('Solo se permiten números y deben ser 11 dígitos').removeClass('d-none');
        validateForm = false;
    }

    if (civilStatus === null) {
        selectCivilStatus.addClass('is-invalid border-danger');
        selectCivilStatus.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
    }

    if (religion === '') {
        inputReligion.addClass('is-invalid border-danger');
        inputReligion.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
    }

    if (dependency === '') {
        inputDependency.addClass('is-invalid border-danger');
        inputDependency.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
    }

    if (state === '') {
        inputState.addClass('is-invalid border-danger');
        inputState.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
    }

    if (city === '') {
        inputCity.addClass('is-invalid border-danger');
        inputCity.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
    }

    if (colony === '') {
        console.log('entro');
        inputColony.addClass('is-invalid border-danger');
        inputColony.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
    }

    if (cp === '') {
        inputCp.addClass('is-invalid border-danger');
        inputCp.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
    }

    if(cp !== '' && !regexCp.test(cp)){
        inputCp.addClass('is-invalid border-danger');
        inputCp.next().text('Formato de código postal erroneo').removeClass('d-none');
        validateForm = false;
    }

    if (street === '') {
        inputStreet.addClass('is-invalid border-danger');
        inputStreet.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
    }

    if(scholarship === null){
        inputScholarship.addClass('is-invalid border-danger');
        inputScholarship.next().text('El campo es requerido, por favor selecciona una opción').removeClass('d-none');
        validateForm = false;
    }

    
    if (number === '') {
        inputNumber.addClass('is-invalid border-danger');
        inputNumber.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
    }

    if (intNumber != '' && !regexIntNumero.test(intNumber)) {
        inputIntNumber.addClass('is-invalid border-danger');
        inputIntNumber.next().text('Solo se permiten números').removeClass('d-none');
        validateForm = false;
    }

    if (emergencyName === '') {
        inputEmergencyName.addClass('is-invalid border-danger');
        inputEmergencyName.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
    }

    if (emergencyName !== '' && !regexLetters.test(emergencyName)) {
        inputEmergencyName.addClass('is-invalid border-danger');
        inputEmergencyName.next().text('Solo se permiten letras').removeClass('d-none');
        validateForm = false;
    }

    if (emergencyPhone === '') {
        inputEmergencyPhone.addClass('is-invalid border-danger');
        inputEmergencyPhone.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
    }

    if (emergencyPhone !== '' && !regexNumero.test(emergencyPhone)) {
        inputEmergencyPhone.addClass('is-invalid border-danger');
        inputEmergencyPhone.next().text('Solo se permiten números').removeClass('d-none');
        validateForm = false;
    }

    if (emergencyPhone !== '' && !regexTelefono.test(emergencyPhone)) {
        inputEmergencyPhone.addClass('is-invalid border-danger');
        inputEmergencyPhone.next().text('El número debe tener 10 dígitos').removeClass('d-none');
        validateForm = false;
    }

    if (relationship === '') {
        inputRelationship.addClass('is-invalid border-danger');
        inputRelationship.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
    }

    return validateForm;

}

const applyValidation = {
    menarca : false,
    fum : false,
    numGestas : false,
    numPartos : false,
    numCesareas : false,
    numAbortos : false,
    diasSangrado : false,
    diasCiclo : false,
    fechaCitologia : false, 
    mastografia : false,
    inicioVidaSexual : false,
    metodoDescriptivo : false,
    estaEmbarazada : false,
}


/* Validaciones para antecendentes patologicos*/

export const validateFormDateAndReason = (sinceWhen, reason, inputDate, inputReason)=>{

    let validate = true;
    inputDate.removeClass('is-invalid border-danger');
    inputReason.removeClass('is-invalid border-danger');
    inputDate.next().addClass('d-none').text('');
    inputReason.parent().next().addClass('d-none').text('');

    let validateReason = false;

    if(sinceWhen == '' && reason == ''){
        inputDate.addClass('is-invalid border-danger');
        inputDate.next().removeClass('d-none').text('Campo es requerido');
        inputReason.addClass('is-invalid border-danger');
        inputReason.parent().next().removeClass('d-none').text('Campo es requerido');
        return false;
    }

    if(sinceWhen == ''){
        inputDate.addClass('is-invalid border-danger');
        inputDate.next().removeClass('d-none').text('Campo es requerido');
        validate = false;
    }

    if(reason == ''){
        inputReason.addClass('is-invalid border-danger');
        inputReason.parent().next().removeClass('d-none').text('Campo es requerido');
        validate = false;
        validateReason = true;
    }

    if(!validateReason && !regexDescription.test(reason)){
        inputReason.addClass('is-invalid border-danger');
        inputReason.parent().next().removeClass('d-none').text('Este campo solo acepta letras, números y algunos caracteres especiales');
        validate = false;
    }

    return validate;
  }


export const validateSelectDisease = (dataValidate, selectDiseasePersonal) => {

    if(dataValidate == '' || dataValidate == 0) {
        selectDiseasePersonal.addClass('is-invalid border-danger');
        selectDiseasePersonal.parent().find('span').last().removeClass('d-none').text('Debes seleccionar una opción');
        return false;
    }

    return true
}

export const validateAllergies = (dataValidate, elementsForm) => {

    let validate = true;
    let applyValidation = false;

    const { allergies, description } = dataValidate;
    const { selectAllergies, textDescription   } = elementsForm;


    selectAllergies.removeClass('is-invalid border-danger');
    selectAllergies.parent().find('span').last().addClass('d-none').text('');
    textDescription.removeClass('is-invalid border-danger');
    textDescription.parent().next().addClass('d-none').text('');

    console.log(allergies, allergies.length);


    if((allergies === '' || allergies == 0) && description === ''){
        selectAllergies.addClass('is-invalid border-danger');
        selectAllergies.parent().find('span').last().removeClass('d-none').text('Campo es requerido');
        textDescription.addClass('is-invalid border-danger');
        textDescription.parent().next().removeClass('d-none').text('Campo es requerido');

        validate = false;
        return validate;
    }

    if(allergies === ''){
        selectAllergies.addClass('is-invalid border-danger');
        selectAllergies.parent().find('span').last().removeClass('d-none').text('El campo es requerido');
        validate = false;
    }

    if(description === ''){
        textDescription.addClass('is-invalid border-danger');
        textDescription.parent().next().removeClass('d-none').text('Campo es requerido');
        validate = false;
        applyValidation = true;
    }

    if(!applyValidation && !regexDescription.test(description)){
        textDescription.addClass('is-invalid border-danger');
        textDescription.parent().next().removeClass('d-none').text('Este campo solo acepta letras, números y algunos caracteres especiales');
        validate = false;
    
    }

    return validate;



}



// Función para validar ginecologia obstetricia
export const validateStepFormFive = (dataValidate, elementsForm) => {
    const {
        menarca,
        fum,
        numGestas,
        numPartos,
        numCesareas,
        numAbortos,
        diasSangrado,
        diasCiclo,
        fechaCitologia,
        mastografia,
        inicioVidaSexual,
        metodoDescriptivo,
        estaEmbarazada,
        cicloRegular,
        cicloIrregular,
    } = dataValidate;

    const {
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
    } = elementsForm;

    let validateForm = true;

    applyValidation.menarca = false;
    applyValidation.fum = false;
    applyValidation.numGestas = false;
    applyValidation.numPartos = false;
    applyValidation.numCesareas = false;
    applyValidation.numAbortos = false;
    applyValidation.diasSangrado = false;
    applyValidation.diasCiclo = false;
    applyValidation.fechaCitologia = false;
    applyValidation.mastografia = false;
    applyValidation.inicioVidaSexual = false;
    applyValidation.metodoDescriptivo = false;
    

    formGynecologyObstetrics.each(function () {
        $(this).children('input').removeClass('is-invalid border-danger');
        $(this).children('span').addClass('d-none').text('');
        $(this).children('textarea').removeClass('is-invalid border-danger');
    });


    if (menarca === '' && fum === '' && diasSangrado === '' && diasCiclo === '' && fechaCitologia === '' && mastografia === '' && inicioVidaSexual === '' && metodoDescriptivo === '' && cicloRegular === false && cicloIrregular === false) {
        formGynecologyObstetrics.each(function () {
            let input = $(this).children('input');
            let textarea = $(this).children('textarea');
            let span = $(this).children('span');

            input.addClass('is-invalid border-danger');
            textarea.addClass('is-invalid border-danger');
            span.text('El campo es requerido, por favor llénalo').removeClass('d-none');
        });

        validateForm = false;   
        return validateForm;
    }

    if (menarca === '') {
        inputMenarca.addClass('is-invalid border-danger');
        inputMenarca.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
        applyValidation.menarca = true;
        
    }

    if(!applyValidation.menarca && !regexNumlenght2.test(menarca)){
        console.log('entro');   
        inputMenarca.addClass('is-invalid border-danger');
        inputMenarca.next().text('Solo se permiten números enteros enteros, con una longitud de 2 número').removeClass('d-none');
        validateForm = false;
    }

    if (fum === '') {
        inputFum.addClass('is-invalid border-danger');
        inputFum.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');     
        validateForm = false;
        applyValidation.fum = true;
    }

    if( !applyValidation.fum && !regexFecha.test(fum)){
        inputFum.addClass('is-invalid border-danger');
        inputFum.next().text('Formato de fecha incorrecto').removeClass('d-none');
        validateForm = false;
    }

    // if (numGestas === '') {
    //     inputGestas.addClass('is-invalid border-danger');
    //     inputGestas.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');     
    //     validateForm = false;
    //     applyValidation.numGestas = true;
    // }

    if( numGestas !== '' && !regexNumlenght2.test(numGestas)){
        inputGestas.addClass('is-invalid border-danger');
        inputGestas.next().text('Solo se permiten números enteros').removeClass('d-none');
        validateForm = false;
    }

    // if (numPartos !== '') {
    //     inputPartos.addClass('is-invalid border-danger');
    //     inputPartos.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');     
    //     validateForm = false;
    //     applyValidation.numPartos = true;
    // }

    if(numPartos !== '' && !regexNumlenght2.test(numPartos)){
        inputPartos.addClass('is-invalid border-danger');
        inputPartos.next().text('Solo se permiten números enteros').removeClass('d-none');
        validateForm = false;
    }

    // if (numCesareas === '') {
    //     inputCesareas.addClass('is-invalid border-danger');
    //     inputCesareas.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');     
    //     validateForm = false;
    //     applyValidation.numCesareas = true;
    // }

    if(numCesareas !== '' && !regexNumlenght2.test(numCesareas)){
        inputCesareas.addClass('is-invalid border-danger');
        inputCesareas.next().text('Solo se permiten números enteros').removeClass('d-none');
        validateForm = false;
    }

    // if (numAbortos === '') {
    //     inputAbortos.addClass('is-invalid border-danger');
    //     inputAbortos.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');     
    //     validateForm = false;
    //     applyValidation.numAbortos = true;
    // }

    if(numAbortos !== '' && !regexNumlenght2.test(numAbortos) ){
        inputAbortos.addClass('is-invalid border-danger');
        inputAbortos.next().text('Solo se permiten números enteros').removeClass('d-none');
        validateForm = false;
    }

    if (diasSangrado === '') {
        inputDiasSangrado.addClass('is-invalid border-danger');
        inputDiasSangrado.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');     
        validateForm = false;
        applyValidation.diasSangrado = true;
    }

    if(!applyValidation.diasSangrado && !regexNumlenght2.test(diasSangrado)){
        inputDiasSangrado.addClass('is-invalid border-danger');
        inputDiasSangrado.next().text('Solo se permiten números enteros, con una longitud de 2 números').removeClass('d-none');
        validateForm = false;
    }

    if (diasCiclo === '') {
        inputDiasCiclo.addClass('is-invalid border-danger');
        inputDiasCiclo.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');     
        validateForm = false;
        applyValidation.diasCiclo = true;
    }

    if(!applyValidation.diasCiclo && !regexNumlenght2.test(diasCiclo)){
        inputDiasCiclo.addClass('is-invalid border-danger');
        inputDiasCiclo.next().text('Solo se permiten números enteros, con una longitud de 2 números').removeClass('d-none');
        validateForm = false;
    }

    if (fechaCitologia === '') {
        inputfechaCitologia.addClass('is-invalid border-danger');
        inputfechaCitologia.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
        applyValidation.fechaCitologia = true;
    }

    if(!applyValidation.fechaCitologia && !regexAnio.test(fechaCitologia)){
        inputfechaCitologia.addClass('is-invalid border-danger');
        inputfechaCitologia.next().text('Formato de año incorrecto').removeClass('d-none');
        validateForm = false;
        applyValidation.fechaCitologia = true;
    }

    if(!applyValidation.fechaCitologia && fechaCitologia > yearActual){
        inputfechaCitologia.addClass('is-invalid border-danger');
        inputfechaCitologia.next().text('El año no puede ser mayor al año actual').removeClass('d-none');
        validateForm = false;
    }


    if (mastografia === '') {
        inputMastografia.addClass('is-invalid border-danger');
        inputMastografia.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
        applyValidation.mastografia = true;
    }

    if(!applyValidation.mastografia && !regexAnio.test(mastografia)){
        inputMastografia.addClass('is-invalid border-danger');
        inputMastografia.next().text('Formato de año incorrecto').removeClass('d-none');
        validateForm = false;
        applyValidation.mastografia = true;
    }

    if(!applyValidation.mastografia && mastografia > yearActual){
        inputMastografia.addClass('is-invalid border-danger');
        inputMastografia.next().text('El año no puede ser mayor al año actual').removeClass('d-none');
        validateForm = false;
    }

    if (inicioVidaSexual === '') {
        inputInicioVidaSexual.addClass('is-invalid border-danger');
        inputInicioVidaSexual.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
        applyValidation.inicioVidaSexual = true;
    }

    if(!applyValidation.inicioVidaSexual && !regexNumlenght2.test(inicioVidaSexual)){
        inputInicioVidaSexual.addClass('is-invalid border-danger');
        inputInicioVidaSexual.next().text('Formato de fecha incorrecto').removeClass('d-none');
        validateForm = false;
    }

    if (metodoDescriptivo === '') {
        textMetodoDescriptivo.addClass('is-invalid border-danger');
        validateForm = false;
        applyValidation.metodoDescriptivo = true;
    }

    if(!applyValidation.metodoDescriptivo && !regexLetters.test(metodoDescriptivo)){
        textMetodoDescriptivo.addClass('is-invalid border-danger');
        validateForm = false;
    }

    if(!cicloRegular && !cicloIrregular){
        radioCicloRegular.addClass('is-invalid border-danger');
        radioCicloRegular.next().text('El campo es requerido, por favor llénalo').removeClass('d-none');
        validateForm = false;
    } 

    console.log(validateForm);

    return validateForm;

}
