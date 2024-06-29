import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { activeLoading, disableLoading } from "./loading-screen.js";

$(function () {
    $('form[name="addCitaForm"]').submit(async function (event) {
        event.preventDefault();

        const nombre = $('input[name="Nombre"]').val().trim();
        const email = $('input[name="Email"]').val().trim();
        const telefono = $('input[name="Telefono"]').val().trim();
        const tipo_profesional = $('select[name="Tipo_profesional"]').val();
        const fecha = $('input[name="fecha"]').val().trim();
        const hora = $('input[name="Hora"]').val().trim();
        const motivo = $('input[name="Motivo"]').val().trim();

        if (!nombre || !email || !telefono || !tipo_profesional || !fecha || !hora || !motivo) {
            $('.text-danger').show();
            return false;
        }

        console.log(`Validando hora para fecha: ${fecha} y hora: ${hora}`);

        const { existe, existenAmbosProfesionales } = await validarHoraExistente(fecha, hora);
        if (existe && existenAmbosProfesionales) {
            Swal.fire({
                title: "¡Error al guardar la cita!",
                text: "La hora seleccionada ya está ocupada en esta fecha. Por favor, elige otra hora.",
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

        try {
            const response = await Swal.fire({
                title: "¿Estás seguro de guardar la cita?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#007F73",
                cancelButtonColor: "#B04759",
                confirmButtonText: '<i class="fa-solid fa-save animated-icon px-1"></i> Guardar',
                cancelButtonText: '<i class="fa-solid fa-times"></i> Cancelar',
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
            disableLoading();
            console.log(error);
            Swal.fire({
                title: "¡Error!",
                text: "Ocurrió un error al intentar guardar la cita.",
                icon: "error",
            });
        }
    });
});

async function validarHoraExistente(fecha, hora) {
    try {
        const response = await axios.get(`/validar-hora/${fecha}/${hora}`);
        console.log(response);
        const { data } = response;
        return data;
    } catch (error) {
        console.error("Error al validar la hora:", error);
        return { existe: true, existenAmbosProfesionales: true };
    }
}


////////////////////////////////////////////////////
$(function () {
    $(document).on('click', '.cancelarCitaButton', function () {
        const citaId = $(this).data('cita-id');
        cancelarCita(citaId);
    });
});

function cancelarCita(id) {
    console.log(id);
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Se eliminará la cita seleccionada.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#011d48',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/citas/cancelar/${id}`)
                .then((response) => {
                    const { data } = response;
                    if (data.status === 'success') {
                        Swal.fire({
                            title: '¡Éxito!',
                            text: data.message,
                            icon: 'success',
                            didClose: () => {
                                location.reload();
                            }
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

    // Verificar que todos los campos requeridos no estén vacíos
    if (!nombre || !telefono || !tipo_profesional || !fecha || !hora || !motivo) {
        Swal.fire({
            title: "¡Error!",
            text: "Todos los campos son obligatorios.",
            icon: "error",
        });
        return false;
    }

    const horaExistente = await validarHoraExistenteModificar(citaId, fecha, hora, tipo_profesional);
    if (horaExistente) {
        Swal.fire({
            title: "¡Error!",
            text: "Ya existe una cita en esa fecha, hora y tipo de profesional.",
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
    console.log(datos);
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
});

async function validarHoraExistenteModificar(citaId, fecha, hora, tipo_profesional) {
    try {
        const response = await axios.get(`/validar-hora-modificar/${citaId}/${fecha}/${hora}/${tipo_profesional}`);
        const { data } = response;
        return data.existe;
    } catch (error) {
        console.error("Error al validar la hora:", error);
        return true;
    }
}
