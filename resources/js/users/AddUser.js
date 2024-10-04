import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";

import {
    validarCampo,
    regexCorreo, regexCedula, regexCode,
    AlertCancelConfirmation, AlertConfirmationForm,
    getPerson, requestSaveUser, dragAndDropFile,
    AlertSweetSuccess,
    AlertError,
    AlertInfo
} from "../helpers";
import { listErrorsForStoreUser } from "../templates/usersTemplate";
import { type } from "jquery";



let typePerson = 1;

const dataPersonWebService = {
    code: '',
    name: '',
    dependency: '',
    sex: '',
    type: ''
}

const dataForm = {
    name: '',
    code: '',
    email: '',
    userType: '',
    cedula: '',
    file: '',
    sex: ''
}

let isCalledDragAndDrop = false;

$(document).ready(function () {


    // Buttons
    const btnSearch = $('#Search');
    const btnCancel = $('#cancelForm');
    const btnSaveUser = $("#save-user")
    const selectType = $('#Usertype');

    // Inputs
    const code = $('#code');
    const email = $('#Useremail');
    const cedula = $('#Usercedula');
    const sex = $('#Sex');


    // Containers
    const fileContainer = $('.file-dnd');
    const errorContainer = $('#listErrors');
    const errorContainerPerson = $('#listErrorsPerson');



    // Manage code of user to store in db
    const manageCode = () => {
        let codeValue = code.val().trim();

        // Reset errors in the form
        resetErrorListPerson();
        resetFormAddUser();
        resetFormErrors();

        // If code is not valid
        if (!validarCampo(codeValue, regexCode, "#code")) {
            code.next().text('El código no es válido').removeClass('d-none');
            return;
        }

        // If code is not 7 or 9 numbers
        if (codeValue.length !== 7 && codeValue.length !== 9) {
            code.next().text('El código debe tener 7 u 9 caracteres').removeClass('d-none');
            return;
        }

        // Request to web service of person
        getPerson({ code: codeValue, type: codeValue.length === 7 ? 1 : 2, person: 'user' }).then(manageDataPerson).catch(manageErrorPerson);


    }

    const resetFormAddUser = () => {
        sex.val('').attr('disabled', false);
    }

    // Manage data of person when is found
    const manageDataPerson = ({ data, type }) => {

        // If type is 1 is worker, if type is 2 is student
        if (parseInt(type) === 1) {
            const { codigo, nombramiento, nombre, sexo } = data.worker;
            dataPersonWebService.code = codigo;
            dataPersonWebService.dependency = nombramiento;
            dataPersonWebService.name = nombre;

            sexo === 'Masculino' ? dataPersonWebService.sex = 1 : dataPersonWebService.sex = 2;
            dataPersonWebService.type = 1;

        } else {
            const { codigo, carrera, nombre } = data.student;
            dataPersonWebService.code = codigo;
            dataPersonWebService.dependency = carrera;
            dataPersonWebService.name = nombre;
            dataPersonWebService.type = 2;
        }

        // Update UI
        updateUIDataPerson();

    }

    // Update UI with data of person
    const updateUIDataPerson = () => {
        $("#R-nombre").text(dataPersonWebService.name);
        $("#R-code").text(dataPersonWebService.code);

        if (dataPersonWebService.type === 1) {
            sex.val(dataPersonWebService.sex).attr('disabled', true);
        }

        $(".cont-user-data").removeClass("d-none");
        $(".buttons-cont").addClass("d-none");

        // Active event for drag and drop
        activeEventForDragAndDrop();
    }

    // Manage error of person
    const manageErrorPerson = (errors) => {
        const { status, title, message } = errors;

        console.log(errors);
        // If status is 400, is error for the client
        if (status === 400) {
            const { message } = errors;
            AlertError(message.title, message.msg);

            if (message.error.length > 0) {
                errorContainerPerson.html(listErrorsForStoreUser(message.error));
            } else {
                errorContainerPerson.html(`<p class="text-center mb-0">${message.msg}</p>`);
            }
            errorContainerPerson.parent().parent().removeClass('d-none');

            return;
        }

        if (status === 404) {
            AlertInfo('No encontrado', message.msg);
        return;
    }

    // If status is not 400, is error for the server
    AlertError(title, message.msg);


}


    const activeEventForDragAndDrop = () => {
    uploadFile();
}

/* Upload file */
const uploadFile = () => {
    !isCalledDragAndDrop && dragAndDropFile();
    isCalledDragAndDrop = true;
}

// Alert for cancel form 
const alertForCancelForm = () => {
    AlertCancelConfirmation('¿Estás seguro de cancelar el registro?', '¡No podrás deshacer esto!', '/users');
}


// Validate form for store user
const validateForm = () => {
    dataForm.name = dataPersonWebService.name;
    dataForm.code = dataPersonWebService.code;
    dataForm.sex = sex.val();
    dataForm.email = email.val().trim();
    dataForm.userType = selectType.val();
    dataForm.cedula = cedula.val().trim();
    dataForm.file = $('#upload-image')[0].files[0];

    let validateForm = true;

    console.log(sex.val());

    // Reset errors in the UI form
    resetFormErrors();

    if (!regexCorreo.test(dataForm.email)) {
        email.next().text('El correo no es válido').removeClass('d-none');
        email.addClass('is-invalid border-danger');
        validateForm = false;
    }

    if (dataForm.sex === null) {
        sex.addClass('is-invalid border-danger');
        sex.next().text('El sexo es requerido').removeClass('d-none');
        validateForm = false;
    }


    if (dataForm.userType === null) {
        selectType.addClass('is-invalid border-danger');
        selectType.next().text('El tipo de usuario es requerido').removeClass('d-none');
        validateForm = false;
    }

    if (dataForm.userType === '1' && !regexCedula.test(dataForm.cedula)) {

        // cedula.next().text('La cédula debe de constar de 10 dígitos').removeClass('d-none');;
        cedula.next().text('La cédula no es válida').removeClass('d-none');

        cedula.addClass('is-invalid border-danger');
        validateForm = false;
    }

    if (
        dataForm.userType === "1" &&
        regexCedula.test(dataForm.cedula) &&
        dataForm.cedula.length < 7 &&
        dataForm.cedula.length > 8
    ) {
        cedula
            .next()
            .text("La cédula debe de constar de 7 a 8 dígitos")
            .removeClass("d-none");
        cedula.addClass("is-invalid border-danger");
        validateForm = false;
    }

    if (!dataForm.file) {
        fileContainer.addClass('is-invalid border-danger border-2');
        fileContainer.next().text('El documento es requerido').removeClass('d-none');
        validateForm = false;
    }

    return validateForm;

}

// Reset errors in the form
const resetFormErrors = () => {
    selectType.next().text('').addClass('d-none');
    selectType.removeClass('is-invalid border-danger');
    email.next().text('').addClass('d-none');
    email.removeClass('is-invalid border-danger');
    cedula.next().text('').addClass('d-none');
    cedula.removeClass('is-invalid border-danger');
    fileContainer.removeClass('is-invalid border-danger border-2');
    fileContainer.next().text('').addClass('d-none');
    sex.removeClass('is-invalid border-danger');
    sex.next().text('').addClass('d-none');
}

// Manage form for store user
const manageForm = () => {

    // Reset errors
    resetErrorList();

    // If exist errors in the form not continue
    if (!validateForm()) return

    // Show alert for confirmation for store user
    AlertConfirmationForm('¿Estás seguro de guardar el registro?', '¡No podrás deshacer esto!', saveUser);
}

// Reset errors in the list
const resetErrorList = () => {
    errorContainer.parent().parent().parent().addClass('d-none');
    errorContainer.html('');
}

// Reset errors in the form for get person
const resetErrorListPerson = () => {
    errorContainerPerson.parent().parent().addClass('d-none');
    errorContainerPerson.html('');
}


// Save user in the db
const saveUser = () => {
    // Create form data
    const formData = new FormData();
    formData.append('file', dataForm.file);
    formData.append('name', dataForm.name);
    formData.append('code', dataForm.code);
    formData.append('email', dataForm.email);
    formData.append('userType', dataForm.userType);
    formData.append('cedula', dataForm.cedula);
    if (dataForm.sex === 1) {
        formData.append('sex', 'Masculino');
    } else {
        formData.append('sex', 'Femenino');
    }

    // Request to save user
    requestSaveUser(formData).then(showSuccess).catch(showErrors);

}

// Show success alert
const showSuccess = (data) => {
    const { title, msg } = data;
    AlertSweetSuccess(title, msg, '/users');
}

// Show errors in the form
const showErrors = (errors) => {
    const { status } = errors;

    console.log(errors);

    // If errors is 422, is error from the controller Validator
    if (status === 422) {
        const { errorList } = errors;

        // Show errors in the form
        AlertError('Oops...!', 'Se encontraron errores en el formulario');

        // Show errors in the form
        errorContainer.html(listErrorsForStoreUser(errorList));
        errorContainer.parent().parent().parent().removeClass('d-none');

        return;
    }

    // If errors is not 422, is error from the server
    const { title, message } = errors;
    AlertError(title, message.msg);
}

// Event for select type of user
selectType.on("change", function () {

    const userType = parseInt($(this).val());

    // If user is doctor, show container
    if (userType == '1') {
        $(".div-cedula").fadeIn(500).removeClass("d-none");
    } else {
        // If user is not doctor, hide container
        $(".div-cedula").fadeOut(500).addClass("d-none");

    }
});


// Events
btnSearch.on('click', manageCode);
btnCancel.on('click', alertForCancelForm);
btnSaveUser.on('click', manageForm)

});

