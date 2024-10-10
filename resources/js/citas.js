import "gridjs/dist/theme/mermaid.css";

import { AlertConfirmationForm, AlertError, AlertErrorLoadingData, AlertSweetSuccess } from "./helpers/Alertas.js";
import { requestSaveCita } from "./helpers/request-save-cita.js";
import { regexCorreo, regexLetters, regexTelefono } from "./helpers/Regex.js";
import { listErrorsForStoreUser } from "./templates/usersTemplate.js";

import { initialGridJs } from "./components/tableGridJsCitas.js";


const startHour = 8; // Starting hour
const endHour = 18; // Ending hour





$(function () {


    const timeSelects = document.querySelectorAll('.hora-select');
    const selectShowTypeTable = document.querySelector('#selectFilterTable');
    const containerTableDoctor = document.querySelector('#containerTableDoctor');
    const containerTableNutrition = document.querySelector('#containerTableNutrition');
    const citasParaTexto = document.querySelector('#citasPara');

    const formAddCita = document.querySelector('#addCitaForm');
    const errorContainer = document.querySelector('#errorListAddCita');

    console.log(errorContainer);


    // Form add cita

    const groupForm = document.querySelectorAll('.group-add-form');

    const nombre = document.querySelector('[name="nombre"]');
    const email = document.querySelector('[name="correo"]');
    const telefono = document.querySelector('[name="telefono"]');
    const tipo_profesional = document.querySelector('[name="tipo_profesional"]');
    const hora = document.querySelector('[name="hora"]');
    const motivo = document.querySelector('[name="motivo"]');
    const fecha = document.querySelector('[name="fecha"]');

    


    initialGridJs();


    if (selectShowTypeTable) {
        citasParaTexto.innerHTML = 'Doctora';

        selectShowTypeTable.addEventListener('change', async function () {

            if (this.value === 'medico') {
                console.log('Mostrar tabla doctora');
                containerTableNutrition.classList.add('d-none');
                containerTableDoctor.classList.remove('d-none');
                citasParaTexto.innerHTML = 'Doctora';

            } else if (this.value === 'nuticion') {
                containerTableDoctor.classList.add('d-none');
                containerTableNutrition.classList.remove('d-none');
                citasParaTexto.innerHTML = 'Nutrióloga';
            }
            
        })
    }



    timeSelects.forEach(timeSelect => {
        if (timeSelect) {
            for (let hour = startHour; hour <= endHour; hour++) {
                ['00', '30'].forEach(minute => {
                    const time = `${String(hour).padStart(2, '0')}:${minute}`;
                    const option = document.createElement('option');
                    option.value = time;
                    option.textContent = time;
                    timeSelect.appendChild(option);
                });
            }
        } else {
            AlertErrorLoadingData('Ooops!', 'Ha sucedido un error al cargar los horarios.');
        }
    });


    const validateData = () => {

        let validateForm = true;

        groupForm.forEach(group => {
            group.classList.remove('border-danger', 'is-invalid');
            group.parentElement.nextElementSibling.classList.add('d-none');
            group.parentElement.nextElementSibling.textContent = '';
        });


        if (nombre.value == '' && email.value == '' && telefono.value == '' && tipo_profesional.value == null && hora.value == null && motivo.value == '') {
            groupForm.forEach(group => {
                group.parentElement.nextElementSibling.textContent = 'Este campo es obligatorio';
                group.classList.add('border-danger', 'is-invalid');
                group.parentElement.nextElementSibling.classList.remove('d-none');
            });
            AlertErrorLoadingData('Error', 'Todos los campos son obligatorios.');
            return false;
        }

        if (!regexLetters.test(nombre.value)) {
            nombre.classList.add('border-danger', 'is-invalid');
            nombre.parentElement.nextElementSibling.textContent = 'El nombre no es válido';
            nombre.parentElement.nextElementSibling.classList.remove('d-none');

            validateForm && nombre.focus();
            validateForm = false;
        }

        if (!regexCorreo.test(email.value)) {
            email.classList.add('border-danger', 'is-invalid');
            email.parentElement.nextElementSibling.textContent = 'El email no es válido';
            email.parentElement.nextElementSibling.classList.remove('d-none');

            validateForm && email.focus();
            validateForm = false;
        }

        if (!regexTelefono.test(telefono.value)) {
            telefono.classList.add('border-danger', 'is-invalid');
            telefono.parentElement.nextElementSibling.textContent = 'El teléfono no es válido';
            telefono.parentElement.nextElementSibling.classList.remove('d-none');

            validateForm && telefono.focus();
            validateForm = false;
        }

        if (tipo_profesional.value == '') {
            tipo_profesional.classList.add('border-danger', 'is-invalid');
            tipo_profesional.parentElement.nextElementSibling.textContent = 'El tipo de profesional es obligatorio';
            tipo_profesional.parentElement.nextElementSibling.classList.remove('d-none');

            validateForm && tipo_profesional.focus();
            validateForm = false;
        }

        if (hora.value == null) {
            hora.classList.add('border-danger', 'is-invalid');
            hora.parentElement.nextElementSibling.textContent = 'La hora es obligatoria';
            hora.parentElement.nextElementSibling.classList.remove('d-none');

            validateForm && hora.focus();
            validateForm = false;
        }

        if (motivo.value == '') {
            motivo.classList.add('border-danger', 'is-invalid');
            motivo.parentElement.nextElementSibling.textContent = 'El motivo es obligatorio';
            motivo.parentElement.nextElementSibling.classList.remove('d-none');

            validateForm && motivo.focus();
            validateForm = false;
        }


        return validateForm;
    }

    const successSaveCita = (response) => {
        const { title, message } = response;
        AlertSweetSuccess(
            title,
            message,
            `/calendar/medical_appointment/${fecha.value}`
        );
    }

    const showErrors = (errors) => {
        const { status } = errors;

        console.log(errors);

        // If errors is 422, is error from the controller Validator
        if (status === 422) {
            const { errorList } = errors;

            // Show errors in the form
            AlertError('Oops...!', 'Se encontraron errores en el formulario');

            // Show errors in the form
            errorContainer.innerHTML = listErrorsForStoreUser(errorList);
            errorContainer.classList.remove('d-none');

            return;
        }

        // If errors is not 422, is error from the server
        const { title, message } = errors;
        AlertError(title, message.message);
    }

    const saveCita = (formData) => {
        requestSaveCita(formData).then(successSaveCita).catch(showErrors);
    }


    // Manejar el envío del formulario de agregar cita
    const manageAddCitaForm = (e) => {
        e.preventDefault();

        // Form object
        const formData = new FormData(formAddCita);

        if (!validateData()) {
            return;
        }

        errorContainer.innerHTML = '';
        errorContainer.classList.add('d-none');

        AlertConfirmationForm('¿Estás seguro de guardar la cita?', '¿Estás seguro de guardar la cita?', () => saveCita(formData));

    }

    formAddCita.addEventListener('submit', manageAddCitaForm)


});

