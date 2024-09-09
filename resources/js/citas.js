import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { activeLoading, disableLoading } from "./loading-screen.js";


const startHour = 8; // Starting hour
const endHour = 18; // Ending hour

document.addEventListener("DOMContentLoaded", function () {
    const timeSelects = document.querySelectorAll('.hora-select');
    const selectShowTypeTable = document.querySelector('#selectFilterTable');
    const tableDoctora = document.querySelector('#tablaDoctora');
    const tableNutriologa = document.querySelector('#tablaNutriologa');
    const citasParaTexto = document.querySelector('#citasPara');

    if (selectShowTypeTable) {
        citasParaTexto.innerHTML = 'Doctora';

        selectShowTypeTable.addEventListener('change', function () {
            if (this.value === 'medico') {

                tableDoctora.style.display = 'block';
                tableNutriologa.style.display = 'none';
                citasParaTexto.innerHTML = 'Doctora';

            } else if (this.value === 'nuticion') {
                console.log('nutriologa');
                tableDoctora.style.display = 'none';
                tableNutriologa.style.display = 'block';
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
            console.error("Element with class 'hora-select' not found.");
        }
    });


});


///////////////////////////////
$(function () {
    $('form[name="addCitaForm"]').submit(async function (event) {
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

////////////////////////////////////////////////////
$(function () {
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
}

