import { Grid, html, h } from "gridjs";

import { className, translations } from "../helpers/gridJsConfiguration";
import { requestGetCita } from "../helpers/request-get-cita";

const fechaInicial = document.getElementById('dateInitial')
const baseUrlGrid = '/citas/get-citas';

const manageData = {
    currentData: [],
    editData: [],
}

// Elements of the modal
const nameEdit = document.getElementById('nameEdit');
const emailEdit = document.getElementById('emailEdit');
const phoneEdit = document.getElementById('phoneEdit');
const professionalEdit = document.getElementById('typeProfessionalEdit');
const reasonEdit = document.getElementById('reasonEdit');
const hourEdit = document.getElementById('hourEdit');
const formEdit = document.getElementById('editFormCita');

const groupFormEdit = document.querySelectorAll('.group-edit-form');

const validateData = () => {

    let validateForm = true;

    groupFormEdit.forEach(group => {
        group.classList.remove('border-danger', 'is-invalid');
        group.parentElement.nextElementSibling.classList.add('d-none');
        group.parentElement.nextElementSibling.textContent = '';
    });


    if (nameEdit.value == '' || emailEdit.value == '' || phoneEdit.value == '' || professionalEdit.value == null || hourEdit.value == null || motivo.value == '') {
        groupForm.forEach(group => {
            group.parentElement.nextElementSibling.textContent = 'Este campo es obligatorio';
            group.classList.add('border-danger', 'is-invalid');
            group.parentElement.nextElementSibling.classList.remove('d-none');
        });
        AlertErrorLoadingData('Error', 'Todos los campos son obligatorios.');
        return false;
    }

    if (!regexLetters.test(nameEdit.value)) {
        nameEdit.classList.add('border-danger', 'is-invalid');
        nameEdit.parentElement.nextElementSibling.textContent = 'El nombre no es válido';
        nameEdit.parentElement.nextElementSibling.classList.remove('d-none');

        validateForm && nameEdit.focus();
        validateForm = false;
    }

    if (!regexCorreo.test(emailEdit.value)) {
        emailEdit.classList.add('border-danger', 'is-invalid');
        emailEdit.parentElement.nextElementSibling.textContent = 'El email no es válido';
        emailEdit.parentElement.nextElementSibling.classList.remove('d-none');

        validateForm && emailEdit.focus();
        validateForm = false;
    }

    if (!regexTelefono.test(phoneEdit.value)) {
        phoneEdit.classList.add('border-danger', 'is-invalid');
        phoneEdit.parentElement.nextElementSibling.textContent = 'El teléfono no es válido';
        phoneEdit.parentElement.nextElementSibling.classList.remove('d-none');

        validateForm && phoneEdit.focus();
        validateForm = false;
    }

    if (professionalEdit.value == '') {
        professionalEdit.classList.add('border-danger', 'is-invalid');
        professionalEdit.parentElement.nextElementSibling.textContent = 'El tipo de profesional es obligatorio';
        professionalEdit.parentElement.nextElementSibling.classList.remove('d-none');

        validateForm && professionalEdit.focus();
        validateForm = false;
    }

    if (hourEdit.value == null) {
        hourEdit.classList.add('border-danger', 'is-invalid');
        hourEdit.parentElement.nextElementSibling.textContent = 'La hora es obligatoria';
        hourEdit.parentElement.nextElementSibling.classList.remove('d-none');

        validateForm && hourEdit.focus();
        validateForm = false;
    }

    if (reasonEdit.value == '') {
        reasonEdit.classList.add('border-danger', 'is-invalid');
        reasonEdit.parentElement.nextElementSibling.textContent = 'El motivo es obligatorio';
        reasonEdit.parentElement.nextElementSibling.classList.remove('d-none');

        validateForm && reasonEdit.focus();
        validateForm = false;
    }


    return validateForm;
}

const manageEditDataCita = (data)=>{

    const { nombre, email, telefono, tipo_profesional, motivo, hora } = data;

    manageData.currentData = data;

    formEdit.action = `/citas/${data.id}/update`;

    nameEdit.value = nombre;
    emailEdit.value = email;
    phoneEdit.value = telefono;
    professionalEdit.value = tipo_profesional;
    reasonEdit.value = motivo;
    hourEdit.value = hora;
}

const showErrors = (errors) => {
    console.log(errors);
}

const editCita = (id) => {
    requestGetCita(id).then(manageEditDataCita).catch(showErrors);
}


export const initialGridJs = ()=>{
    new Grid({
        columns: [
            {
                id: "id",
                name: "id",
                hidden: true,
            },
            {
                /* Columna donde se muestra el icono del tipo de usuario */
                id: "status",
                name: "Estatus",
                formatter: (cell) => {
                    const statusData = cell;
                    let statusHtml = null;

                    console.log(cell);


                    if (statusData === 'Pendiente') {
                        // <span class="badge text-white"
                        statusHtml = h("span", {
                            className: "badge text-dark text-white",
                            style: "background-color: #d56215;"
                        }, statusData);
                    } else if (statusData === 'Asistida') {
                        statusHtml = h("span", {
                            className: "badge bg-success text-white",
                        }, statusData);
                    } else if (statusData === 'Cancelada') {
                        statusHtml = h("span", {
                            className: "badge bg-danger text-white",
                        }, statusData);
                    } else {
                        statusHtml = h("span", {
                            className: "badge bg-info text-white",
                        }, statusData);
                    }

                    return statusHtml;
                }
            },
            {
                id: "hour",
                name: "Hora",
            },
            {
                id: "name",
                name: "Nombre",
            },
            {
                id: "phone",
                name: "Teléfono",
            },
            {
                id: "reason",
                name: "Motivo",
            },
            {
                id: "actions",
                name: html('<p class="mb-0 text-center">Opciones</p>'),
                formatter: (_, row) => {

                    const estatus = row.cells[1].data;
                   
                    const buttons = h("div", {
                        className: "d-flex justify-content-center",

                    }, [
                        h("button", {
                            className: "btn-blue fst-normal py-2 px-3 me-2",
                            'data-bs-toggle': "modal",
                            'data-bs-target': "#editModalCita",
                            onClick: () => editCita(row.cells[0].data)
                        }, [
                            h("svg", {
                                xmlns: "http://www.w3.org/2000/svg",
                                width: "18",
                                height: "18",
                                viewBox: "0 0 24 24",
                            }, [
                                h("path", {
                                    d: 'M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z'
                                })
                            ]),
                        ]),
                        h("button", {
                            className: "btn-red py-2 px-3",
                           
                            onClick: () => {
                                console.log('Eliminar cita');
                            }
                        }, [
                            h("svg", {
                                xmlns: "http://www.w3.org/2000/svg",
                                width: "18",
                                height: "18",
                                viewBox: "0 0 24 24",
                            }, [
                                h("path", {
                                    d: 'M7.5 1h9v3H22v2h-2.029l-.5 17H4.529l-.5-17H2V4h5.5zm2 3h5V3h-5zM6.03 6l.441 15h11.058l.441-15zM13 8v11h-2V8z'
                                })
                            ]),
                        ]),
                    ]);

                    return buttons;
                },
                sort: false,
            },
        ],
        // Configuración del grid js
        pagination: {
            limit: 10,
            server: {
                url: (prev, page, limit) =>
                    `${prev}&limit=${limit}&offset=${page * limit}`,
            },
        },
        search: {
            enabled: true,
            placeholder: "Buscar...",
            debounceTimeout: 1000,
            server: {
                url: (prev, keyword) => `${prev}&search=${keyword}`,
            },
        },
        server: {
            url: `${baseUrlGrid}?fecha=${fechaInicial.value}&tipo=1`,
            then: ({ data }) => data.map(cita => [cita.id, cita.estado, cita.hora, cita.nombre, cita.telefono, cita.motivo]),
            total: (data) => data.count
        },
        className: className,
        autoWidth: true, /// Se ajusta cada columna de un tamaño automatico
        language: translations,
    }
    ).render(document.getElementById("tableCitasDoctor"));

    new Grid({
        columns: [
            {
                id: "id",
                name: "id",
                hidden: true,
            },
            {
                /* Columna donde se muestra el icono del tipo de usuario */
                id: "status",
                name: "Estatus",
                formatter: (cell) => {
                    const statusData = cell;
                    let statusHtml = null;

                    console.log(cell);


                    if (statusData === 'Pendiente') {
                        // <span class="badge text-white"
                        statusHtml = h("span", {
                            className: "badge text-dark text-white",
                            style: "background-color: #d56215;"
                        }, statusData);
                    } else if (statusData === 'Asistida') {
                        statusHtml = h("span", {
                            className: "badge bg-success text-white",
                        }, statusData);
                    } else if (statusData === 'Cancelada') {
                        statusHtml = h("span", {
                            className: "badge bg-danger text-white",
                        }, statusData);
                    } else {
                        statusHtml = h("span", {
                            className: "badge bg-info text-white",
                        }, statusData);
                    }

                    return statusHtml;
                }
            },
            {
                id: "hour",
                name: "Hora",
            },
            {
                id: "name",
                name: "Nombre",
            },
            {
                id: "phone",
                name: "Teléfono",
            },
            {
                id: "reason",
                name: "Motivo",
            },
            {
                id: "actions",
                name: html('<p class="mb-0 text-center">Opciones</p>'),
                formatter: (cell, row) => {
                    const buttons = h("div", {
                        className: "d-flex justify-content-center",

                    }, [
                        h("button", {
                            className: "btn-blue fst-normal py-2 px-3 me-2",
                            onClick: () => {
                                console.log('Editar cita');
                            }
                        }, [
                            h("svg", {
                                xmlns: "http://www.w3.org/2000/svg",
                                width: "18",
                                height: "18",
                                viewBox: "0 0 24 24",
                            }, [
                                h("path", {
                                    d: "M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z"
                                })
                            ]),
                        ]),
                        h("button", {
                            className: "btn-red py-2 px-3",
                            onClick: () => {
                                console.log('Eliminar cita');
                            }
                        }, [
                            h("svg", {
                                xmlns: "http://www.w3.org/2000/svg",
                                width: "18",
                                height: "18",
                                viewBox: "0 0 24 24",
                            }, [
                                h("path", {
                                    d: "M7.5 1h9v3H22v2h-2.029l-.5 17H4.529l-.5-17H2V4h5.5zm2 3h5V3h-5zM6.03 6l.441 15h11.058l.441-15zM13 8v11h-2V8z"
                                })
                            ]),
                        ]),
                    ]);

                    return buttons;
                },
                sort: false,
            },
        ],
        // Configuración del grid js
        pagination: {
            limit: 10,
            server: {
                url: (prev, page, limit) =>
                    `${prev}&limit=${limit}&offset=${page * limit}`,
            },
        },
        search: {
            enabled: true,
            placeholder: "Buscar...",
            debounceTimeout: 1000,
            server: {
                url: (prev, keyword) => `${prev}&search=${keyword}`,
            },
        },
        server: {
            url: `${baseUrlGrid}?fecha=${fechaInicial.value}&tipo=${2}`,
            then: ({ data }) => data.map(cita => [cita.id, cita.estado, cita.hora, cita.nombre, cita.telefono, cita.motivo]),
            total: (data) => data.count
        },
        className: className,
        autoWidth: true, /// Se ajusta cada columna de un tamaño automatico
        language: translations,
    }
    ).render(document.getElementById("tableCitasNutrition"));
}