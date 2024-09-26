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


        if (nombre.value == '' || email.value == '' || telefono.value == '' || tipo_profesional.value == null || hora.value == null || motivo.value == '') {
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
        AlertSweetSuccess(title, message, `/citas?fecha=${fecha.value}`)
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



    /*$('form[name="addCitaForm"]').on('submit',async function (event) {
        event.preventDefault();

        const nombre = $('input[name="Nombre"]').val().trim();
        const email = $('input[name="Email"]').val().trim();
        const telefono = $('input[name="Telefono"]').val().trim();
        const tipo_profesional = $('select[name="Tipo_profesional"]').val();
        const fecha = $('input[name="fecha"]').val().trim();
        const hora = $('select[name="Hora"]').val().trim();
        const motivo = $('input[name="Motivo"]').val().trim();

        if (!nombre || !email || !telefono || !tipo_profesional || !fecha || !hora || !motivo) {
            $('.text-danger').show();
            return false;
        }

        console.log(`Validando hora para fecha: ${fecha} y hora: ${hora}`);

        try {
            const { existe } = await validarHoraExistente(fecha, hora, tipo_profesional);
            console.log(existe);
            if (existe) {
                Swal.fire({
                    title: "¡Error al guardar la cita!",
                    text: "Ya existe una cita activa en esa fecha y hora. Por favor, elige otra hora.",
                    icon: "error",
                });
                return false;
            }

            const datos = {
                nombre,
                email,
                telefono,
                tipo_profesional,
                fecha,
                hora,
                motivo,
            };

            const response = await Swal.fire({
                title: "¿Estás seguro de guardar la cita?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#007F73",
                cancelButtonColor: "#B04759",
                confirmButtonText: '<i class="fa-solid fa-save animated-icon px-1"></i> Guardar',
                cancelButtonText: '<i class="fa-solid fa-times"></i> Cancelar',
                reverseButtons: true,
            });

            if (response.isConfirmed) {
                activeLoading();

                const responseAxios = await axios.post("/guardarCita", datos);
                disableLoading();

                const { data } = responseAxios;
                const { status, message } = data;

                if (status === 'success') {
                    Swal.fire({
                        title: "¡Éxito!",
                        text: message,
                        icon: "success",
                        didClose: () => {
                            location.reload();
                        },
                    });
                } else {
                    Swal.fire({
                        title: "¡Error al guardar la cita!",
                        text: message,
                        icon: "error",
                    });
                }
            } else {
                disableLoading();
            }
        } catch (error) {
            Swal.fire({
                title: "¡Error!",
                text: "Ocurrió un error al intentar guardar la cita.",
                icon: "error",
            });

            disableLoading();
        }
    });


    async function validarHoraExistente(fecha, hora, tipoProfesional) {
        try {
            const response = await axios.get(`/validar-hora/${fecha}/${hora}/${tipoProfesional}`);
            console.log(response);
            const { data } = response;
            return data;
        } catch (error) {
            return { existe: true, message: 'Error al validar la hora' };
        }
    }


    // Manejar clic en el botón de cancelar cita
    $(document).on('click', '.cancelarCitaButton', function () {
        const citaId = $(this).data('cita-id');
        cancelarCita(citaId);
    });

    // Manejar clic en el botón de eliminar cita
    $(document).on('click', '.eliminarCitaButton', function () {
        const citaId = $(this).data('cita-id');
        eliminarCita(citaId);
    });

    function cancelarCita(id) {
        console.log(id);
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Se cancelará la cita seleccionada.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#011d48',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cerrar',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                activeLoading();
                axios.put(`/citas/cancelar/${id}`)
                    .then((response) => {
                        const { data } = response;
                        disableLoading();
                        if (data.status === 'success') {
                            Swal.fire({
                                title: '¡Éxito!',
                                text: data.message,
                                icon: 'success'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: data.message,
                                icon: 'error'
                            });
                        }
                    })
                    .catch((error) => {
                        disableLoading();
                        Swal.fire({
                            title: 'Error',
                            text: 'Error al cancelar la cita. Por favor, inténtalo de nuevo.',
                            icon: 'error'
                        });
                        console.error(error);
                    });
            }
        });
    }

    function eliminarCita(id) {
        console.log(id);
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Se eliminará la cita seleccionada de forma permanente.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#011d48',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                activeLoading();
                axios.delete(`/citas/eliminar/${id}`)
                    .then((response) => {
                        const { data } = response;
                        disableLoading();
                        if (data.status === 'success') {
                            Swal.fire({
                                title: '¡Éxito!',
                                text: data.message,
                                icon: 'success'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: data.message,
                                icon: 'error'
                            });
                        }
                    })
                    .catch((error) => {
                        disableLoading();
                        Swal.fire({
                            title: 'Error',
                            text: 'Error al eliminar la cita. Por favor, inténtalo de nuevo.',
                            icon: 'error'
                        });
                        console.error(error);
                    });
            }
        });
    }


    //////////////////////////////////////////////////////////////
    $(document).on('submit', '.modificarCitaForm', async function (event) {
        event.preventDefault();

        const form = $(this);
        const citaId = form.data('cita-id');

        // Verificar y capturar valores de los inputs con id específicos para cada cita
        const nombre = $(`#nombre_edit_${citaId}`).val()?.trim();
        const email = $(`#email_edit_${citaId}`).val()?.trim();
        const telefono = $(`#telefono_edit_${citaId}`).val()?.trim();
        const tipo_profesional = $(`#tipo_edit_${citaId}`).val();
        const fecha = $(`#fecha_edit_${citaId}`).val()?.trim();
        const hora = $(`#hora_edit_${citaId}`).val()?.trim();
        const motivo = $(`#motivo_edit_${citaId}`).val()?.trim();
        const estado = $(`#estado_edit_${citaId}`).val()?.trim();

        // Verificar que todos los campos requeridos no estén vacíos
        if (!nombre || !telefono || !tipo_profesional || !fecha || !hora || !motivo || !estado) {
            Swal.fire({
                title: "¡Error!",
                text: "Todos los campos son obligatorios.",
                icon: "error",
            });
            return false;
        }

        const horaExistente = await validarHoraExistenteModificar(citaId, fecha, hora);
        if (horaExistente) {
            Swal.fire({
                title: "¡Error!",
                text: "Ya existe una cita activa en esa fecha y hora.",
                icon: "error",
            });
            return false;
        }

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¿Estás seguro de que quieres modificar esta cita?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#007F73',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, modificar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true,
        }).then(async (result) => {
            if (result.isConfirmed) {
                const datos = {
                    nombre,
                    email,
                    telefono,
                    tipo_profesional,
                    fecha,
                    hora,
                    motivo,
                    estado,
                };

                try {
                    const response = await axios.put(`/citas/${citaId}`, datos);
                    const { data } = response;

                    if (data.status === 'success') {
                        Swal.fire({
                            title: "¡Éxito!",
                            text: data.message,
                            icon: "success",
                            didClose: () => {
                                location.reload();
                            },
                        });
                    } else {
                        Swal.fire({
                            title: "¡Error!",
                            text: data.message,
                            icon: "error",
                        });
                    }
                } catch (error) {
                    Swal.fire({
                        title: "¡Error!",
                        text: "Error al actualizar la cita. Por favor, inténtalo de nuevo.",
                        icon: "error",
                    });
                    console.error(error);
                }
            }
        });
    });

    async function validarHoraExistenteModificar(citaId, fecha, hora) {
        try {
            const response = await axios.get(`/validar-hora-modificar/${citaId}/${fecha}/${hora}`);
            const { data } = response;
            return data.existe;
        } catch (error) {
            console.error("Error al validar la hora:", error);
            return true;
        }
    }*/

});

