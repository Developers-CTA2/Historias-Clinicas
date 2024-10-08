//import {grid} from './helpers/PersonalGridTable'
import { Grid, html, h } from "gridjs";

import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import "gridjs/dist/theme/mermaid.css";

import { activeLoading, disableLoading } from "../loading-screen.js";
import { ShowErrorsSweet } from "../templates/AlertsTemplate.js";
import { className, translations, TimeAlert } from "../helpers";

$(function () {
    initialData();
});

async function initialData() {
    try {
        activeLoading();
        new Grid({
            columns: [
                {
                    id: "id",
                    name: "id",
                    hidden: true,
                },
                {
                    id: "sex",
                    name: "Sexo",
                    hidden: true,
                },
                {
                    id: "role_id",
                    name: "Rol",
                    hidden: true,
                },
                {
                    /* Columna donde se muestra el icono del tipo de usuario */
                    id: "role_name",
                    name: "Rol",
                    formatter: (_, row) => {
                        const role = row.cells[2].data;
                        const sexo = row.cells[1].data;

                        let classSex = sexo === 1 ? 'avatar-man' : 'avatar-woman';
                        let avatarRole = '';
                        if (role === 1) {
                            avatarRole = 'avatar-doctor';
                        } else if (role === 2) {
                            avatarRole = 'avatar-pasante';
                        } else {
                            avatarRole = 'avatar-nutrition';
                        }

                        return h("div", {
                            className:
                                `d-flex justify-content-center align-items-center avatar-container config-avatar ${avatarRole} ${classSex} p-0`,
                        });

                    },
                    sort: false,
                },
                {
                    id: "name",
                    name: "Nombre",

                    formatter: (cell, row) =>
                        html(
                            `<div class="fw-bold">${cell}</div>
                                <div>${row.cells[3].data}</div>`
                        ),
                },

                {
                    id: "user_name",
                    name: "Código",
                },

                {
                    id: "estatus",
                    name: html('<p class="mb-0 text-center">Estatus</p>'),
                    formatter: (cell) => {
                        const status = cell;

                        let statusHtml = null;
                        if (status === "Activo") {
                            statusHtml = h(
                                "span",
                                {
                                    className: "badge bg-success",
                                },
                                " Activo "
                            );
                        } else {
                            statusHtml = h(
                                "span",
                                {
                                    className: "badge bg-warning text-dark",
                                },
                                " Inactivo "
                            );
                        }

                        return h(
                            "div",
                            {
                                className:
                                    "d-flex justify-content-center align-items-center",
                            },
                            statusHtml
                        );
                    },
                    sort: false,
                },
                {
                    id: "Acciones",
                    name: html('<p class="mb-0 text-center">Opciones</p>'),
                    formatter: (cell, row) => {
                        const status = row.cells[6].data;
                        let statusHtml = null;
                        if (status === "Activo") {
                            statusHtml = html(
                                `<div class="d-flex justify-content-center gap-2">
                            <a href="/users/user-details/${row.cells[0].data}" class="btn-blue fst-normal px-3 py-2" type="button"> Detalles</a>
                            <button data-id="${row.cells[0].data}" class="btn-red fst-normal  inhabilitar-button px-3 py-2" type="button">Inhabilitar</button>
                         </div>`
                            );
                        } else {
                            statusHtml = html(
                                `<div class="d-flex justify-content-center gap-2">
                            <a href="/users/user-details/${row.cells[0].data}" class="btn-blue fst-normal px-3 py-2" type="button"> Detalles</a>
                            <button data-id="${row.cells[0].data}" class="btn-red fst-normal inhabilitar-button disabled px-3 py-2" type="button" disabled>Inhabilitar</button>
                         </div>`
                            );
                        }

                        return h(
                            "div",
                            {
                                className:
                                    "d-flex justify-content-center align-items-center",
                            },
                            statusHtml
                        );
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
                url: "/users/obt-usuarios?",
                then: (data) => {
                    console.log("Datos del servidor:", data);
                    // Mapear los datos según tu lógica
                    return data.results.map((user) => [
                        user.id,
                        user.sexType,
                        user.roles[0].id,
                        user.roles[0].name, // Nombre del rol
                        user.name, // Nombre del usuario
                        user.user_name, // Nombre de usuario
                        user.estado,
                    ]);
                },
                total: (data) => {
                    console.log("Total de datos:", data.count);
                    return data.count;
                },
            },
            className: className,
            autoWidth: true, /// Se ajusta cada columna de un tamaño automatico
            sort: false,
            resizable: false,
            language: translations,
        }).render(document.getElementById("Tabla-Usuarios"));
    } catch (error) {
        console.log(error);
    } finally {
        disableLoading();
    }
}

/* Funcion para cuando se le de clic al boton de quitar acceso */
$(document).on("click", ".inhabilitar-button", function () {
    const userId = $(this).data("id");
    Confirm(userId);
});

/* Funcion para confimar que los datos seran editados  */
async function Confirm(id) {
    try {
        const result = await Swal.fire({
            title: "¿Estás seguro eliminar el acceso?",
            text: "El usuario ya no podra acceder al sistema.",
            icon: "warning",
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirmar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                RequestEdit(id);
                console.log("Borrar");
            }
        });
    } catch (error) {
        // Manejo de errores
        console.error(error);
    }
}

async function RequestEdit(Id) {
    console.log(Id);
    const Data = {
        Id: Id,
    };

    try {
        const response = await axios.post("/users/desactive-user", Data);
        console.log(response.data);
        const { data } = response;
        const { status, msg } = data;
        let timerInterval;

        if (status == 200) {
            timerInterval = TimeAlert(2500, "¡Éxito!", msg, "success", 1);
        } else {
            timerInterval = TimeAlert(2500, "¡Error!", msg, "error", 0);
        }
    } catch (error) {
        // disableLoading();
        // console.log("Error");
        // console.log(error);

        //const { status } = error.response;
        const { errors } = error.response.data;
        const { status } = error.response;
        console.log(error);
        console.log(status);

        if (status == 400) {
            let timerInterval;
            console.log(errors);
            // listdo de errores
            await ShowErrorsSweet(
                "¡Error!",
                "No fue posible realizar la acción debido a los siguientes errores:",
                "error",
                errors
            );         
        } else {
               console.log(errors);
            timerInterval = TimeAlert(2500, "¡Error!", "Algo falló al realizar la petición, intentalo más tarde.", "error", 2);
        }
    }
}
