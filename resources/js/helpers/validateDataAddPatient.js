import  { regexNumero, regexLetters, regexFecha, regexTelefono,regexNss} from './Regex.js';


export const validateStepFormOne = (dataValidate, elementsForm)=>{

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
        street,
        number,
        intNumber,
        emergencyName,
        emergencyPhone,
        relationship } = dataValidate;

        const {allInputsPD,
            inputCodePD,
            inputNamePD,
            inputCareerPD,
            inputBirthDate,
            selectGender,
            selectBloodType,
            selectCivilStatus,
            inputState,
            inputCity,
            inputStreet,
            inputNumber,
            inputIntNumber,
            inputPhone,
            inputNss,
            inputReligion,
            inputDependency,
            inputEmergencyName,
            inputEmergencyPhone,
            inputRelationship} = elementsForm;

        allInputsPD.each((element)=>{
            $(element).children('input').removeClass('is-invalid border-danger');  
            $(element).children('span').addClass('d-none').text('');
            $(element).children('select').removeClass('is-invalid border-danger');
        });

        
        console.log(dataValidate);

        if(code === '' && name === '' && career === '' && gender === null && birthdate === '' && bloodType === null && phone === '' && nss === '' && civilStatus === null && religion === '' && dependency === '' && state === '' && city === '' && street === '' && number === ''  && emergencyName === '' && emergencyPhone === '' && relationship === ''){
            allInputsPD.each((element)=>{
              let input = $(element).children('input');  
              let span = $(element).children('span');
              let select = $(element).children('select');

                select.addClass('is-invalid border-danger');
                input.addClass('is-invalid border-danger');
                span.text('El campo es requerido, por favor llenalo').removeClass('d-none');
              
            })
            validateForm = false
            return validateForm;

            
        }

        if(code === ''){
            inputCodePD.addClass('is-invalid border-danger');
            inputCodePD.next().text('El campo es requerido, por favor llenalo').removeClass('d-none');
            validateForm = false;
        }

        if(code !== '' && !regexNumero.test(code)){
            inputCodePD.addClass('is-invalid border-danger');
            inputCodePD.next().text('Solo se permiten números').removeClass('d-none');
            validateForm = false;

        }

        if(name === ''){
            inputNamePD.addClass('is-invalid border-danger');
            inputNamePD.next().text('El campo es requerido, por favor llenalo').removeClass('d-none');
            validateForm = false;
        }

        if(name !== '' && !regexLetters.test(name)){
            inputNamePD.addClass('is-invalid border-danger');
            inputNamePD.next().text('Solo se permiten letras').removeClass('d-none');
            validateForm = false;
        }

        if(career === ''){
            inputCareerPD.addClass('is-invalid border-danger');
            inputCareerPD.next().text('El campo es requerido, por favor llenalo').removeClass('d-none');
            validateForm = false;
        }

        if(birthdate === ''){
            inputBirthDate.addClass('is-invalid border-danger');
            inputBirthDate.next().text('El campo es requerido, por favor llenalo').removeClass('d-none');
            validateForm = false;
        }

        if(birthdate !== '' && !regexFecha.test(birthdate)){
            inputBirthDate.addClass('is-invalid border-danger');
            inputBirthDate.next().text('Formato de fecha incorrecto').removeClass('d-none');
            validateForm = false;
        }

        if(gender === null){   
            selectGender.addClass('is-invalid border-danger');
            selectGender.next().text('El campo es requerido, por favor llenalo').removeClass('d-none');
            validateForm = false;
        }

        if(bloodType === null){
            selectBloodType.addClass('is-invalid border-danger');
            selectBloodType.next().text('El campo es requerido, por favor llenalo').removeClass('d-none');
            validateForm = false;
        }

        if(phone === ''){
            inputPhone.addClass('is-invalid border-danger');
            inputPhone.next().text('El campo es requerido, por favor llenalo').removeClass('d-none');
            validateForm = false;
        }

        if(phone !== '' && !regexNumero.test(phone)){
            inputPhone.addClass('is-invalid border-danger');
            inputPhone.next().text('Solo se permiten números').removeClass('d-none');
            validateForm = false;
        }

        if(phone !== '' && !regexTelefono.test(phone)){
            inputPhone.addClass('is-invalid border-danger');
            inputPhone.next().text('El número debe tener 10 dígitos').removeClass('d-none');
            validateForm = false;
        }

        if(nss === ''){
            inputNss.addClass('is-invalid border-danger');
            inputNss.next().text('El campo es requerido, por favor llenalo').removeClass('d-none');
            validateForm = false;
        }

        if(nss !== '' && !regexNss.test(nss)){
            inputNss.addClass('is-invalid border-danger');
            inputNss.next().text('Solo se permiten números').removeClass('d-none');
            validateForm = false;
        }

        if(civilStatus === null){
            selectCivilStatus.addClass('is-invalid border-danger');
            selectCivilStatus.next().text('El campo es requerido, por favor llenalo').removeClass('d-none');
            validateForm = false;
        }

        if(religion === ''){
            inputReligion.addClass('is-invalid border-danger');
            inputReligion.next().text('El campo es requerido, por favor llenalo').removeClass('d-none');
            validateForm = false;
        }

        if(dependency === ''){
            inputDependency.addClass('is-invalid border-danger');
            inputDependency.next().text('El campo es requerido, por favor llenalo').removeClass('d-none');
            validateForm = false;
        }

        if(state === ''){
            inputState.addClass('is-invalid border-danger');
            inputState.next().text('El campo es requerido, por favor llenalo').removeClass('d-none');
            validateForm = false;
        }

        if(city === ''){
            inputCity.addClass('is-invalid border-danger');
            inputCity.next().text('El campo es requerido, por favor llenalo').removeClass('d-none');
            validateForm = false;
        }

        if(street === ''){
            inputStreet.addClass('is-invalid border-danger');
            inputStreet.next().text('El campo es requerido, por favor llenalo').removeClass('d-none');
            validateForm = false;
        }

        if(number === ''){
            inputNumber.addClass('is-invalid border-danger');
            inputNumber.next().text('El campo es requerido, por favor llenalo').removeClass('d-none');
            validateForm = false;
        }

        if( intNumber != '' && !regexNumero.test(intNumber)){
            inputIntNumber.addClass('is-invalid border-danger');
            inputIntNumber.next().text('Solo se permiten números').removeClass('d-none');
            validateForm = false;
        }

        if(emergencyName === ''){
            inputEmergencyName.addClass('is-invalid border-danger');
            inputEmergencyName.next().text('El campo es requerido, por favor llenalo').removeClass('d-none');
            validateForm = false;
        }

        if(emergencyName !== '' && !regexLetters.test(emergencyName)){
            inputEmergencyName.addClass('is-invalid border-danger');
            inputEmergencyName.next().text('Solo se permiten letras').removeClass('d-none');
            validateForm = false;
        }

        if(emergencyPhone === ''){
            inputEmergencyPhone.addClass('is-invalid border-danger');
            inputEmergencyPhone.next().text('El campo es requerido, por favor llenalo').removeClass('d-none');
            validateForm = false;
        }

        if(emergencyPhone !== '' && !regexNumero.test(emergencyPhone)){
            inputEmergencyPhone.addClass('is-invalid border-danger');
            inputEmergencyPhone.next().text('Solo se permiten números').removeClass('d-none');
            validateForm = false;
        }

        if(emergencyPhone !== '' && !regexTelefono.test(emergencyPhone)){
            inputEmergencyPhone.addClass('is-invalid border-danger');
            inputEmergencyPhone.next().text('El número debe tener 10 dígitos').removeClass('d-none');
            validateForm = false;
        }

        if(relationship === ''){
            inputRelationship.addClass('is-invalid border-danger');
            inputRelationship.next().text('El campo es requerido, por favor llenalo').removeClass('d-none');
            validateForm = false;
        }

        return true;

}